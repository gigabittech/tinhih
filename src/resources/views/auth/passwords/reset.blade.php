@extends('layouts.adminlayouts')

@section('body')

<div class="login">
    <div class="row min-vh-100 m-0">
        <div class="col-lg-6 logo p-0">
            <div class="row justify-content-center">
                <div class="col-lg-8 logo-content">
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
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 form-content">
                    <h2 class="mb-5">Reset Your Password</h2>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100 login-button">
                                    {{ __('Reset Password') }}
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
