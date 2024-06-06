@extends('layouts.adminlayouts')

@section('body')
    <style>
        .invalid-feedback {
            font-size: 12px;
            margin-top: 0.3rem;
            margin-bottom: 2px;


        }

        input.form-control {
            color: black;
        }

        ;
    </style>
    <div class="login">
        <div class="row min-vh-100 m-0">
            <div class="col-lg-6 logo p-0">
                <div class="justify-content-center">
                    <div class="col-lg-12 logo-content">
                        <img class="pb-3" src="{{ asset('admin/assets/img/TINHIH-logo.png') }}" width="180" alt="Logo">
                        <h1 style="color: rgb(92, 91, 91)">TINHIH Portal</h1>
                        <img class="" src="{{ asset('admin/assets/img/user.png') }}" width="image-responsive"
                            alt="Logo">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-grid p-5 signup">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="signup text-white text-end">Don’t have an account? <a href="{{ route('register') }}">Sign
                                up!</a></p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 form-content">
                        <h2>Welcome Back</h2>
                        <p>Sign in to your TINHIH Account</p>

                        <a class="login-btn" href="{{ route('login.google') }}">
                            <i class="fa-brands fa-google"></i> Sign in With Google</a>
                        <a class="login-btn" href=""><i class="fa-brands fa-facebook"></i> Sign in With Facebook</a>
                        <p class="line">Or continue with</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-12">
                                <div class="col-lg-12 input-group mb-3">
                                    <input id="email" placeholder="Email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="input-group mb-3">

                                    <input id="password" placeholder="Password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 pb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 btn btn-link text-end forgot">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot password?') }}
                                        </a>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4 w-100 login-button">
                                        {{ __('Login') }}
                                    </button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>


                <!-- Login Page Form ends-->
            </div>
        </div>
    </div>
@endsection


<script></script>
