@php
    $provider = auth()->user()->provider;
@endphp

@extends('admin.layout.template')


@section('body')
    <div class="container-fluid bg-black pt-5 pb-5">
        <div class="card mb-4 bg-black">

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center text-center bg-dark bg-dark1 p-3 py-5">

                        @if (isset($provider->provider_image))
                            <img class="rounded-circle mt-5" width="150px" height="150px" id="output"
                                src="{{ asset($provider->provider_image) }}">
                        @else
                            <!-- Default image source when no client image is available -->
                            <div class="avatar avatar-md ">
                                <img class="rounded-circle mb-4 " width="92px"
                                    src="{{ asset('admin/assets/img/avatars/profile.png') }}" alt="user@email.com" />
                            </div>
                        @endif
                        <h4 class="font-weight-bold text-white mt-4">{{ $provider->first_name ?? '' }}
                            {{ $provider->last_name ?? '' }}
                        </h4><span class="text-white-50 mt-2">{{ Auth::user()->email }}</span><span> </span>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-dark bg-dark1 p-4">
                        <h4 class="text-right text-white">Provider Settings</h4>
                        <form
                            @if ($provider != null) action="{{ route('provider.update', ['id' => Auth::user()->id]) }}"
                            @else
                            action="{{ route('provider.store') }}" @endif
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-3 profile-field">
                                <div class="col-md-6">
                                    <label class="labels">First Name</label>
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', isset($provider->first_name) ? $provider->first_name : '') }}"
                                        class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                        placeholder="First Name">

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="labels">Last Name</label>
                                    <input type="text" name="last_name"
                                        value="{{ old('last_name', isset($provider->last_name) ? $provider->last_name : '') }}"
                                        class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                        placeholder="Last Name">
                                    @if ($errors->has('last_name'))
                                        <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="labels">Username</label>
                                    <input type="text" name="name"
                                        value="{{ isset($provider->name) ? $provider->name : Auth::user()->name }}"
                                        class="form-control" placeholder="Username">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" disabled
                                        class="form-control bg-black border-0" placeholder="enter email id">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Phone Number</label>
                                    <input type="text" name="phone"
                                        value="{{ isset($provider->phone) ? $provider->phone : Auth::user()->phone }}"
                                        class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Date of Birth</label>
                                    <input type="date" name="dob" value="{{ $provider->dob ?? '' }}"
                                        class="form-control flatpicker-input" placeholder="Date of Birth">
                                </div>

                                <div class="col-md-6">
                                    <label class="labels">Work Location</label>
                                    <input type="text" name="Work_location"
                                        value="{{ isset($provider->Work_location) ? $provider->Work_location : '' }}"
                                        class="form-control" placeholder="Work Location">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Designation</label>
                                    <input type="text" name="designation"
                                        value="{{ isset($provider->designation) ? $provider->designation : '' }}"
                                        class="form-control" placeholder="Designation">
                                </div>

                                <div class="col-md-12">
                                    <label class="labels">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address"
                                        value="{{ isset($provider->address) ? $provider->address : '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="labels" for="exampleFormControlTextarea1">Note</label>
                                    <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="6">{{ isset($provider->note) ? $provider->note : '' }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="labels">Provider image</label>
                                    <input type="file" class="form-control"
                                        {{ isset($provider->provider_image) ? '' : 'required' }}
                                        onchange="loadFile(event)" id="image" name="provider_image"
                                        placeholder="Post image">
                                    <p></p>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary login-button w-100" type="submit">Update
                                        Provider
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Provider Certification Start --}}
                <div class="col-lg-6 mt-4">
                    <div class="row">

                    </div>
                    <div class="bg-dark p-4">
                        @if (Session::has('success'))
                            @include('admin.includes.message.success')
                        @elseif(Session::has('error'))
                            @include('admin.includes.message.error')
                        @endif
                        <div class="row bg-dark1">

                            <div class="col-lg-12 profile-field">
                                <h4 class="text-white pb-3">Add Provider Certification</h4>
                                <form action="{{ route('drcertificate.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <select name="certification_id" class="form-control" required>
                                        <option value="">Please Select a Certifications</option>
                                        @foreach ($certifications as $certification)
                                            <option value="{{ $certification->id }}">{{ $certification->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <input type="hidden" value="{{ $provider->id }}" name="provider_id"
                                            class="form-control" autocomplete="off" required="required">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary login-button w-100" type="submit">Add
                                            Provider Certification
                                        </button>
                                    </div>

                                </form>
                            </div>
                            {{-- Provider Certification End --}}

                            {{-- Provider Specialization Start --}}
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
                                        <input type="hidden" value="{{ $provider->id }}" name="provider_id"
                                            class="form-control" autocomplete="off" required="required">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary login-button w-100" type="submit">Add
                                            Provider Specialization
                                    </div>

                                </form>
                            </div>
                            {{-- Provider Specialization End --}}


                            <div class="col-lg-12 p-0">

                                <!-- Provider Schedule Slot Start -->


                                <div class="card-body mb-10 bg-black">
                                    <h4 class="text-white">Provider Schedule Slot</h4>
                                    <table class="table border-none bg-dark rounded-3 ">
                                        <thead class="text-light">
                                            <tr>
                                                <th scope="col">SL. No</th>
                                                <th scope="col">Start-Time</th>
                                                <th scope="col">End-Time</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-light border-none">
                                            @forelse ($provider_schedules as $i => $provider_schedule)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $provider_schedule->start_time }}</td>
                                                    <td>{{ $provider_schedule->end_time }}</td>


                                                    <td class="">
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-sm btn-primary"
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
                                                        id="exampleModal1{{ $provider_schedule->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-dark p-4">
                                                                <h5 class="text-white mb-3">Update the Sechedule
                                                                    Information</h5>
                                                                <form
                                                                    action="{{ route('provider_schedule.update', $provider_schedule->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="profile-field">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="text-white">{{ $provider_schedule->start_time }}</label>
                                                                            <input type="time" name="start_time"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="text-white">{{ $provider_schedule->end_time }}</label>
                                                                            <input type="time" name="end_time"
                                                                                class="form-control">
                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button class="btn btn-primary login-button w-100"
                                                                            type="submit">Update Schedule</button>
                                                                    </div>


                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal Start -->
                                                    <div class="modal fade" id="exampleModal{{ $provider_schedule->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-dark1 p-4">
                                                                <h5 class="modal-title text-white pb-2"
                                                                    id="exampleModalLabel">Are
                                                                    you sure
                                                                    you want to delete this Sechedule?</h5>
                                                                <p class="text-white">This will delete this Quote
                                                                    permanently. You
                                                                    cannot
                                                                    undo this action.</p>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-coreui-dismiss="modal"
                                                                        class="btn btn-primary">Close</button>
                                                                    <form
                                                                        action="{{ route('provider_schedule.destroy', $provider_schedule->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit "
                                                                            class="text-white btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal End -->
                                                </tr>
                                            @empty
                                                <div class="alert alert-info">Please add new Schedule Slot</div>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Provider Schedule Slot End -->

                            </div>

                            {{-- Provider Schedule Start --}}
                            <div class="col-lg-12 profile-field">
                                <h4 class="text-white mt-5 pb-3">Provider Schedule</h4>
                                <form action="{{ route('provider_schedule.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <input type="hidden" value="{{ $provider->id }}" name="provider_id"
                                            class="form-control" autocomplete="off">
                                    </div>


                                    <div class="form-group">
                                        <label class="labels">Start Time</label>
                                        <input type="time" id= "start_time" name="start_time" class="form-control"
                                            autocomplete="off" required="required" format="hh:mm a" step="60"
                                            value="00:00 AM">
                                    </div>
                                    <div class="form-group">
                                        <label class="labels">End Time</label>
                                        <input type="time" id= "end_time" name="end_time" class="form-control"
                                            autocomplete="off" required="required" format="hh:mm a" step="60">
                                    </div>

                                    {{-- <div class="form-group">
                                        <label class="labels">End Time</label>
                                        <input type="time" name="end_time" class="form-control" autocomplete="off"
                                            required="required" format="hh:mm a" step="60">
                                    </div> --}}

                                    <div class="form-group">
                                        <button class="btn btn-primary login-button w-100" type="submit">Add
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
    </div>
@endsection
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
