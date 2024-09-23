@extends('master3')

@section('content')
<div class="container-md p0">
    <div class="signup-content-second h100vh">
        <div class="signup-desc">
            <div class="signup-desc-content" style="padding-left: 30px;padding-right: 30px;text-align:center;">
                <img src="assets/img/logo falcon red_Website.png" alt="" class="img-fluid img-logo">
                <!-- <img src="assets/img/bg-guest-profile.jpg" alt="" class="img-fluid" style="min-height: 100vh;"> -->
            </div>
        </div>
        <div class="signup-form-conent">
            <form method="POST" action="/order" id="order-form" class="signup-form">
                @csrf
                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-12">
                            <p style="font-size: 25px; font-weight:900;text-transform: uppercase;padding-bottom: 2rem; color:#ffffff;">
                                Checkout Sekarang!!!
                            </p>
                        </div>
                    </div>

                    <input type="text" name="checkout_id" id="checkout_id" value="{{ $data['checkout_number'] }}" style="display:none;" />
                    <input type="text" name="lead_id" id="lead_id" value="{{ $leadsId }}" style="display:none;" />
                    <input type="text" name="package_membership_id" id="package_membership_id" value="{{ $packageMembership->id }}" style="display:none;" />

                    <div class="row" style="padding-bottom:2rem;">
                        <div class="col-sm-12">
                            <?php $total = $data['total']; ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="package-box" style="background: #570902; padding: 20px; border-radius: 10px; color: #ffffff;">
                                        <div class="package-header" style="font-size: 25px; font-weight: bold; color:#FECC09">{{ $packageMembership->shift_name }}</div>
                                        <div class="package-name" style="font-size: 20px; margin-bottom: 10px;">{{ $packageMembership->name }}</div>
                                    </div>
                                    <div class="package-box" style="background: #000000; padding: 20px; border-radius: 10px; color: #ffffff;">
                                        <div class="package-description" style="font-size: 18px; margin-bottom: 10px;">{{ $packageMembership->description }}</div>
                                        <div class="package-expired" style="font-size: 18px; margin-bottom: 10px;">{{ $packageMembership->expired }} Hari</div>
                                        <div class="package-price" style="font-size: 25px; font-weight: bold;">IDR {{ number_format($data['grand_total']) }}</div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mt-3" id="orderButton"  style="color:#FF0000;">Pembayaran</button>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row" style="margin-top: 20px;">-->
                            <!--    <div class="col-md-12">-->
                            <!--        <div class="total-box" style="background: #242424; padding: 20px; border-radius: 10px; color: #ffffff;">-->
                            <!--            <div class="total-label" style="font-size: 20px; font-weight: bold;">Total</div>-->
                            <!--            <div class="total-price" style="font-size: 25px; font-weight: bold;">IDR {{ number_format($total) }}</div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>

                    <!--<div class="row">-->
                    <!--    <div class="col-sm-12">-->

                    <!--        <div class="form-group">-->
                    <!--            <input class="agree-term" type="checkbox" name="checkbox" id="terms_1" />-->
                    <!--            <label for="terms_1" class="label-agree-term" style="color: #ffffff;"><span><span></span></span>-->
                    <!--                Dengan mencentang kotak di sebelah kiri saya menyatakan menyetujui dan paham dari isi syarat dan ketentuan yang berlaku di Fitnessworks-->
                                    <!-- <a href="{{ URL::asset('assets/docs/T&C presale FW samator.pdf'); }}" target="_blank" class="terms-syarat">Lihat Syarat & Ketentuan</a> -->
                    <!--                <a href="{{ URL::asset('assets/docs/Waifer presale FW samator.pdf') }}" onclick="openPdfPopup(event)" class="terms-tuntutan">Lihat Surat Penyerahan Tuntutan</a>-->
                    <!--                <script>-->
                    <!--                    function openPdfPopup(event) {-->
                    <!--                        event.preventDefault();-->

                    <!--                        var url = event.target.href;-->
                                            <!--var windowName = 'pdfPopup'; // Nama jendela pop-up-->

                                            <!--// Atur ukuran dan posisi jendela pop-up (opsional)-->
                    <!--                        var windowFeatures = 'width=800,height=600,scrollbars=yes';-->

                                            <!--// Buka jendela pop-up-->
                    <!--                        window.open(url, windowName, windowFeatures);-->

                    <!--                        return false;-->
                    <!--                    }-->
                    <!--                </script>-->
                    <!--            </label>-->
                    <!--        </div>-->

                    <!--        <div class="form-group">-->
                    <!--            <input class="agree-term" type="checkbox" name="checkbox" id="terms_2" />-->
                    <!--            <label for="terms_2" class="label-agree-term" style="color: #ffffff;"><span><span></span></span>-->
                    <!--                Dengan mencentang kotak di sebelah kiri saya menyatakan menyetujui dan paham dari isi surat penyerahan tuntutan-->
                    <!--                <a href="{{ URL::asset('assets/docs/Waifer presale FW samator.pdf'); }}" target="_blank" class="terms-tuntutan">Lihat Surat Penyerahan Tuntutan</a>-->
                    <!--            </label>-->
                    <!--        </div>-->

                    <!--        <div class="form-group">-->
                    <!--            <input class="agree-term" type="checkbox" name="terms_3" id="terms_3" />-->
                    <!--            <label for="terms_3" class="label-agree-term" style="color: #ffffff;"><span><span></span></span>-->
                    <!--                Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti semua update, promo, dan informasi Fitnessworks-->
                    <!--            </label>-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--</div>-->

                    <!--<button type="submit" class="btn btn-primary" style="float:right;" id="orderButton">Pembayaran</button>-->
                </div>
            </form>

        </div>
    </div>

</div>

// <script>
//     $(document).ready(function() {
//         $(':input[type="submit"]').prop('disabled', true);

//         $(".agree-term").change(function() {
//             if ($('#terms_1').is(':checked') && $('#terms_2').is(':checked') && $('#terms_3').is(':checked')) {
//                 $(':input[type="submit"]').prop('disabled', false);
//             } else {
//                 $(':input[type="submit"]').prop('disabled', true);
//             }
//         });
//     });
// </script>

@endsection