@php
    // $admin = auth()->user()->admin;
@endphp

@extends('admin.layout.template')

<style>
    .primary-text-color {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    input:focus,
    textarea:focus {
        border-color: #ffdd00 !important;
        outline: none;
    }

    .active-color {
        /* background-color: #ffdd00;
         */
        border-bottom: 2px solid #ffdd00;
    }

    /* Set the background color to yellow */
    .image-upload {
        position: relative;
        display: inline-block;
    }

    .image-upload input[type="file"] {
        display: none;
    }

    .image-upload-label {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .image-preview {
        width: 200px;
        height: 200px;
        border: 2px solid #007bff;
        position: relative;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .remove-image {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
@section('body')
    <div class="container-fluid bg-black pt-5 pb-5">
        <div class="col-lg-12">
            @if (Session::has('success'))
                @include('admin.includes.message.success')
            @elseif(Session::has('error'))
                @include('admin.includes.message.error')
            @endif
        </div>
        <div class="row" style="color:rgba(255, 255, 255, 0.6)">
            <div class="col-lg-12 ">
                <h6>Account Settings</h6>
                <span style="font-size: 13px;">
                    Account - Settings
                </span>
            </div>

            {{-- Account Details  --}}
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        {{-- <div class="card mt-3" style="background: #242424"> --}}
                        <div class="card mt-3 bg-dark" style="background: #242424">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    {{-- profile Image --}}
                                    <div class="me-4">
                                        <img class="rounded mb-2" width="160px" height="160px"
                                            src="{{ $admin->admin_image ? asset($admin->admin_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                            alt="user Image" />
                                    </div>
                                    {{-- Profile section --}}
                                    <div style="flex-grow: 1!important;">
                                        {{-- Profile Name --}}
                                        <div class="d-flex flex-column">
                                            <div class="align-items-center">
                                                <a href="javascript:void(0);" class="fw-bold fs-5 text-hover-primary"
                                                    style="color:rgba(255, 255, 255, 0.6); text-decoration:none;">
                                                    {{ $admin->first_name ?? '' }}
                                                    {{ $admin->last_name ?? '' }}
                                                </a>
                                            </div>
                                        </div>
                                        {{-- Profile Info --}}
                                        <div class="d-flex flex-wrap fw-semibold mt-3" style="font-size:12px;">
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                                </svg>
                                                Admin
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                </svg>{{ $admin->address }}
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-envelope me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                                </svg>
                                                {{ Auth::user()->email }}
                                            </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold mt-3" style="font-size:12px;">
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6); text-justify"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-file me-1" viewBox="0 0 16 16"
                                                    title="Note">
                                                    <path
                                                        d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                                                </svg>
                                                {{ $admin->note }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-1x border-transparent fs-5">
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('profile.admin') }}"
                                        class="nav-link fs-6 ms-0 me-3 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'profile.admin' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Overview</a>
                                </li>
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('profile.settings', ['id' => $admin->id]) }}"
                                        class="nav-link ms-0 me-3 fs-6 py-1 pb-2 px-0 {{ Route::currentRouteName() != 'profile.admin' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <div class="card mb-5 mb-xl-5 bg-dark1">
                            <div class="card-header d-flex" style="cursor: pointer;">
                                <div class="card-title">
                                    <h6 class="fw-semibold m-0">Profile Details</h6>
                                </div>
                                {{-- <a href="#" class="btn btn-sm btn-primary align-self-center ms-auto">Edit Profile</a> --}}
                            </div>
                            <div class="card-body">
                                <form
                                    @if ($admin != null) action="{{ route('admin.update', ['admin' => Auth::user()->id]) }}"

                                    @else
                                        action="{{ route('admin.store') }}" @endif
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <!--Image-->
                                    <div class="d-flex">
                                        <label for="" class="mb-1 col-lg-4">Avatar</label>
                                        <div class="col-lg-8">
                                            <label class="form-label text-dark m-1" for="customFile1"
                                                style="cursor: pointer;">
                                                <div class="mb-4 justify-content-center">
                                                    <img id="selectedImage"
                                                        src="{{ $admin->admin_image ? asset($admin->admin_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                                        alt="example placeholder" style="width: 125px;" class="rounded"
                                                        width="125px" height="125px" />
                                                    <input type="file" name="admin_image" class="form-control d-none"
                                                        id="customFile1"
                                                        onchange="displaySelectedImage(event, 'selectedImage')"
                                                        accept=".png, .jpg, .jpeg" />
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="first_name"
                                                        class="form-control  primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                        height="10px" placeholder="First name"
                                                        value="{{ $admin->first_name }}" style="height:40px">

                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="last_name"
                                                        class="form-control form-control-md primary-text-color  form-control-solid"
                                                        placeholder="Last name" value="{{ $admin->last_name }}"
                                                        style="height:40px">
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>

                                        <!--end::Row-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <input type="text" name="username"
                                                class="form-control  primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                height="10px" placeholder="Username"
                                                value="{{ $admin->admin->name ?? Auth()->user()->name }}"
                                                style="height:40px">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <input type="text" name="email"
                                                class="form-control  primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                height="10px" placeholder="Email" value="{{ Auth()->user()->email }}"
                                                style="height:40px">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Phone
                                            Number</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <input type="text" name="phone_number"
                                                class="form-control  primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                height="10px" placeholder="Phone Number"
                                                value="{{ $admin->phone_number }}" style="height:40px">
                                        </div>
                                    </div>
                                    <div class="row mb-6 ">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Date of
                                            Birth</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <input type="text" name="dob" id="datepicker"
                                                class="form-control active flatpickr-input primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                height="10px" placeholder="" value="{{ $admin->dob }}"
                                                style="height:40px" id="datepicker">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <input type="text" name="address" id="date"
                                                class="form-control primary-text-color form-control-md
                                                     form-control-solid mb-3"
                                                height="10px" placeholder="Address" value="{{ $admin->address }}"
                                                style="height:40px" id="datepicker">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Note</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <textarea name="note" id="" cols="30" rows="2"
                                                class="form-control primary-text-color form-control-md
                                            form-control-solid mb-3"
                                                placeholder="Note ....">{{ $admin->note }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6"></label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                            <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                // You can customize further options here
            });
        });
    </script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);

        };
        var loadNid = function(event) {

            var image = document.getElementById('nid');
            image.src = URL.createObjectURL(event.target.files[0]);

        };
    </script>

    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
