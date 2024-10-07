@extends('master4')

@section('content')
<style>
    /* Pastikan elemen .login-background mencakup seluruh layar */
    .login-background {
        height: 85vh;
        /* Membuat tinggi background 100% dari viewport */
    }

    .container {
        height: 100%;
        /* Pastikan tinggi kontainer 100% */
    }

    .card {
        background-color: rgba(255, 255, 255, 0.9);
        /* Membuat card sedikit transparan */
        border-radius: 10px;
        /* Membuat border card lebih halus */
    }

    .card-header{
        background-color: #570902 !important;
        color: #ffffff !important;
    }
</style>
<div class="login-background">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header text-white text-center">{{ __('Login') }}</div>
                    <div class="card-body p-4">
                        <!-- Menampilkan pesan error jika ada -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Form login -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- <div class="form-group mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div> -->

                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn-login px-4">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection