@php
    $client = auth()->user()->client;
@endphp

@extends('admin.layout.template')

<style>
    .active-color {
        /* background-color: #ffdd00;
         */
        border-bottom: 2px solid #ffdd00;
        /* Set the background color to yellow */
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
                <h6>Account Overview</h6>
                <span style="font-size: 13px;">
                    Account - Profile
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
                                            src="{{ $client->client_image ? asset($client->client_image) : asset('admin/assets/img/avatars/profile.png') }}"
                                            alt="user Image" />
                                    </div>
                                    {{-- Profile section --}}
                                    <div style="flex-grow: 1!important;">
                                        {{-- Profile Name --}}
                                        <div class="d-flex flex-column">
                                            <div class="align-items-center">
                                                <a href="javascript:void(0);" class="fw-bold fs-5 text-hover-primary"
                                                    style="color:rgba(255, 255, 255, 0.6); text-decoration:none;">
                                                    {{ $client->first_name ?? '' }}
                                                    {{ $client->last_name ?? '' }}
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
                                                Client
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="text-decoration-none d-flex align-items-center me-5"
                                                style="color:rgba(255, 255, 255, 0.6);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                </svg>{{ $client->address }}
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
                                                {{ $client->note }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-1x border-transparent fs-5">
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('client.manage') }}"
                                        class="nav-link fs-6 ms-0 me-3 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'client.manage' ? 'active-color' : '' }}"
                                        style="color:rgba(255, 255, 255, 0.6)">Overview</a>
                                </li>
                                <li class="nav-item mt-2 ps-3">
                                    <a href="{{ route('client.profile.settings', ['id' => $client->id]) }}"
                                        class="nav-link ms-0 me-3 fs-6 py-1 pb-2 px-0 {{ Route::currentRouteName() == 'client.profile.settings' ? 'active-color' : '' }}"
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
                                <a href="{{ route('client.profile.settings', ['id' => $client->id]) }}"
                                    class="btn btn-sm btn-primary align-self-center ms-auto">Edit Profile</a>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">First
                                        Name</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->first_name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Last
                                        Name</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->last_name }}</span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Username</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->admin->name ?? Auth::user()->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Phone Number</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->cell_phone ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Date of Birth</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->dob ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Age</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->age ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">SSN</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->ssn ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Relationship</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->relationship ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Are Parents Married?</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->are_parents_married == 1 ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Are Parents Divorced?</label>
                                    <div class="col-md-8">
                                        <span
                                            class="">{{ $client->are_parents_divorced == 1 ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Legal Guardian</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->legal_guardian ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Legal Custody</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->legal_custody ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Cultural Background</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->cultural_background ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Language</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->language ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label for="" class="col-md-4 labels"
                                        style="color:rgba(255, 255, 255, 0.6)">Note</label>
                                    <div class="col-md-8">
                                        <span class="">{{ $client->note }}</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
