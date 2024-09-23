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
            <h2 style="text-align:center; color:#ffffff;">Enter Your Details</h2>
            <form method="POST" action="{{ route('falcon.saveInfo') }}" id="info-form" class="signup-form">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" required>
                </div>
                <input type="hidden" name="club_id" value="16"> <!-- Assuming Falcon club ID is 16 -->
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" style="float:right;">Next: Select Package</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection