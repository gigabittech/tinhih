@php
    $community_member = auth()->user()->community_member;
@endphp


@extends('admin.layout.template')

<style>
    .primary-text-color {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: #ffdd00 !important;
        outline: none;
    }

    select {
        background: transparent !important;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    select>option {
        background: rgb(64, 64, 66) !important;
    }

    select:hover {
        background: rgb(0, 0, 0) !important;
    }

    select option:checked {
        background: gray !important;
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
                        <div class="card mt-3 bg-dark" style="background: #242424">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    {{-- profile Image --}}
                                    <div class="me-4">
                                        <img class="rounded" width="160px" height="160px"v
                                            src="{{ $community_member->community_member_image ? asset($community_member->community_member_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                            alt="user Image" />
                                    </div>
                                    {{-- Profile section --}}
                                    <div style="flex-grow: 1!important;">
                                        {{-- Profile Name --}}
                                        <div class="d-flex flex-column">
                                            <div class="align-items-center">
                                                <a href="javascript:void(0);" class="fw-bold fs-5 text-hover-primary"
                                                    style="color:rgba(255, 255, 255, 0.6); text-decoration:none;">
                                                    {{ $community_member->full_name ?? '' }}
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
                                                Community Member
                                            </a>
                                            {{-- <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                </svg>{{ $community_member->address ?? }}
                                            </a> --}}
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
                                                {{ $community_member->note }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-1x border-transparent fs-5">
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('community_member.index') }}"
                                        class="nav-link fs-6 ms-0 me-3 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'community_member.index' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Overview</a>
                                </li>
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('community_member.profile.settings', ['id' => $community_member->id]) }}"
                                        class="nav-link ms-0 me-3 fs-6 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'community_member.profile.settings' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <div class="card mb-5 mb-xl-5 bg-dark1">
                            <div class="card-header d-flex" style="cursor: pointer;">
                                <div class="card-title">
                                    <h6 class="fw-semibold m-0 fs-5">Profile Details</h6>
                                </div>

                                {{-- <a href="#" class="btn btn-sm btn-primary align-self-center ms-auto">Edit Profile</a> --}}
                            </div>

                            <div class="card-body">
                                <form action="{{ route('community_member.update', ['id' => auth()->user()->id]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <!--Image-->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Personal Information</h6>
                                            <hr>
                                            <div class="d-flex">
                                                <label for="" class="mb-1 col-lg-4">Avatar</label>
                                                <div class="col-lg-8">
                                                    <label class="form-label text-dark m-1" for="customFile1"
                                                        style="cursor: pointer;">
                                                        <div class="mb-4 justify-content-center">
                                                            <img id="selectedImage"
                                                                src="{{ $community_member->community_member_image ? asset($community_member->community_member_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                                                alt="example placeholder" style="width: 125px;"
                                                                class="rounded" width="125px" height="125px" />
                                                            <input type="file" name="community_member_image"
                                                                class="form-control d-none" id="customFile1"
                                                                onchange="displaySelectedImage(event, 'selectedImage')"
                                                                accept=".png, .jpg, .jpeg" />
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="mb-1 col-lg-4">Full
                                                    Name</label>
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-12 fv-row fv-plugins-icon-container profile-field">
                                                            <input type="text" name="full_name"
                                                                class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                                height="10px" placeholder="Full Name"
                                                                value="{{ $community_member->full_name }}"
                                                                style="height:40px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Date of
                                                    Birth</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="dob" id="datepicker"
                                                        class="form-control active flatpickr-input  primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder=""
                                                        value="{{ $community_member->dob }}" style="height:40px"
                                                        id="datepicker">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="mb-1 col-lg-4">Gender</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <select class="form-select" name="gender"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Your Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                        <option value="3">Non Binary</option>
                                                        <option value="4">Prefer Not to say</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Phone
                                                    Number</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="emergency_contact"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Phone Number"
                                                        value="{{ $community_member->emergency_contact }}"
                                                        style="height:40px">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Mailing
                                                    Address</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="mailing_address"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Mailing Address"
                                                        value="{{ $community_member->mailing_address }}"
                                                        style="height:40px">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Email</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="email"
                                                        class="form-control   primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="Email"
                                                        value="{{ Auth()->user()->email }}" style="height:40px">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="card-title">Recovery Information</h6>
                                            <hr>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Recovery
                                                    Date</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="recovery_date" id="datepicker"
                                                        class="form-control active flatpickr-input  primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder="" value="{{ today() }}"
                                                        style="height:40px" id="datepicker">
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-4">Recovery
                                                    Program Chosen</label>
                                                <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field">
                                                    <input type="text" name="recovery_program"
                                                        class="form-control  primary-text-color form-control-md
                                                             form-control-solid mb-3"
                                                        height="10px" placeholder=""
                                                        value="{{ $community_member->recovery_program }}"
                                                        style="height:40px">
                                                </div>
                                            </div>
                                            <h6 class="card-title">Peer Recovery Support Services</h6>
                                            <div class="row mb-6">
                                                <label class="mb-2 col-lg-4">Do you
                                                    have a desire for peer recovery support services? </label>
                                                <div class="col-lg-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="support_services" id="inlineRadio1" value="1"
                                                            {{ $community_member->support_services == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="support_services" id="inlineRadio2" value="2"
                                                            {{ $community_member->support_services == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="support_services" id="inlineRadio2" value="3"
                                                            {{ $community_member->support_services == 3 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Not
                                                            Sure</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                @php
                                                    $additionalInfoArray = json_decode(
                                                        $community_member->additional_info,
                                                    );
                                                @endphp
                                                <label class="mb-1 col-lg-4">How did you hear about our recovery
                                                    program?</label>
                                                <div class="col-lg-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="additional_info[]"
                                                            type="checkbox" id="inlineCheckbox1" value="1"
                                                            {{ isset($additionalInfoArray) && in_array('1', $additionalInfoArray) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="inlineCheckbox1">Internet/Search Engine</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="additional_info[]"
                                                            type="checkbox" id="inlineCheckbox2" value="2"
                                                            {{ isset($additionalInfoArray) && in_array('2', $additionalInfoArray) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox2">Healthcare
                                                            Provider</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="additional_info[]"
                                                            type="checkbox" id="inlineCheckbox3" value="3"
                                                            {{ isset($additionalInfoArray) && in_array('3', $additionalInfoArray) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="inlineCheckbox3">Friend/Family</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="additional_info[]"
                                                            type="checkbox" id="inlineCheckbox4" value="4"
                                                            {{ isset($additionalInfoArray) && in_array('4', $additionalInfoArray) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox4">Support
                                                            Group</label>
                                                    </div>
                                                    @php
                                                        $value = '';
                                                        $additionalInfoArray = $additionalInfoArray ?? [];
                                                        $lastElement = end($additionalInfoArray);
                                                        // dd($lastElement);
                                                        if (
                                                            !empty($additionalInfoArray) &&
                                                            $lastElement !== false &&
                                                            strlen($lastElement) > 1
                                                        ) {
                                                            $value = $lastElement;
                                                        }
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkbox"
                                                            value="5" name="additional_info[]"
                                                            {{ isset($additionalInfoArray) && in_array('5', $additionalInfoArray) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox5">Other
                                                            (please specify)</label>
                                                    </div>
                                                    <div class="col-lg-8 fv-row fv-plugins-icon-container profile-field"
                                                        id="inputFieldContainer"
                                                        style="display:{{ isset($additionalInfoArray) && in_array('5', $additionalInfoArray) && strlen($value) > 0 ? 'block' : 'none' }};">

                                                        <input type="text" name="additional_info[]" id="inputField"
                                                            class="form-control   primary-text-color form-control-md
                                                                 form-control-solid mb-3"
                                                            height="10px" placeholder="Additional query"
                                                            value="{{ $value }}" style="height:40px">
                                                    </div>
                                                    {{-- <div
                                                        style="display:{{ isset($additionalInfoArray) && in_array('5', $additionalInfoArray) && strlen(end($additionalInfoArray)) > 0 ? 'block' : 'none' }};">
                                                        <input type="text" id="inputField"
                                                            class="form-control  primary-text-color form-control-md
                                                            form-control-solid mb-3"
                                                            style="color: rgba(0, 0, 0, 0.6)" name="additional_info[]"
                                                            value="{{ isset($additionalInfoArray) && end($additionalInfoArray) }}">
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="mb-1 col-lg-12">Is there any other information you'd like to
                                                    share with us or any specific goals you have in your recovery
                                                    journey?</label>
                                                <div class="col-lg-12 fv-row fv-plugins-icon-container profile-field">
                                                    <textarea name="note" id="" cols="30" rows="6"
                                                        class="form-control  primary-text-color form-control-md
                                                    form-control-solid mb-3"
                                                        placeholder="">{{ $community_member->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <label class="mb-1 col-lg-6"></label>
                                        <div class="row">
                                            <label for="" class="col-lg-6"></label>
                                            <div class="col-lg-6 fv-row fv-plugins-icon-container profile-field">
                                                <button type="submit" class="btn btn-primary btn-sm">Update
                                                    Profile</button>
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

    <script>
        const checkbox = document.getElementById('checkbox');
        const inputFieldContainer = document.getElementById('inputFieldContainer');
        const inputField = document.getElementById('inputField');

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                inputFieldContainer.style.display = 'block';
                inputField.disabled = false;
            } else {
                inputFieldContainer.style.display = 'none';
                inputField.disabled = true;
            }
        });
    </script>
@endsection
