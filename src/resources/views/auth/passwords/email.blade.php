@extends('layouts.adminlayouts')

@section('body')

<div class="login">
    <div class="row min-vh-100 m-0">
        <div class="col-lg-6 logo p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 logo-content">
                    <img class="pb-3" src="{{ asset('admin/assets/img/TINHIH-logo.png') }}" width="180"
                 alt="Logo">
                 <h1>TINHIH Foundation</h1>
                 <img class="" src="{{ asset('admin/assets/img/user.png') }}" width="image-responsive"
              alt="Logo">
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-grid p-5 signup">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="d-flex justify-content-end">
                        <div class="col-lg-12">
                        <p class="signup text-white text-end">Don’t have an account? <a href="{{ route('register') }}">Sign up!</a></p>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 form-content">
                    <h2>Recover Password</h2>
                    <p>Enter your registered email below to receive password reset code</p>
    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <input id="email" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100 login-button">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0">
                            
                        </div>
                    </form>
                </div>
            </div>

            
            <!-- Login Page Form ends-->
        </div>
    </div>
</div>
  

@endsection

