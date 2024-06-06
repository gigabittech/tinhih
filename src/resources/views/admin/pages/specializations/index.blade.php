@extends('admin.layout.template')

{{-- datatables style --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">


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
    <div class="container-fluid p-5 h-100vh bg-black">

        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
            </div>

            <h4 class="text-white mb-4"><strong>Create New Specialization</strong></h4>

            <div class="col-md-12 col-lg-6 col-sm-3">
                <div class="d-none" id="selected-form">
                    <input type="hidden" name="selectedIds[]" id="formIds">
                    <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                        Selected <span id="totalSelected"></span>
                    </button>
                </div>
                <div class="card-body  bg-dark py-2 table-responsive rounded-3">
                    {{-- <div class="table-responsive mb-4"> --}}
                    <table class="border-none  w-100" id="table">
                        <thead class="text-light">
                            <tr>
                                {{-- <input type="checkbox" id="selectAll" onclick="selectAll()" class="mt-3"> --}}
                                <th scope="col">
                                    <input type="checkbox" id="selectAll" onclick="selectAll()"
                                        class="custom-checkbox mt-3">
                                    <label for="selectAll"></label>
                                </th>
                                <th scope="col">Specialization Image</th>
                                <th scope="col">Specialization Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            @foreach ($specializations as $i => $specialization)
                                <tr>
                                    <td scope="row">
                                        <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                            onclick="updateFormIds()" value="{{ $specialization->id }}"
                                            class="custom-checkbox">
                                        <label for="custom-checkbox_{{ $i }}"></label>
                                    </td>
                                    <td><img src="{{ asset($specialization->image) }}" width="100" alt="">
                                    </td>
                                    <td>{{ $specialization->title }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                type="button" data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                            </button>
                                            <ul class="dropdown-menu bg-black">
                                                <div class="d-flex align-items-center">
                                                    <span class="btn fs-5 text-light mx-2" data-coreui-toggle="modal"
                                                        data-coreui-target="#exampleModal1{{ $specialization->id }}"
                                                        title="Edit Specialization Info" style="cursor:pointer">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </span>
                                                    <span class="btn fs-5 text-light mx-2" title="Delete Specialization"
                                                        style="cursor: pointer">
                                                        <i class="fa-solid fa-trash text-primary"
                                                            onclick="confirmDelete({{ $specialization->id }})"></i>
                                                    </span>
                                                </div>
                                            </ul>
                                        </div>
                                        {{-- <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown link
                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div> --}}
                                    </td>
                                    <!-- Edit Modal Start-->
                                    <div class="modal fade" id="exampleModal1{{ $specialization->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark p-4">
                                                <h5 class="text-white mb-3">Update the Specialization Information</h5>
                                                <form action="{{ route('specialization.update', $specialization->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    {!! method_field('PUT') !!}
                                                    <div class="profile-field">

                                                        <div class="form-group">
                                                            <img src="{{ asset($specialization->image) }}" width="100"
                                                                alt="">
                                                            <input type="file" class="form-control"
                                                                onchange="loadFile(event)" id="image" name="image">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" value="{{ $specialization->title }}"
                                                                placeholder="Specialization Name" name="title"
                                                                class="form-control" autocomplete="off" required="required">
                                                        </div>


                                                        <div class="form-group mb-4">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea name="description" class="form-control" id="description" cols="30" rows="4"
                                                                placeholder="Description">{{ $specialization->description }}</textarea>
                                                            @error('description')
                                                                <div class="alert alert-warning">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-primary login-button w-100"
                                                                type="submit">
                                                                Update specialization
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal Ends-->

                                    <!-- Delete Modal Start -->
                                    {{-- <div class="modal fade" id="exampleModal{{ $specialization->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark1 p-4">
                                                <h5 class="modal-title text-white pb-2" id="exampleModalLabel">Are you
                                                    sure
                                                    want to delete this specialization!</h5>
                                                <p class="text-white">This will be delete this specialization
                                                    permanently.
                                                    You cannot undo this action.</p>
                                                <div class="modal-footer">
                                                    <button type="button" data-coreui-dismiss="modal"
                                                        class="btn btn-primary">Close</button>
                                                    <form
                                                        action="{{ route('specialization.destroy', $specialization->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        {!! method_field('delete') !!}
                                                        <button type="submit"
                                                            class="text-white btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- Delete Modal Ends-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="card-body bg-dark bg-dark1 p-5">
                    <form action="{{ route('specialization.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-field">
                            <div class="form-group">
                                <label for="image" class="form-label">Specialization Image</label>
                                <input type="file" class="form-control" onchange="loadFile(event)" id="image"
                                    name="image">
                            </div>
                            <div class="form-group">
                                @error('title')
                                    <p class=" text-primary ">Special Character Is not avilable </p>
                                @enderror

                                <label for="title" class="form-label">Specialization Name</label>
                                <input type="text" placeholder="Specialization Name" name="title"
                                    class="form-control" autocomplete="off">

                            </div>

                            <div class="form-group mb-4">
                                @error('description')
                                    <p class=" text-primary ">Description Field is required </p>
                                @enderror
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" style="color: rgba(255,255,255, 0.6)" id="description"
                                    cols="30" rows="4" placeholder="Description"></textarea>

                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary login-button w-100" type="submit">Add
                                    Specialization</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for image preview -->
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




    {{-- Datatables  --}}
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
                title: "Are you sure to delete this Specialization?",
                text: "This will delete this Specialization permanently. You cannot undo this action.",
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
                        url: val > 0 ? "{{ route('specialization.destroy', ':id') }} ".replace(
                            ':id', val) : "{{ route('specializations.delete-selected') }}",
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your specialization has been deleted. Redirecting .....",
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
@endsection
