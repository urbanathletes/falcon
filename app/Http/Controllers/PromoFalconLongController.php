<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Lead;

class PromoFalconLongController extends Controller
{
    public function index()
    {
        $clubId = "";
        $withClub = false;
        if (isset($_GET['club'])) {
            $foundClub = DB::table('ua_mst_clubs')->where('id', $_GET['club'])->where('org_id', 15)->whereNull('deletedAt')->first();
            if ($foundClub) {
                $club = DB::table('ua_mst_clubs')->where('id', $_GET['club'])->where('org_id', 15)->whereNull('deletedAt')->get();
                $withClub = true;
            } else {
                $club = DB::table('ua_mst_clubs')->where('org_id', 15)->whereNull('deletedAt')->get();
            }
        } else {
            $club = DB::table('ua_mst_clubs')->where('org_id', 15)->whereNull('deletedAt')->get();
        }
        return view('falconlong.index', compact('club', 'withClub'));
    }

    public function showInfoForm()
    {
        $clubId = "";
        $withClub = false;
        if (isset($_GET['club'])) {
            $foundClub = DB::table('ua_mst_clubs')->where('id', $_GET['club'])->where('org_id', 15)->whereNull('deletedAt')->first();
            if ($foundClub) {
                $club = DB::table('ua_mst_clubs')->where('id', $_GET['club'])->where('org_id', 15)->whereNull('deletedAt')->get();
                $withClub = true;
            } else {
                $club = DB::table('ua_mst_clubs')->where('org_id', 15)->whereNull('deletedAt')->get();
            }
        } else {
            $club = DB::table('ua_mst_clubs')->where('org_id', 15)->whereNull('deletedAt')->get();
        }

        return view('falconlong.personal-info', compact('club', 'withClub'));
    }

    public function showPackages()
    {
        $packages = DB::table('ua_package_memberships')
            ->select('id', 'name', 'price', 'month')
            ->where('org_id', 15)
            ->whereNull('deletedAt')
            ->whereIn('id', [1475, 1476, 1477, 1478, 1479])
            ->get();
        return view('falconlong.packages', compact('packages'));
    }

    public function saveInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'clubId' => env('CLUB_ID'),
        ]);

        // Simpan data pengguna dalam session
        session([
            'user_info' => $request->only('name', 'phone', 'email', 'club_id'),
        ]);

        return redirect()->route('falconlong.packages');
    }

    public function selectPackage(Request $request)
    {
        $request->validate([
            'package_id' => 'required|in:1475,1476,1477,1478,1479',
        ]);

        session(['selected_package_id' => $request->input('package_id')]);

        // return redirect()->route('falconlong.checkout');
        
        return redirect()->route('falconlong.showCheckoutForm');
    }
    
    public function showCheckoutForm()
    {
        // Ambil package_id dari session
        $packageId = session('selected_package_id');
        $userInfo = session('user_info'); // Pastikan user info juga tersedia di session
    
        if (!$packageId || !$userInfo) {
            return redirect()->route('falconlong.packages')->with('error', 'Please complete the previous steps.');
        }
    
        // Tampilkan halaman dengan form POST otomatis
        return view('falconlong.auto-checkout-form', [
            'packageId' => $packageId,
            'userInfo' => $userInfo
        ]);
    }

    public function checkout(Request $request)
    {
        // Ambil data user dari sesi
        $userInfo = session('user_info');

        // Ambil package_id dari request dan simpan ke dalam session jika ada
        if ($request->has('package_id')) {
            session(['selected_package_id' => $request->input('package_id')]);
        }

        // Ambil packageMembershipId dari session
        $packageMembershipId = session('selected_package_id');

        // Jika tidak ada user atau packageMembershipId, redirect dengan pesan error
        if (!$userInfo || !$packageMembershipId) {
            return redirect()->route('falconlong.info')->with('error', 'Please complete the previous steps.');
        }

        // Cek apakah member sudah ada berdasarkan email
        $foundMember = DB::table('ua_mst_members')
            ->where('email', $userInfo['email'])
            ->whereNull('deletedAt')
            ->first();

        if (!$foundMember) {
            // Jika member tidak ditemukan, cari di leads
            $foundLead = DB::table('ua_mst_leads')
                ->where('email', $userInfo['email'])
                ->whereNull('deletedAt')
                ->first();

            // Jika lead juga tidak ditemukan, buat data baru di ua_mst_leads
            if (!$foundLead) {
                $modelLead = Lead::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'phone' => $userInfo['phone'],
                    'club_id' =>env('CLUB_ID'),
                    'source' => 'website',
                    'type_promo' => 'presale_falcon',
                    'sales_id' => '232',
                    'createdAt' => now(),
                    'updatedAt' => now(),
                ]);
            } else {
                $modelLead = $foundLead;
            }
            $leadsId = $modelLead->id;
        } else {
            // Jika member ditemukan, ambil leads_id dari member
            $leadsId = $foundMember->leads_id;

            // Cek apakah member memiliki paket yang masih aktif
            $foundMemberPackage = DB::table('ua_mst_members_packages')
                ->where('member_id', $foundMember->id)
                ->whereRaw('package_membership_expired_date >= date_sub(now(), interval 6 month)')
                ->whereNull('deletedAt')
                ->first();

            if ($foundMemberPackage) {
                return back()->with('error', 'Maaf anda tidak memenuhi syarat & ketentuan untuk membeli promo falcon.');
            }

            // Cek transaksi apakah sudah pernah membeli promo falcon
            $foundTransaction = DB::table('ua_orders')
                ->where('member_id', $foundMember->id)
                ->whereIn('package_membership_id', [1475, 1476, 1477, 1478, 1479])
                ->where('status', 'paid')
                ->first();

            if ($foundTransaction) {
                return back()->with('error', 'Maaf anda sudah pernah membeli promo falcon.');
            }
        }

        // Ambil informasi package membership berdasarkan packageMembershipId
        $packageMembership = DB::table('ua_package_memberships')
            ->where('id', $packageMembershipId)
            ->first();

        if (!$packageMembership) {
            return back()->with('error', 'Paket membership tidak ditemukan.');
        }

        // Simpan transaksi ke dalam tabel ua_orders
        $orderId = DB::table('ua_orders')->insertGetId([
            'member_id' => $foundMember->id ?? null,
            'package_membership_id' => $packageMembershipId,
            'status' => 'pending',
            'createdAt' => now(),
            'updatedAt' => now(),
        ]);
        
        $packageMembership = DB::table('ua_package_memberships as a')
            ->selectRaw('a.*, c.name as shift_name')
            ->join('ua_mst_shifts as c', 'c.id', '=', 'a.shift_id')
            ->where('a.id', '=', $packageMembershipId)
            ->first();

        // Kirim request ke API checkout-presale
        $response = Http::withBasicAuth('keys', 'secret')
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic some_base64_encrypted_key'
            ])
            ->post($this->getUrl('checkout-presale'), [
                'orgId' => env('ORG_ID'),
                'clubId' => env('CLUB_ID'),
                'packageMembershipId' => $packageMembership->id,
                'leadId' => $leadsId,
                'email' => $userInfo['email'],
                'phone' => $userInfo['phone'],
                'name' => $userInfo['name'],
                'checkoutId' => $orderId,
            ]);

        if ($response->failed()) {
            return back()->with('error', 'Gagal melakukan checkout, silakan coba lagi.');
        }

        // $jsonData = $response->json();
        // $data = $jsonData['data'] ?? [];
         $jsonData = $response->json();
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];
        $salesData = $response->json();
        $salesList = [];
        if (count($salesData['data']) > 0) {
            /* foreach ($salesData['data'] as $row => $sales) {
                if (strtolower($sales['position']['name']) == 'fitness consultant') {
                    array_push($salesList, $sales);
                }
            };*/
        }
        
    return view('falconlong.checkout', compact('packageMembership', 'leadsId', 'data', 'salesList'));
    }
    
      // Fungsi untuk menentukan URL berdasarkan environment
    private function getUrl($key = NULL)
    {
        $server = env('APP_ENV');
        $url = '';

        switch ($server) {
            case 'local':
                $url = 'http://localhost:8080/api/' . $key;
                break;
            case 'trial':
                $url = 'https://dev-fwapi.fitnessworks.co.id/api/' . $key;
                break;
            case 'production':
                $url = 'https://fwapi.fitnessworks.co.id/api/' . $key;
                break;
        }

        return $url;
    }

    public function order(Request $request)
    {
        // Ambil lead_id, package_membership_id, dan checkout_id dari request
        $leadId = $request->input('lead_id');
        $packageMembershipId = $request->input('package_membership_id');
        $checkoutId = $request->input('checkout_id');

        // Validasi data yang diperlukan
        if (!$leadId || !$packageMembershipId || !$checkoutId) {
            return back()->with('error', 'Required parameters are missing.');
        }
        // Ambil informasi lead berdasarkan lead_id
        $lead = DB::table('ua_mst_leads')->where('id', $leadId)->first();
        if (!$lead) {
            return back()->with('error', 'Lead not found.');
        }

        // Kirim request ke API untuk memproses order
        $response = Http::withBasicAuth('keys', 'secret')
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic some_base64_encrypted_key',
            ])
            ->post($this->getUrl('presales'), [
                'orgId' => env('ORG_ID'),
                'clubId' => $lead->club_id, // Gunakan club_id dari lead
                'checkoutId' => $checkoutId,
                'leadId' => $leadId,
                'salesId' => '232', // Sesuaikan jika perlu
                'packageMembershipId' => $packageMembershipId,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'name' => $lead->name,
            ]);

        // Cek apakah respons API berhasil
        if ($response->failed()) {
            return back()->with('error', 'Failed to process the order.');
        }
       
        // Ambil data dari respons API
        $jsonData = $response->json();
        $data = $jsonData['data'] ?? [];
        
        // Pastikan bahwa URL invoice Xendit tersedia dalam respons
        if (isset($data['xendit_invoice_url'])) {
            $url = $data['xendit_invoice_url'];
            return view('falconlong.order', compact('url'));
        } else {
            return back()->with('error', 'Failed to retrieve the invoice URL.');
        }
    }

}
