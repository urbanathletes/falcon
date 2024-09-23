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
            <h2 style="text-align:center; color:#ffffff;">Select a Membership Package</h2>
            <form method="POST" action="{{ route('falcon.packages.select') }}" id="select-package-form" class="signup-form">
                @csrf

                <div class="form-group">
                    @foreach($packages as $package)
                        <div class="row" style="padding-bottom: 1rem;">
                            <div class="col-sm-12">
                                <label style="color:#ffffff;">
                                    <input type="radio" name="package_id" value="{{ $package->id }}" required>
                                    {{ $package->name }} - {{ number_format($package->price, 0, ',', '.') }} IDR / {{ $package->duration }} Months
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" style="float:right;" id="selectButton">Proceed to Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
