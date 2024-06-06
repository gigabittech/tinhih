@extends('admin.layout.template')

{{-- @section('extra-style') --}}
{{-- datatables style --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
{{-- @endsection --}}

<style>
    /* Hide the default checkbox */
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

    .swal2-confirm,
    .swal2-cancel-- {
        color: rgb(0, 0, 0) !important;
    }
</style>



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
            <h4 class="text-white mb-4"><strong>Providers</strong></h4>

            <div class="d-none" id="selected-form">

                <input type="hidden" name="selectedIds[]" id="formIds">
                <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                    Selected <span id="totalSelected"></span>
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card-body bg-dark py-2 rounded-3 table-responsive">
                    <table class=" border-none bg-dark w-100" id="table">
                        <thead class="text-light">
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" id="selectAll" onclick="selectAll()"
                                        class="custom-checkbox mt-3">
                                    <label for="selectAll"></label>
                                </th>
                                <th scope="col">User Name</th>
                                <th scope="col">Provider Email</th>
                                <th scope="col">Provider Phone</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            @foreach ($users as $i => $user)
                                <tr>
                                    {{-- <td>
                                        <input type="checkbox" class="rounded mt-4 me-5" name="selectedIds[]"
                                            value="{{ $user->id }}" onclick="updateFormIds()">
                                    </td> --}}
                                    <td scope="row">
                                        <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                            onclick="updateFormIds()" value="{{ $user->id }}" class="custom-checkbox">
                                        <label for="custom-checkbox_{{ $i }}"></label>
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>

                                        <div class="dropdown">
                                            <button class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                type="button" data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                            </button>
                                            <ul class="dropdown-menu bg-black">
                                                <div class="d-flex align-items-center">
                                                    <span class="btn fs-5 text-light mx-2" data-coreui-toggle="modal"
                                                        data-coreui-target="#exampleModal1{{ $user->id }}"
                                                        title="Edit Provider Info" style="cursor:pointer">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </span>
                                                    <span class="btn fs-5 text-light mx-2" title="Delete Provider"
                                                        style="cursor: pointer">
                                                        <i class="fa-solid fa-trash text-primary"
                                                            onclick="confirmDelete({{ $user->id }})"></i>
                                                    </span>
                                                </div>
                                            </ul>
                                        </div>

                                        {{-- <button type="button" class="btn btn-sm btn-primary" data-coreui-toggle="modal"
                                            data-coreui-target="#exampleModal1{{ $user->id }}">Edit</button>
                                        <button type="button" class="text-white btn btn-sm btn-danger"
                                            data-coreui-toggle="modal"
                                            data-coreui-target="#exampleModal2{{ $user->id }}">Delete</button> --}}

                                        <!-- Edit Modal Start-->
                                        <div class="modal fade" id="exampleModal1{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark p-4">
                                                    <h5 class="text-white mb-3">Update User Information</h5>
                                                    <form action="{{ route('user.update', $user->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="profile-field">
                                                            <div class="form-group">
                                                                <label for="name" class="text-white">User
                                                                    Name</label>
                                                                <input type="text"
                                                                    value="{{ old('name', $user->name) }}"
                                                                    placeholder="User Name" name="name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    autocomplete="off" required="required">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email" class="text-white">Email</label>
                                                                <input type="text"
                                                                    value="{{ old('email', $user->email) }}"
                                                                    placeholder="Email" name="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    autocomplete="off" required="required">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dob" class="text-white">Date of
                                                                    Birth</label>
                                                                <input type="date" id="datepicker"
                                                                    value="{{ optional($user->provider)->dob }}"
                                                                    name="dob" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone" class="text-white">Phone</label>
                                                                <input type="text" id="phone"
                                                                    value="{{ old('phone', $user->phone) }}"
                                                                    name="phone"
                                                                    class="form-control @error('phone') is-invalid @enderror">
                                                                @error('phone')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <!-- Add other fields as needed -->
                                                            <div class="form-group">
                                                                <label for="password" class="text-white">New
                                                                    Password</label>
                                                                <input type="password" placeholder="New Password"
                                                                    name="password"
                                                                    class="form-control @error('password') is-invalid @enderror">
                                                                @error('password')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password_confirmation"
                                                                    class="text-white">Confirm Password</label>
                                                                <input type="password" placeholder="Confirm Password"
                                                                    name="password_confirmation"
                                                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                                                @error('password_confirmation')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary login-button w-100"
                                                                type="submit">Update User</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Modal Ends-->
                                        <!-- Delete Modal Start -->
                                        <div class="modal fade" id="exampleModal2{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark1 p-4">
                                                    <h5 class="modal-title text-white pb-2" id="exampleModalLabel2">Are
                                                        you sure
                                                        you want to delete this User?</h5>
                                                    <p class="text-white">This will delete this User permanently.
                                                        You
                                                        cannot
                                                        undo this action.</p>
                                                    <div class="modal-footer">
                                                        <button type="button" data-coreui-dismiss="modal"
                                                            class="btn btn-primary">Close</button>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="text-white btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal Ends-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

{{-- @section('extra-script') --}}
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
            title: "Are you sure to delete this Provider?",
            text: "This will delete this Provider permanently. You cannot undo this action.",
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
                    url: val > 0 ? "{{ route('user.destroy', ':id') }} ".replace(
                        ':id', val) : "{{ route('providers.delete-selected') }}",
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your provider has been deleted. Redirecting .....",
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
{{-- @endsection --}}
