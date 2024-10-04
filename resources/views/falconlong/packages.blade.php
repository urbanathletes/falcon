@extends('master3')

@section('content')

<style>
    /* Global Styles */
    body {
        background-color: #000;
        color: #000000;
        font-family: 'Arial', sans-serif;
    }

    /* Card Styles */
    .card {
        background-color: #252525;
        border-radius: 10px;
        border: 1px solid #fff;
        color: #FECC09;
        min-height: 350px;
        /* Ensures uniform card height */
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Adds subtle shadow for card separation */
    }

    .card-header {
        background-color:#570902;
        color: #FECC09;
        border-radius: 10px 10px 0 0;
        text-align: center;
        padding: 10px 0;
        font-weight: bold;
    }

    .card-body {
        background-color: #000000;
        color: #ffffff;
        padding: 20px;
        text-align: center;
    }

    .card-title {
        color: #ffffff;
        /* Orange for the package name */
        font-weight: bold;
        font-size: 18px;
    }

    .card-subtitle {
        color: #ffffff;
        font-size: 16px;
    }

    .card-text {
        margin-top: 10px;
        font-size: 16px;
        color: #ffffff;
    }

    .text-muted {
        font-size: 14px;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .text-color-white {
        color: #ffffff;
    }

    /* Radio Button */
    input[type="radio"] {
        margin-right: 10px;
    }

    /* Button Styles */
    .btn-primary {
        background-color: #570902;
        border: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #570902;
    }

    /* Grid System for Cards */
    .col-md-2,
    .col-sm-6 {
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Mobile Adjustments */
    @media (max-width: 576px) {
        .card {
            width: 100%;
            /* Full width on mobile */
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            font-size: 18px;
        }
    }
</style>

<div class="container-md p-0">
    <div class="signup-content-second h100vh">
        <div class="signup-desc">
            <div class="signup-desc-content text-center">
                <img src="assets/img/logo falcon red_Website.png" alt="" class="img-fluid img-logo">
            </div>
        </div>
        <div class="signup-form-content text-center">
            <h2 style="color: #fff; font-weight: bold;">Presale Early Bird Packages</h2>
            <!--<form method="POST" action="{{ route('falconlong.packages.select') }}" id="package-form" class="signup-form">-->
            <!--<form action="{{ route('falconlong.order') }}" method="POST">-->
            <form action="{{ route('falconlong.checkout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-center">
                        @foreach($packages as $package)
                        <div class="col-md-2 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    {{ $package->name }}
                                    <h6 class="card-title">IDR {{ number_format($package->price, 0, ',', '.') }} /</h6>
                                    <p class="card-text">{{ $package->month }} Months</p>
                                </div>
                                <div class="card-body">
                                    @if($package->id == 1475)
                                    <p class="text-color-white">(+ Rp. 488.000) cost for Myzone Heart Rate Tracker</p>
                                    @elseif($package->id == 1476)
                                    <p class="text-color-white">(+ Rp. 688.000) cost for Myzone Heart Rate Tracker</p>
                                    @elseif($package->id == 1477)
                                    <p class="text-color-white">(+ Rp. 588.000) cost for Myzone Heart Rate Tracker</p>
                                    @elseif($package->id == 1478)
                                    <p class="text-color-white">(+ Rp. 488.000) cost for Myzone Heart Rate Tracker</p>
                                    @elseif($package->id == 1479)
                                    <p class="text-color-white">FREE Myzone Heart Rate Tracker</p>
                                    @endif
                                    <label class="d-block mt-3">
                                        <input type="radio" name="package_id" value="{{ $package->id }}" required>
                                        Choose Package
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" style="float:right;">Next: Proceed to Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection