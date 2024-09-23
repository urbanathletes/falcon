<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;

class PromoFalconLongController extends Controller
{
    public function index()
    {
        $clubId = "";
        $withClub = false;
        if (isset($_GET['club'])) {
            $foundClub = DB::table('ua_mst_clubs')->whereRaw('id = ' . $_GET['club'])->whereRaw('org_id = 15')->whereRaw('deletedAt is null')->first();
            if (isset($foundClub)) {
                $club = DB::table('ua_mst_clubs')->whereRaw('id = ' . $_GET['club'])->whereRaw('org_id = 15')->whereRaw('deletedAt is null and is_deleted = 0')->get();
                $withClub = true;
            } else {
                $club = DB::table('ua_mst_clubs')->whereRaw('org_id = 15')->whereRaw('deletedAt is null and is_deleted = 0')->get();
            }
        } else {
            $club = DB::table('ua_mst_clubs')->whereRaw('org_id = 15')->whereRaw('deletedAt is null and is_deleted = 0')->get();
        }

        return view('falconlong.index', compact('club', 'withClub'));
    }

    // public function store(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'name' => 'required|max:255',
    //         'phone' => 'required|max:255',
    //         'email' => 'required|max:255',
    //         'club_id' => 'required'
    //     ]);

    //     $validateData['org_id'] = env('ORG_ID');
    //     if (isset($_GET['source'])) {
    //         $validateData['source'] = $_GET['source'];
    //         $validateData['source_sub'] = isset($_GET['sub']) ? $_GET['sub'] : null;
    //     } else {
    //         $validateData['source'] = 'website';
    //     }
    //     if (isset($_GET['type'])) {
    //         $validateData['type_promo'] = $_GET['type'];
    //     } else {
    //         $validateData['type_promo'] = 'presale_falcon';
    //     }
    //     $validateData['sales_id'] = '232';
    //     $validateData['createdAt'] = date('Y-m-d H:i:s');
    //     $validateData['updatedAt'] = date('Y-m-d H:i:s');

    //     if ($validateData['club_id'] == 16) { //Falcon
    //         $packageMembershipId = 856;
    //     }

    //     $foundMember = DB::table('ua_mst_members')->whereRaw('email = "' . $validateData['email'] . '"')->whereRaw('deletedAt is null')->first();
    //     if (!isset($foundMember)) {
    //         $foundLead = DB::table('ua_mst_leads')->whereRaw('email = "' . $validateData['email'] . '"')->whereRaw('deletedAt is null')->first();
    //         if (!isset($foundLead)) {
    //             $modelLead = Lead::create($validateData);
    //         } else {
    //             $modelLead = $foundLead;
    //         }
    //         $leadsId = $modelLead->id;
    //     } else {
    //         $leadsId = $foundMember->leads_id;
    //         $foundMemberPackage = DB::table('ua_mst_members_packages')
    //             ->whereRaw('member_id = ' . $foundMember->id)
    //             ->whereRaw('package_membership_expired_date >= date_sub(now(), interval 6 month)')
    //             ->whereRaw('deletedAt is null')
    //             ->whereRaw('package_membership_id is not null')
    //             ->first();
    //         if (isset($foundMemberPackage)) {
    //             return back()->with('error', 'Maaf anda tidak memenuhi syarat & ketentuan untuk membeli promo falcon.');
    //         }

    //         $foundTransaction = DB::table('ua_orders')
    //             ->whereRaw('member_id = ' . $foundMember->id)
    //             ->whereRaw('package_membership_id in (856,789,790,791,792)')
    //             ->whereRaw('status = "paid"')
    //             ->first();
    //         if (isset($foundTransaction)) {
    //             return back()->with('error', 'Maaf anda sudah pernah membeli promo falcon.');
    //         }
    //     }

    //     $packageMembership = DB::table('ua_package_memberships as a')
    //         ->selectRaw('a.*, c.name as shift_name')
    //         ->join('ua_mst_shifts as c', 'c.id', '=', 'a.shift_id')
    //         ->where('a.id', '=', $packageMembershipId)
    //         ->first();

    //     $response = Http::withBasicAuth('keys', 'secret')
    //         ->withHeaders([
    //             'Content-Type' => 'application/json',
    //             'Authorization' => 'Basic some_base64_encrypted_key'
    //         ])
    //         ->post($this->getUrl('checkout-presale'), [
    //             'orgId' => env('ORG_ID'),
    //             'clubId' => $validateData['club_id'],
    //             'packageMembershipId' => $packageMembership->id,
    //             'leadId' => $leadsId,
    //             'email' => $validateData['email'],
    //             'phone' => $validateData['phone'],
    //             'name' => $validateData['name']
    //         ]);

    //     $jsonData = $response->json();
    //     $data = isset($jsonData['data']) ? $jsonData['data'] : [];

    //     // get employee (sales / fitness consultant)
    //     $response = Http::get($this->getUrl('presales/sales-employee?orgId=' . env('ORG_ID') . '&clubId=' . $validateData['club_id']));
    //     $salesData = $response->json();
    //     $salesList = [];

    //     if (count($salesData['data']) > 0) {
    //         /* foreach ($salesData['data'] as $row => $sales) {
    //             if (strtolower($sales['position']['name']) == 'fitness consultant') {
    //                 array_push($salesList, $sales);
    //             }
    //         };*/
    //     }

    //     return view('falconlong.checkout', compact('packageMembership', 'leadsId', 'data', 'salesList'));
    // }


    private function getUrl($key = NULL)
    {
        $server = env('APP_ENV');
        $url = '';
        if ($server == 'local') {
            $url = 'http://localhost:8080/api/' . $key;
        } elseif ($server == 'trial') {
            $url = 'https://dev-fwapi.fitnessworks.co.id/api/' . $key;
        } elseif ($server == 'production') {
            $url = 'https://fwapi.fitnessworks.co.id/api/' . $key;
        }

        return $url;
    }

    public function showInfoForm()
    {
        return view('falconlong.personal-info');  // Ensure this view exists
    }

    public function showPackages()
    {
        // Fetch the available packages from the database
        $packages = DB::table('ua_package_memberships')
            ->select('id', 'name', 'price', 'month') // Select 'month' instead of 'duration'
            ->where('org_id', 15)
            ->whereNull('deletedAt')
            ->get();

        return view('falconlong.packages', compact('packages'));
    }


    public function saveInfo(Request $request)
    {
        // Validate the user's personal information
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'club_id' => 'required',
        ]);

        // Store the user data in session
        session([
            'user_info' => $request->only('name', 'phone', 'email', 'club_id'),
        ]);

        // Redirect to the package selection page
        return redirect()->route('falcon.packages');
    }

    public function selectPackage(Request $request)
    {
        // Validate the selected package
        $request->validate([
            'package_id' => 'required|exists:ua_package_memberships,id',
        ]);

        // Store the selected package in the session
        session(['selected_package_id' => $request->input('package_id')]);

        // Redirect to the checkout page
        return redirect()->route('falcon.checkout');
    }

    public function checkout()
    {
        // Retrieve the user info and selected package from the session
        $userInfo = session('user_info');
        $packageMembershipId = session('selected_package_id');

        if (!$userInfo || !$packageMembershipId) {
            // Redirect back if no data is available (if the session was cleared, for example)
            return redirect()->route('falcon.info')->with('error', 'Please complete the previous steps.');
        }

        // Fetch the selected package details from the database
        $packageMembership = DB::table('ua_package_memberships')
            ->where('id', $packageMembershipId)
            ->first();

        if (!$packageMembership) {
            return redirect()->route('falcon.packages')->with('error', 'Selected package not found.');
        }

        // Display the checkout page
        return view('falconlong.checkout', compact('packageMembership', 'userInfo'));
    }


    public function store(Request $request)
    {
        // Validate necessary fields (adjust according to what you need in the final step)
        $validateData = $request->validate([
            'checkout_id' => 'required',
            'package_membership_id' => 'required',
            // any other necessary fields...
        ]);

        // Get the user info from the session
        $userInfo = session('user_info');
        if (!$userInfo) {
            return redirect()->route('falcon.info')->with('error', 'Please provide your personal information.');
        }

        // Prepare data for the API or database based on the selected package and user details
        $validateData['name'] = $userInfo['name'];
        $validateData['phone'] = $userInfo['phone'];
        $validateData['email'] = $userInfo['email'];
        $validateData['club_id'] = $userInfo['club_id'];
        $validateData['createdAt'] = now();
        $validateData['updatedAt'] = now();

        // Fetch the selected package from the session or database
        $packageMembershipId = session('selected_package_id');
        if (!$packageMembershipId) {
            return redirect()->route('falcon.packages')->with('error', 'Please select a package.');
        }

        $packageMembership = DB::table('ua_package_memberships')->where('id', $packageMembershipId)->first();

        if (!$packageMembership) {
            return redirect()->route('falcon.packages')->with('error', 'Invalid package selected.');
        }

        // Proceed with the existing logic to process the order...
        // Example: Make an API call or insert into your orders table.

        // Send API request or insert data into your orders table
        $response = Http::withBasicAuth('keys', 'secret')
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic some_base64_encrypted_key'
            ])
            ->post($this->getUrl('checkout-presale'), [
                'orgId' => env('ORG_ID'),
                'clubId' => $validateData['club_id'],
                'packageMembershipId' => $packageMembership->id,
                'leadId' => $userInfo['lead_id'],  // Or create new if needed
                'email' => $validateData['email'],
                'phone' => $validateData['phone'],
                'name' => $validateData['name'],
            ]);

        // Handle the response and show confirmation
        $jsonData = $response->json();
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        return view('falconlong.checkout-complete', compact('packageMembership', 'data'));
    }


    public function order(Request $request)
    {
        if (isset($_POST['lead_id']) && isset($_POST['package_membership_id']) && isset($_POST['checkout_id'])) {
            $lead = DB::table('ua_mst_leads')->where('id', '=', $_POST['lead_id'])->first();

            $response = Http::withBasicAuth('keys', 'secret')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic some_base64_encrypted_key'
                ])
                ->post($this->getUrl('presales'), [
                    'orgId' => env('ORG_ID'),
                    'clubId' => env('CLUB_ID'),
                    'checkoutId' => $_POST['checkout_id'],
                    'leadId' => $_POST['lead_id'],
                    'salesId' => '232',
                    'packageMembershipId' => $_POST['package_membership_id'],
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'name' => $lead->name,
                ]);

            $jsonData = $response->json();
            $data = isset($jsonData['data']) ? $jsonData['data'] : [];

            if ($response->successful()) {
                $url = $data['xendit_invoice_url'];
                return view('falconlong.order', compact('url'));
            } elseif ($response->failed()) {
            }
        }
    }
}
