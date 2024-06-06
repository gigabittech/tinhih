@php
    $provider = auth()->user()->provider;
@endphp

@extends('admin.layout.template')

@section('extra-style')
    {{-- datatables style --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

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

    .swal2-confirm,
    .swal2-cancel-- {
        color: rgb(0, 0, 0) !important;
    }

    .custom-checkbox {
        display: none;
    }

    /* Hide the default checkbox */
    .custom-checkbox {
        display: none;
    }

    /* Style the custom checkbox */
    .custom-checkbox+label {
        display: inline-block;
        position: relative;
        padding-left: 30px;
        /* Adjust spacing */
        line-height: 20px;
        /* Match checkbox height */
        cursor: pointer;
    }

    /* Style the custom checkbox indicator */
    .custom-checkbox+label::before {
        content: "";
        position: absolute;
        bottom: -10;
        left: 10;
        width: 20px;
        /* Adjust checkbox width */
        height: 20px;
        /* Adjust checkbox height */
        border: 2px solid #636363;
        /* Border color */
        background-color: transparent;
        border-radius: 5px;
        /* Set transparent background */
    }

    /* Style the custom checkbox when checked */
    .custom-checkbox:checked+label::before {
        background-color: #ffdd00;
        /* Set background color when checked */
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
                                            src="{{ $provider->provider_image ? asset($provider->provider_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                            alt="user Image" />
                                    </div>
                                    {{-- Profile section --}}
                                    <div style="flex-grow: 1!important;">
                                        {{-- Profile Name --}}
                                        <div class="d-flex flex-column">
                                            <div class="align-items-center">
                                                <a href="javascript:void(0);" class="fw-bold fs-5 text-hover-primary"
                                                    style="color:rgba(255, 255, 255, 0.6); text-decoration:none;">
                                                    {{ $provider->first_name ?? '' }}
                                                    {{ $provider->last_name ?? '' }}
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
                                                Provider
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                </svg>{{ $provider->address }}
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
                                                {{ $provider->note }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-1x border-transparent fs-5">
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('provider.index') }}"
                                        class="nav-link fs-6 ms-0 me-3 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'provider.index' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Overview</a>
                                </li>
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('profile.admin') }}"
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
                            <div class="card-body profile-field">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form action="{{ route('provider.update', ['id' => $provider->user->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!--Image-->
                                            <div class="d-flex">
                                                <label for="" class="mb-1 col-lg-4">Avatar</label>
                                                <div class="col-lg-8">
                                                    <label class="form-label text-dark m-1" for="customFile1"
                                                        style="cursor: pointer;">
                                                        <div class="mb-4 justify-content-center">
                                                            <img id="selectedImage"
                                                                src="{{ $provider->provider_image ? asset($provider->provider_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                                                alt="example placeholder" style="width: 125px;"
                                                                class="rounded" width="125px" height="125px" />
                                                            <input type="file" name="provider_image"
                                                                class="form-control d-none" id="customFile1"
                                                                onchange="displaySelectedImage(event, 'selectedImage')"
                                                                accept=".png, .jpg, .jpeg" />
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full
                                                    Name</label>
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <!--begin::Row-->
                                                    <div class="row profile-field">
                                                        <!--begin::Col-->
                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="first_name"
                                                                class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                                height="10px" placeholder="First name"
                                                                value="{{ $provider->first_name }}" style="height:40px">

                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="last_name"
                                                                class="form-control form-control-md  primary-text-color  form-control-solid"
                                                                placeholder="Last name"
                                                                value="{{ $provider->last_name }}" style="height:40px">
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>

                                                <!--end::Row-->
                                            </div>
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label
                                                    class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="username"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Username"
                                                        value="{{ $provider->admin->name ?? Auth()->user()->name }}"
                                                        style="height:40px">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label
                                                    class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="email"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Email"
                                                        value="{{ Auth()->user()->email }}" style="height:40px">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Phone
                                                    Number</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="phone_number"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Phone Number"
                                                        value="{{ isset($provider->phone) ? $provider->phone : Auth::user()->phone }}"
                                                        style="height:40px">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Date of
                                                    Birth</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="dob" id="datepicker"
                                                        class="form-control active flatpickr-input  primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="" value="{{ $provider->dob }}"
                                                        style="height:40px" id="datepicker">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label
                                                    class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="address" id="date"
                                                        class="form-control  primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Address"
                                                        value="{{ $provider->address }}" style="height:40px"
                                                        id="datepicker">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label
                                                    class="col-lg-4 col-form-label required fw-semibold fs-6">Note</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <textarea name="note" id="" cols="30" rows="2"
                                                        class="form-control  primary-text-color form-control-md
                                                    form-control-solid mb-3"
                                                        placeholder="Note ....">{{ $provider->note }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6"></label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                    <button type="submit" class="btn btn-primary btn-sm">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12 profile-field">
                                                <h4 class="text-white pb-3">Add Provider Certification</h4>
                                                <form action="{{ route('drcertificate.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <select name="certification_id" class="form-control" required>
                                                        <option value="">Please Select a Certifications</option>
                                                        @foreach ($certifications as $certification)
                                                            <option value="{{ $certification->id }}">
                                                                {{ $certification->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div class="form-group">
                                                        <input type="hidden" value="{{ $provider->id }}"
                                                            name="provider_id" class="form-control" autocomplete="off"
                                                            required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-primary login-button w-100"
                                                            type="submit">Add
                                                            Provider Certification
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            {{-- Provider Specialization  --}}
                                            <div class="col-lg-12 profile-field">
                                                <h4 class="text-white mt-5 pb-3">Add Provider Specialization</h4>
                                                <form action="{{ route('drspecialization.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <select name="specialization_id" class="form-control" required>
                                                        <option value="">Please Select a Specializations</option>
                                                        @foreach ($specializations as $specialization)
                                                            <option value="{{ $specialization->id }}">
                                                                {{ $specialization->title }}</option>
                                                        @endforeach
                                                    </select>

                                                    <div class="form-group">
                                                        <input type="hidden" value="{{ $provider->id }}"
                                                            name="provider_id" class="form-control" autocomplete="off"
                                                            required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-primary login-button w-100"
                                                            type="submit">Add
                                                            Provider Specialization
                                                    </div>

                                                </form>
                                            </div>


                                            <div class="col-lg-12 mt-4">
                                                <h4 class="text-white">Schedule Slots</h4>
                                                <div class="card-body mb-5 rounded-3 table-responsive bg-black">
                                                    <table class="border-none w-100" id="table">
                                                        <thead class="text-light">
                                                            <tr>
                                                                <th scope="col">
                                                                    <input type="checkbox" id="selectAll"
                                                                        onclick="selectAll()"
                                                                        class="custom-checkbox mt-3">
                                                                    <label for="selectAll"></label>
                                                                </th>
                                                                <th scope="col">Start-Time</th>
                                                                <th scope="col">End-Time</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-light border-none">
                                                            @foreach ($provider_schedules as $i => $provider_schedule)
                                                                <tr>
                                                                    <td scope="row">
                                                                        <input type="checkbox"
                                                                            id="custom-checkbox_{{ $i }}"
                                                                            name="selectedIds[]" onclick="updateFormIds()"
                                                                            value="{{ $provider_schedule->id }}"
                                                                            class="custom-checkbox">
                                                                        <label
                                                                            for="custom-checkbox_{{ $i }}"></label>
                                                                    </td>
                                                                    <td>{{ $provider_schedule->start_time }}</td>
                                                                    <td>{{ $provider_schedule->end_time }}</td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                                                type="button"
                                                                                data-coreui-toggle="dropdown"
                                                                                aria-expanded="false">Actions
                                                                            </button>
                                                                            <ul class="dropdown-menu bg-black">
                                                                                <li class="dropdown-item text-light"
                                                                                    style="cursor: pointer;"
                                                                                    data-coreui-toggle="modal"
                                                                                    data-coreui-target="#exampleModal1{{ $provider_schedule->id }}">
                                                                                    Edit
                                                                                </li>

                                                                                <li class="dropdown-item text-light"
                                                                                    style="cursor: pointer;"
                                                                                    onclick="confirmDelete({{ $provider_schedule->id }})">
                                                                                    Delete
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td><!-- Button trigger modal -->
                                                                    <!-- Edit Modal Start-->
                                                                    <div class="modal fade"
                                                                        id="exampleModal1{{ $provider_schedule->id }}"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content bg-dark p-4">
                                                                                <h5 class="text-white mb-3">Update the
                                                                                    Sechedule
                                                                                    Information</h5>
                                                                                <form
                                                                                    action="{{ route('provider_schedule.update', $provider_schedule->id) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    <div class="profile-field">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="text-white">{{ $provider_schedule->start_time }}</label>
                                                                                            <input type="time"
                                                                                                name="start_time"
                                                                                                class="form-control"
                                                                                                value="{{ $provider_schedule->start_time }}">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="text-white">{{ $provider_schedule->end_time }}</label>
                                                                                            <input type="time"
                                                                                                name="end_time"
                                                                                                class="form-control"
                                                                                                value="{{ $provider_schedule->end_time }}">
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <button
                                                                                            class="btn btn-primary login-button w-100"
                                                                                            type="submit">Update
                                                                                            Schedule</button>
                                                                                    </div>


                                                                                </form>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-12 mt-4">
                                                <h4 class="text-white">Provider Schedule Slot</h4>
                                                <div class="bg-dark table-responsive">
                                                    <table class="responsive border-none bg-black rounded-3 "
                                                        id="table">
                                                        <thead class="text-light">
                                                            <tr>
                                                                <th scope="col">
                                                                    <input type="checkbox" id="selectAll"
                                                                        onclick="selectAll()"
                                                                        class="custom-checkbox mt-3">
                                                                    <label for="selectAll"></label>
                                                                </th>
                                                                <th scope="col">Start-Time</th>
                                                                <th scope="col">End-Time</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-light border-none">
                                                            @forelse ($provider_schedules as $i => $provider_schedule)
                                                                <tr>
                                                                    <td scope="row">
                                                                        <input type="checkbox"
                                                                            id="custom-checkbox_{{ $i }}"
                                                                            name="selectedIds[]" onclick="updateFormIds()"
                                                                            value="{{ $provider_schedule->id }}"
                                                                            class="custom-checkbox">
                                                                        <label
                                                                            for="custom-checkbox_{{ $i }}"></label>
                                                                    </td>
                                                                    <td>{{ $provider_schedule->start_time }}</td>
                                                                    <td>{{ $provider_schedule->end_time }}</td>

                                                                    <td class="">
                                                                        <div class="d-flex gap-2">
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-primary"
                                                                                data-coreui-toggle="modal"
                                                                                data-coreui-target="#exampleModal1{{ $provider_schedule->id }}">Edit</button>
                                                                            <button type="button"
                                                                                class="text-white btn btn-sm btn-danger"
                                                                                data-coreui-toggle="modal"
                                                                                data-coreui-target="#exampleModal{{ $provider_schedule->id }}">Delete</button>
                                                                        </div>
                                                                    </td>

                                                                    <!-- Edit Modal Start-->
                                                                    <div class="modal fade"
                                                                        id="exampleModal1{{ $provider_schedule->id }}"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content bg-dark p-4">
                                                                                <h5 class="text-white mb-3">Update the
                                                                                    Sechedule
                                                                                    Information</h5>
                                                                                <form
                                                                                    action="{{ route('provider_schedule.update', $provider_schedule->id) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    <div class="profile-field">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="text-white">{{ $provider_schedule->start_time }}</label>
                                                                                            <input type="time"
                                                                                                name="start_time"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="text-white">{{ $provider_schedule->end_time }}</label>
                                                                                            <input type="time"
                                                                                                name="end_time"
                                                                                                class="form-control">
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <button
                                                                                            class="btn btn-primary login-button w-100"
                                                                                            type="submit">Update
                                                                                            Schedule</button>
                                                                                    </div>


                                                                                </form>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> --}}

                                            {{-- Provider Schedule Start --}}
                                            <div class="col-lg-12 profile-field">
                                                <h4 class="text-white mt-5 pb-3">Provider Schedule</h4>
                                                <form action="{{ route('provider_schedule.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group">
                                                        <input type="hidden" value="{{ $provider->id }}"
                                                            name="provider_id" class="form-control" autocomplete="off">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="labels">Start Time</label>
                                                        <input type="time" id= "start_time" name="start_time"
                                                            class="form-control" autocomplete="off" @required(true)
                                                            format="hh:mm a" step="60" value="00:00 AM">
                                                        <span
                                                            class="text-primary mt-0 pb-2">{{ $errors->has('start_time') ? $errors->first('start_time') : '' }}</span>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="labels">End Time</label>
                                                        <input type="time" id= "end_time" name="end_time"
                                                            class="form-control" autocomplete="off" required="required"
                                                            format="hh:mm a" step="60" @required(true)>
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <label class="labels">End Time</label>
                                                        <input type="time" name="end_time" class="form-control" autocomplete="off"
                                                            required="required" format="hh:mm a" step="60">
                                                    </div> --}}

                                                    <div class="form-group">
                                                        <button class="btn btn-primary login-button w-100" type="submit"
                                                            onclick="validateForm()">Add
                                                            Provider Schedule
                                                    </div>

                                                </form>
                                            </div>
                                            {{-- Provider Schedule End --}}

                                        </div>

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({});
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(val) {
            var selectedIds;
            if (val === 0) {
                selectedIds = $('#formIds').val().split(',');
                console.log('Frontend: ' + selectedIds);
            }
            Swal.fire({
                title: "Are you sure to delete selected Schedule?",
                text: "This will delete selected schedule permanently. You cannot undo this action.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffdd00",
                confirmButtonTextColor: "rgba(255, 255, 255, 0.6)",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                background: '#343a40',
                color: 'rgba(255, 255, 255, 0.6)'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    // Perform the AJAX delete request
                    $.ajax({
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: val > 0 ? 'DELETE' : 'POST',
                            selectedIds: selectedIds,
                        },
                        url: val > 0 ? "{{ route('provider_schedule.destroy', ':id') }} ".replace(
                            ':id', val) : "#",
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your selected schedule has been deleted. Redirecting .....",
                                icon: "success",
                                background: '#343a40',
                                confirmButtonColor: '#ffdd00',
                                color: 'rgba(255, 255, 255, 0.6)',

                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1050);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to handle this request.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
    <script>
        function validateForm() {
            if ($('#start_time').val() == '') {
                alert($('#start_time').val());
                return false;
            }
        }
    </script>
@endsection
