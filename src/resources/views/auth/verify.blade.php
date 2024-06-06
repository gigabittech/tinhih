@extends('layouts.adminlayouts')

@section('body')
    <div class="login">
        <div class="row min-vh-100 m-0">
            <div class="col-lg-6 logo p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-8 logo-content">
                        <img class="pb-3" src="{{ asset('admin/assets/img/TINHIH-logo.png') }}" width="180" alt="Logo">
                        <h1>TINHIH Foundation</h1>
                        <img class="" src="{{ asset('admin/assets/img/user.png') }}" width="image-responsive"
                            alt="Logo">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-grid p-5 signup">
                <div class="row">
                    <p class="signup text-white-50 text-end">Login another account? <a href="{{ route('logout') }}">Login
                            in!</a></p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 form-content">
                        <h2 class="mb-5">Verify Your Email Address</h2>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="text-white">Before proceeding, please check your email for a verification link. If you did
                            not receive the email</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-primary w-100 login-button">{{ __('Click here to request another') }}</button>.
                        </form>
                    </div>
                </div>


                <!-- Login Page Form ends-->
            </div>
        </div>
    </div>
@endsection
