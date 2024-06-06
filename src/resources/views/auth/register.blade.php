@extends('layouts.adminlayouts')

@section('body')
    <div class="login">
        <div class="row min-vh-100 m-0">
            <style>
                .text-yellow {
                    color: yellow;
                    font-weight: bold;
                }
            </style>

            <div class="col-lg-6 logo p-0" style="align-items:center;">
                <div class="">
                    <div class="col-lg-12 logo-content">
                        <img class="pb-3" src="{{ asset('admin/assets/img/TINHIH-logo.png') }}" width="180" alt="Logo">
                        <h1 style="font-size: 45px; color:rgb(92, 91, 91);">TINHIH Foundation</h1>
                        <img class="" src="{{ asset('admin/assets/img/register-user.png') }}" width="image-responsive"
                            alt="Logo">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-grid p-5 signup">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="signup text-white-50 text-end">Have an account? <a href="{{ route('login') }}">Sign
                                in!</a></p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-11 form-content">
                        <h2>Get Started With TINHIH</h2>
                        <p>Getting started is easy</p>

                        <a class="login-btn" href="{{ route('login.google') }}">
                            <i class="fa-brands fa-google"></i> Sign in With Google</a>
                        <a class="login-btn" href=""><i class="fa-brands fa-facebook"></i> Sign in With Facebook</a>
                        <p class="line">Or continue with</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group g-0">

                                        <input id="first_name" placeholder="First Name" type="text"
                                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                            value="{{ old('first_name') }}" required autocomplete="first_name">

                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow mb-12">
                                                    Special character is not available for First name
                                                </strong>
                                            </div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group g-0">
                                        <input id="last_name" placeholder="Last Name" type="text"
                                            class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name') }}" required autocomplete="last_name">

                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow mb-12">
                                                    Special character is not available for Last Name
                                                </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="input-group g-0">
                                        <input id="name" placeholder="Username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow mb-12">
                                                    Special characters are not available for Username
                                                </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="email" placeholder="Email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow">
                                                    {{ $message }}
                                                </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for=""></label>
                                    <div class="input-group mb-3">
                                        <input id="phone" placeholder="Phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" required autocomplete="name" autofocus>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow">
                                                    {{ $message }}
                                                </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="datepicker" placeholder="Date of Birth" type="date"
                                            class="form-control @error('dob') is-invalid @enderror" name="dob"
                                            value="{{ old('dob') }}" required autocomplete="dob">
                                        @error('dob')
                                            <div class="invalid-feedback">
                                                <strong class="text-yellow">
                                                    {{ $message }}
                                                </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="address" placeholder="Address" type="text" class="form-control"
                                            name="address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group rounded">
                                            <select name="type" class="form-control rounded-3 py-2 rounded" required>
                                                <option value="" class="p-5 rounded">Please Select the Type</option>
                                                <option value="client" class="rounded p-5">Client</option>
                                                {{-- <option value="provider" class="rounded p-5">Provider</option> --}}
                                                <option value="community_member " class="rounded p-5">Community Member
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input id="password" placeholder="Password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-4">
                                        <input id="password-confirm" placeholder="Repeat password" type="password"
                                            class="form-control" name="password_confirmation" required
                                            autocomplete="new-password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-8">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary login-button"
                                        style=" width: 104% !important;">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <div class="col-md-12 pt-4">
                                    <p>By continuing you indicate that you read and agreed to the Terms of Use.</p>
                                </div>
                            </div>

                        </form>
                        <!-- Register Page Form ends-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            // You can customize further options here
        });
    });
</script>
