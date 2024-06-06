@extends('admin.layout.template')

@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid h-100vh p-5 bg-black">
        <div class="row">
            <div class="col-lg-6">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
            </div>
            <h4 class="text-white mb-4"><strong>Add New Provider</strong></h4>

            <div class="col-sm-6 col-lg-12 profile-field">
                <div class="card-body bg-dark bg-dark1 p-5">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}">
                        @csrf
                        <!-- Add this code after each input field -->
                        <div class="form-group">
                            @error('name')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="text" placeholder="User Name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            @error('email')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="text" placeholder="Email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            @error('phone')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="text" placeholder="Phone" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            @error('dob')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="date" id='datepicker' placeholder="Date Of Birth" name="dob"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            @error('password')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="password" placeholder="Password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            @error('password_confirmation')
                                <span class="text-primary">{{ $message }}</span>
                            @enderror
                            <input type="password" placeholder="Confirm Password" name="password_confirmation"
                                class="form-control">
                        </div>
                        <!-- Add other user fields as needed -->
                        <div class="form-group">
                            <button class="btn btn-primary login-button w-100" type="submit">Add New Provider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
