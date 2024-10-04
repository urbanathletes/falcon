@extends('master2')

@section('content')

<style>
    .swal2-modal {
        width: 850px !important;
    }

    .title-promo {
        text-align: left;
        margin-bottom: 10px;
        margin-top: 5px;
        color: #ffb800;
        font-size: 25px;
        letter-spacing: -1px;
    }

    .desc-promo {
        color: #ffffff;
        font-size: 25px;
        text-align: justify;
        margin-bottom: 0px;
    }

    .jul-one {
        font-size: 35px;
        font-weight: 800;
    }

    .spacer {
        margin-bottom: 150px;
    }

    .spacer-p0 {
        margin-bottom: 40px;
    }

    .ig {
        width: 279px;
        height: 37px;
    }

    .form-title {
        text-align: left;
        font-size: 22px;
        max-width: 100%;
        word-wrap: break-word;
        letter-spacing: 1px;
        color: #ffffff;
    }

    @media only screen and (max-device-width: 640px) {
        .title-promo {
            font-size: 16px;
        }

        .desc-promo {
            font-weight: 700;
            font-size: 14px;

        }

        .jul-one {
            font-size: 18px;
        }

        .spacer {
            margin-bottom: 50px;
        }

        .ig {
            width: 200px;
            height: 25px;
        }

        .spacer-p0 {
            margin-bottom: 0;
        }

        .form-title {
            text-align: left;
            font-weight: 700;
            font-size: 16px;
            word-wrap: break-word;
            letter-spacing: 1px;
            color: #ffffff;
        }

    }
</style>

<div class="main">

    <section class="signup">
        <div class="container-sm">
            <div class="row">
                <div class="col-sm-7">
                    <img src="assets/img/logo falcon putih_Website.png" alt="" class="img-logo" style="margin-bottom: 20px; width: 653px; height: 69px; object-fit: contain; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.5));">
                    <br>
                    <div class="spacer-p0"></div>
                    <p class="jul-one" style="line-height: 1.2;text-transform: uppercase;">
                        <span style="color: #Ffff;font: Poppins; font-weight:bold">
                            Be the first to experience a new <br>
                            workout sensation! Secure your<br>
                            exclusive presale offer for the<br>
                            Falcon Fitness Box now!
                        </span>
                    </p>
                    <br>
                    <div class="spacer-p0"></div>
                    <p class="desc-promo" style="font-style: Poppins; font-weight: 700;">
                        FALCON FITNESS BOX community that leverages technology and functional training to create high-intensity group workouts that are efficient, fun, and results-oriented. Hanya selama
                        <class="form-title" style="text-align: left; font-weight: 700;color: #FECC09; font-style: poppins;">
                            Only during the Presale Period Join Members from Rp 800K
                    </p>
                    <div class="spacer"></div>
                    <div class="ig" style="position: relative;">
                        <a href="https://www.instagram.com/fitnessworks.id/?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw%3D%3D">
                            <img src="assets/img/icon IG wensite.png" alt="" style="position: absolute; bottom: 0; right: 0; width: 100%; height: 100%; margin-bottom: 20px; object-fit: contain;">
                    </div>
                    </a>
                </div>
                <div class="col-sm-5">
                    <div class="signup-content">

                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                        @endif

                        <!-- Way 1: Display All Error Messages -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- <form method="POST" id="signup-form" class="signup-form"> -->
                        <form action="{{ route('falconlong.checkout') }}" method="POST">
                            {{ csrf_field() }}
                            <h2 class="form-title">Come join us and connect
                                with the community
                            </h2>
                            <div class="form-group">
                                <label for="full_name" class="normal" style="font-weight: 600;margin-left: 5px;color:#ffffff;">Nama
                                    Lengkap<span style="color:red;"> *</span></label>
                                <input type="text" class="form-input" name="name" id="name" placeholder="" required />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="normal" style="font-weight: 600;margin-left: 5px;color:#ffffff;">Email<span style="color:red;"> *</span></label>
                                <input type="email" class="form-input" name="email" id="email" placeholder="" required />
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone" class="normal" style="font-weight: 600;margin-left: 5px;color:#ffffff;">No
                                    Handphone<span style="color:red;"> *</span></label>
                                <input type="text" class="form-input number" name="phone" id="phone" placeholder="" required />
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="club_id" class="normal" style="font-weight: 600;margin-left: 5px;color:#ffffff;">Club yang
                                    dipilih<span style="color:red;"> *</span></label>
                                <!-- <select class="form-select" id="club_id" name="club_id" data-placeholder="Pilih club" <?= ($withClub ? "disabled" : "") ?>>
                                    <?php foreach ($club as $r => $v) { ?>
                                        <option value="{{ $v->id }}" <?= ($v->is_active == 0 ? "disabled" : "") ?>>
                                            {{ $v->name }}
                                            <?= ($v->is_active == 0 ? "<p style='text-align:right;font-color:red;font-size:10px;'>(Coming Soon)</p>" : "") ?>
                                        </option>
                                    <?php } ?>
                                </select> -->
                                <select class="form-select" id="club_id" name="club_id" data-placeholder="Pilih club" <?= ($withClub ? "disabled" : "readonly") ?>>
                                    <?php foreach ($club as $v) {
                                        if ($v->id == 13) { ?>
                                            <option value="<?= $v->id ?>" <?= ($v->is_active == 0 ? "disabled" : "") ?>>
                                                <?= $v->name ?>
                                                <?= ($v->is_active == 0 ? "<span style='color:red; font-size:10px;'> (Coming Soon)</span>" : "") ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <!-- <input type="button" name="benefit" id="benefit" class="button-benefit" value="Member Benefit" /> -->
                                <input type="submit" name="submit" id="real-submit" class="form-submit" value="Daftar Pre-sale" />
                                <!-- <input type="submit" name="submit" id="real-submit" class="form-submit" style="display:none;" /> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

<script>
    $(".button-benefit").click(function() {
        Swal.fire({
            html: '<p style="color:#ffffff" class="header-rule-1">Member Benefit Fitnessworks :</p>' +
                '<div class="row d-flex justify-content-center">' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-1.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis akses puluhan jenis exersice</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-2.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis fasilitas area Gym premium</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-3.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis akses fasilitas studio eksklusif</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-4.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis cek komposisi tubuh (In Body)</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-5.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis fasilitas konsultasi dengan Personal Trainer</p></div>' +
                '</div>',
            customClass: 'swal-wide',
            showCloseButton: true,
            showConfirmButton: false,
            background: '#190f41',
        })
    });

    $(".term-service").click(function() {
        Swal.fire({
            html: '<p style="color:#000000;font-weight:bold;">Paket Membership</p>' +
                '<table style="color:#000000;width:100%;font-size:14px;"><tbody> ' +
                '<tr><td style="vertical-align: top;">Special Periode Presale</td><td>IDR. 808,000</td></tr>' +
                '<tr><td style="vertical-align: top;">Total</td><td>IDR. 808,000</td></tr>' +
                '</tbody></table>' +
                '<div style="text-align:left;margin-top:10px;"><input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
                '<label for="agree-term" class="label-agree-term" style="color:black;"><span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti semua update, promo, dan informasi Fitnessworks</label>' +
                '<hr>',
            showCloseButton: true,
            showConfirmButton: false,
            background: '#190f41',
        })
    });



    $('#submit').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            html: '<div style="width:100%; padding:30px; box-sizing:border-box;">' +
                '<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px;">' +
                '<img src="../assets/img/checkout-samator.png" alt="" style="width:100px; width:339px; height:66px; margin-right: 10px;">' +
                '<div style="color :#000000;font-size:24px; font-weight:bold; margin-left:10px;"><br>CHECKOUT SEKARANG !!!</div>' +
                '</div>' +
                '<table style="color:#000000; width:100%; font-size:14px; border-collapse:collapse; margin-top: 20px;"><tbody>' +
                '<tr style="border-bottom:1px solid #000;"><td style="vertical-align:top;color:#000000;">Paket Membership</td><td style="text-align:right;">Price</td></tr>' +
                '<tr style="border-bottom:1px solid #000;"><td style="vertical-align:top;color:#000000;">Special Periode Presale</td><td style="text-align:right;">IDR. 225,500</td></tr>' +
                '<td style="vertical-align:top;">Total</td><td style="text-align:right;">IDR. 808,000</td></tr>' +
                '</tbody></table>' +
                '<div style="text-align:left; margin-top:10px;">' +
                '<input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
                '<label for="agree-term" class="label-agree-term" style="color:black;">' +
                '<span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti <br>' +
                'semua update, promo, dan informasi Fitnessworks' +
                '</label>' +
                '</div>' +
                '<hr>' +
                '</div>',
            background: '#ffff',
            showCloseButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#261F53;',
            confirmButtonText: 'Pembayaran',
        }).then((result) => {
            if ($('#agree-term').is(':checked')) {
                if (result.isConfirmed) {
                    $("#club_id").prop("disabled", false);
                    $('#real-submit').trigger('click');
                }
            } else {
                Swal.fire('Syarat & Ketentuan harus di setujui', '', 'error')
            }
        });
    });

    function selectTime(elem) {
        var value = elem.getAttribute('value');
        $('.btn-time').removeClass("btn-active");
        if ($(elem).hasClass("btn-active")) {
            $(elem).removeClass("btn-active");
        } else {
            $(elem).addClass("btn-active");
            $('#time_call').val(value);
        }
    }

    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        };
    }(jQuery));
    $(document).ready(function() {
        $(".number").inputFilter(function(value) {
            return /^\d*$/.test(value); // Allow digits only, using a RegExp
        });
    });
</script>
@endsection