@extends('admin.layout.template')

@section('body')
    <div class="container-fluid bg-black pt-5 pb-5">
        <div class="col-lg-12">
            <!-- Display common error message -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card mb-4 bg-black">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column align-items-center text-center bg-dark bg-dark1 p-3 py-5">
                                <img class="rounded-circle" id="output" width="150px" height="150px"
                                    src="{{ isset($admin->admin->profile_image) ? asset($admin->admin->profile_image) : 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg' }}">
                                <h4 class="font-weight-bold text-white">{{ $admin->admin->first_name ?? '' }}
                                    {{ $admin->admin->last_name ?? '' }}
                                </h4>
                                <span class="text-white-50 mt-2">{{ Auth::user()->email }}</span>
                                <span> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="bg-dark bg-dark1 p-4">
                                <h4 class="text-right text-white">Profile Settings</h4>
                                <form
                                    @if ($admin->admin != null) action="{{ route('admin.update', ['id' => Auth::user()->id]) }}"

                                @else
                                action="{{ route('admins.store') }}" @endif
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-3 profile-field">
                                        <div class="col-md-6">
                                            <label class="labels">First Name</label>
                                            <input type="text" name="first_name"
                                                value="{{ isset($admin->admin->first_name) ? $admin->admin->first_name : '' }}"
                                                class="form-control" placeholder="First Name">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="labels">Last Name</label>
                                            <input type="text" name="last_name"
                                                value="{{ isset($admin->admin->last_name) ? $admin->admin->last_name : '' }}"
                                                class="form-control" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Username</label>
                                            <input type="text" name="name"
                                                value="{{ isset($admin->admin->name) ? $admin->admin->name : Auth::user()->name }}"
                                                class="form-control" placeholder="Username">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Email</label>
                                            <input type="email" name="email" value="{{ Auth::user()->email }}" disabled
                                                class="form-control bg-black border-0" placeholder="Enter email id">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Phone Number</label>
                                            <input type="text" name="phone"
                                                value="{{ isset($admin->admin->phone) ? $admin->admin->phone : Auth::user()->phone }}"
                                                class="form-control" placeholder="Phone Number">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="labels">Date of Birth</label>
                                            <input type="date" name="dob"
                                                value="{{ isset($admin->admin->dob) ? $admin->admin->dob : '' }}"
                                                class="form-control" placeholder="Date of Birth">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Address</label>
                                            <input type="text" name="address" class="form-control" placeholder="Address"
                                                value="{{ isset($admin->admin->address) ? $admin->admin->address : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="labels" for="exampleFormControlTextarea1">Note</label>
                                            <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="6">{{ isset($admin->admin->note) ? $admin->admin->note : '' }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="labels">Profile image</label>
                                            <input type="file" class="form-control"
                                                {{ isset($admin->admin->profile_image) ? '' : 'required' }}
                                                onchange="loadFile(event)" id="image" name="profile_image"
                                                placeholder="Profile image">
                                            <p></p>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <button class="btn btn-primary login-button w-100" type="submit">Update
                                                Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 mt-4">
                            <div class="bg-dark bg-dark1 p-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <td class="text-white-50">First Name</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ $admin->admin->first_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">User Name</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ Auth::user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">Email Address</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ Auth::user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">Date of Birth</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ $admin->admin->dob ?? '' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <td class="text-white-50">Last Name</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ $admin->admin->last_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">Phone Number</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ Auth::user()->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">Address</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ $admin->admin->address ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white-50">Note</td>
                                            </tr>
                                            <tr>
                                                <td class="text-white pb-4">{{ $admin->admin->note ?? '' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
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
</script>
