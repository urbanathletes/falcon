@extends('master3')

@section('content')
<div class="container-md p0">
    <div class="signup-content-second h100vh">
        <div class="signup-desc">
            <div class="signup-desc-content" style="padding-left: 30px;padding-right: 30px;text-align:center;">
                <img src="assets/img/logo falcon red_Website.png" alt="" class="img-fluid img-logo">
            </div>
        </div>
        <div class="signup-form-conent">
            <h2 style="text-align:center; color:#ffffff;">Order Complete</h2>

            <div class="form-group">
                <h4 style="color: #fff;">Your Order Details</h4>
                <p>Package: {{ $packageMembership->name }}</p>
                <p>Duration: {{ $packageMembership->duration }} Months</p>
                <p>Price: IDR {{ number_format($packageMembership->price) }}</p>
                <p>Transaction ID: {{ $data['transaction_id'] ?? 'N/A' }}</p>
            </div>

            <div class="form-group">
                <h4 style="color: #fff;">Thank you for your order!</h4>
                <p>Please check your email for the confirmation details.</p>
            </div>
        </div>
    </div>
</div>
@endsection