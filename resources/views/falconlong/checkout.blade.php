@extends('master3')

@section('content')

<style>
    /* Styling minimal untuk memastikan checkbox terlihat */
    input[type="checkbox"] {
        appearance: checkbox !important;
        -webkit-appearance: checkbox !important;
        -moz-appearance: checkbox !important;
        width: 20px !important;
        height: 20px !important;
        display: inline-block !important;
        position: relative !important;
        visibility: visible !important;
        z-index: 10 !important;
    }

    label {
        font-size: 16px;
        color: #ffffff; /* Warna teks label */
    }

    body {
        background-color: #000; /* Warna latar belakang hitam */
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    /* Tombol Pembayaran */
    #orderButton {
        background-color: #007bff;
        color: #ffffff;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 20px;
    }

    #orderButton:disabled {
        background-color: #777;
        cursor: not-allowed;
        
    .row {
        display: flex;
        justify-content: center; /* Konten berada di tengah secara horizontal */
        align-items: center; /* Konten berada di tengah secara vertikal */
        flex-direction: column; /* Mengatur elemen agar berada di atas satu sama lain */
        padding: 10px; /* Tambahkan padding untuk ruang */
    }
    
    .form-group {
        display: flex;
        align-items: center; /* Pastikan checkbox dan label selaras */
        margin-bottom: 15px; /* Tambahkan margin bawah antar form group */
    }
    
    .label {
        margin-left: 10px; /* Beri jarak antara checkbox dan label */
    }
    
    .col-row {
        max-width: 600px; /* Atur lebar maksimal untuk membuatnya lebih sempit */
        width: 100%; /* Pastikan mengambil 100% lebar di perangkat kecil */
    }
    
        .container-md {
        max-width: 1200px; /* Atur maksimal lebar sesuai kebutuhan, misalnya 1200px */
        margin: 0 auto; /* Untuk memposisikan kontainer di tengah */
        padding: 20px; /* Menambahkan padding internal untuk konten */
    }


    }
    
        /* Styling untuk checkbox dengan kelas agree-term */
    .agree-term {
    appearance: checkbox;
    -webkit-appearance: checkbox;
    -moz-appearance: checkbox;
    width: 20px;
    height: 20px;
    margin-right: 10px;
    position: relative;
    z-index: 10;
    }

    
    .agree-term:checked {
        background-color: #28a745;  /* Ubah warna latar belakang saat dicentang */
        border: 1px solid #28a745;  /* Ubah warna border saat dicentang */
    }
    
    .agree-term:checked::after {
        content: "✓";              /* Tampilkan tanda centang setelah dicentang */
        color: white;              /* Warna tanda centang */
        font-weight: bold;
        display: block;
        text-align: center;
        line-height: 18px;         /* Vertikal centang dengan ukuran checkbox */
        font-size: 16px;
    }
   
</style>

<div class="container-md p0">
    <div class="signup-content-second h100vh">
        <div class="signup-desc">
            <div class="signup-desc-content" style="padding-left: 30px;padding-right: 30px;text-align:center;">
                <img src="assets/img/logo falcon red_Website.png" alt="" class="img-fluid img-logo">
            </div>
        </div>
        <div class="signup-form-conent">
            <form action="{{ route('falconlong.order') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="font-size: 25px; font-weight:900;text-transform: uppercase;padding-bottom: 2rem; color:#ffffff;">
                                Checkout Sekarang!!!
                            </p>
                        </div>
                    </div>

                    <!-- Hidden inputs for required data -->
                    <input type="hidden" name="checkout_id" id="checkout_id" value="{{ $data['checkout_number'] }}" />
                    <input type="hidden" name="lead_id" id="lead_id" value="{{ $leadsId }}" />
                    <input type="hidden" name="package_membership_id" id="package_membership_id" value="{{ $packageMembership->id }}" />

                    <!-- Tabel informasi paket -->
                    <div class="row" style="padding-bottom:2rem;">
                        <div class="col-sm-12">
                            <table class="table-responsive table-checkout" style="width:100%; color:#ffffff;">
                                <tbody>
                                    <tr>
                                        <th>PAKET MEMBERSHIP</th>
                                        <th>Duration</th>
                                        <th>Exp</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $packageMembership->shift_name }} - {{ $packageMembership->name }}</td>
                                        <td>{{ $packageMembership->description }}</td>
                                        <td>{{ $packageMembership->expired }} Hari</td>
                                        <td style="font-size: 20px;font-weight: 700;">IDR {{ number_format($data['grand_total']) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="font-weight:bold;">Total</td>
                                        <td style="font-size: 20px;font-weight: 700;">IDR {{ number_format($data['total']) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Bagian Checkbox -->
                    <div class="row">
                        <div class="col-row">
                            <div class="form-group">
                                 <input class="agree-term" type="checkbox" name="checkbox" id="terms_1" />
                                <label for="terms_1" class="label-agree-term" style="color: #ffffff;">
                                    Dengan mencentang kotak di sebelah kiri saya menyatakan menyetujui dan paham dari isi syarat dan ketentuan yang berlaku di Falcon Fitnessbox
                                    <a href="{{ URL::asset('assets/docs/Waifer presale FW samator.pdf') }}" onclick="openPdfPopup(event)" class="terms-tuntutan" style="color: #007bff;">Lihat Surat Penyerahan Tuntutan</a>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="agree-term" type="checkbox" name="checkbox" id="terms_2" />
                                <label for="terms_2" class="label-agree-term" style="color: #ffffff;">
                                    Dengan mencentang kotak di sebelah kiri saya menyatakan menyetujui dan paham dari isi surat penyerahan tuntutan
                                    <a href="{{ URL::asset('assets/docs/Waifer presale FW samator.pdf') }}" target="_blank" class="terms-tuntutan" style="color: #007bff;">Lihat Surat Penyerahan Tuntutan</a>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="agree-term" type="checkbox" name="checkbox" id="terms_3" />
                                <label for="terms_3" class="label-agree-term" style="color: #ffffff;">
                                    Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti semua update, promo, dan informasi Falcon Fitnessbox
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Pembayaran -->
                    <button type="submit" class="btn btn-primary" style="float:right;" id="orderButton" disabled>Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk Memastikan Tombol Aktif Saat Semua Checkbox Dicentang -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var orderButton = document.getElementById("orderButton");

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (document.getElementById('terms_1').checked &&
                    document.getElementById('terms_2').checked &&
                    document.getElementById('terms_3').checked) {
                    orderButton.disabled = false; // Aktifkan tombol jika semua checkbox dicentang
                } else {
                    orderButton.disabled = true; // Nonaktifkan tombol jika ada yang belum dicentang
                }
            });
        });
    });
</script>

@endsection