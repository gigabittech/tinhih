@extends('admin.layout.template')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">


@section('extra-style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 16px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #545252;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 2px;
            bottom: 2px;
            background-color: rgb(0, 0, 0);
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #ffdd00;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(13px);
            -ms-transform: translateX(13px);
            transform: translateX(13px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }



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
@endsection
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black">

        <div class="row">

            <div class="col-lg-12">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
            </div>
            <h4 class="text-white mb-4"><strong>Create New Event</strong></h4>
            <div class="col-lg-6">
                <div class="d-none" id="selected-form">
                    <input type="hidden" name="selectedIds[]" id="formIds">
                    <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                        Selected <span id="totalSelected"></span>
                    </button>
                </div>
                <div class="card-body table-responsive bg-dark py-2 rounded-3">
                    <table class=" border-none w-100" id="table">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" id="selectAll" onclick="selectAll()"
                                        class="custom-checkbox mt-3">
                                    <label for="selectAll"></label>
                                </th>

                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">

                            @foreach ($events as $i => $event)
                                <tr>
                                    {{-- <td scope="row">{{ ++$i }}</td> --}}
                                    <td scope="row">
                                        <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                            onclick="updateFormIds()" value="{{ $event->id }}" class="custom-checkbox">
                                        <label for="custom-checkbox_{{ $i }}"></label>
                                    </td>
                                    {{-- <td scope="row"><input type="checkbox" name="selectedIds[]"
                                            id="event_{{ $event->id }}" value="{{ $event->id }}"
                                            onclick="updateFormIds()">
                                    </td> --}}
                                    <td><img src="{{ asset($event->image) }}" width="100" alt=""></td>
                                    <td>{{ $event->title }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="eventStatus" name="status"
                                                id="eventStatus_{{ $event->id }}"
                                                {{ $event->status == 1 ? 'checked' : '' }}
                                                data-event-id="{{ $event->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                type="button" data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                            </button>
                                            <ul class="dropdown-menu bg-black">
                                                <div class="d-flex align-items-center">
                                                    <span class="btn fs-5 text-light mx-2" data-coreui-toggle="modal"
                                                        data-coreui-target="#exampleModal1{{ $event->id }}"
                                                        title="Edit Event Info" style="cursor:pointer">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </span>
                                                    <span class="btn fs-5 text-light mx-2" title="Delete Event"
                                                        style="cursor: pointer">
                                                        <i class="fa-solid fa-trash text-primary"
                                                            onclick="confirmDelete({{ $event->id }})"></i>
                                                    </span>
                                                </div>
                                            </ul>
                                        </div>
                                        {{-- <button type="button" class="btn btn-sm btn-primary" data-coreui-toggle="modal"
                                            data-coreui-target="#exampleModal1{{ $event->id }}"> Edit</button>
                                        <button type="button" class="text-white btn btn-sm btn-danger"
                                            data-coreui-toggle="modal"
                                            data-coreui-target="#exampleModal{{ $event->id }}"> Delete</button> --}}
                                    </td><!-- Button trigger modal -->
                                    <!-- Edit Modal Start-->
                                    <div class="modal fade" id="exampleModal1{{ $event->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark p-4">
                                                <h5 class="text-white mb-3">Update the Event Information</h5>
                                                <form action="{{ route('event.update', $event->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    {!! method_field('PUT') !!}
                                                    <div class="profile-field">
                                                        <div class="form-group">
                                                            <img src="{{ asset($event->image) }}" name="image"
                                                                width="250px" alt="" class="mb-3 rounded">
                                                            <input type="file" value="{{ $event->image }}"
                                                                placeholder="Event Image" name="image"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" value="{{ $event->title }}"
                                                                placeholder="Event Name" name="title"
                                                                class="form-control">
                                                        </div>

                                                        <div class="form-group">

                                                            <input type="text" id="start_time" placeholder="Start Time"
                                                                name="start_time" class="form-control"
                                                                required="required" value="{{ $event->start_time }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" id="end_time" placeholder="End Time"
                                                                name="end_time" class="form-control" required="required"
                                                                value="{{ $event->end_time }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="date" id ="datepicker"
                                                                placeholder="Event Date" value="{{ $event->date }}"
                                                                name="date" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" placeholder="Location"
                                                                value="{{ $event->location }}" name="location"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="External Link"
                                                                value="{{ $event->external_link }}" name="external_link"
                                                                class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea name="description" placeholder="Event Description" class="form-control mb-4" id=""
                                                                cols="30" rows="6" style="color: rgba(255,255,255,0.6) !important;">{{ $event->description }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-primary login-button w-100"
                                                                type="submit">
                                                                Update Event
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal Ends-->

                                    <!-- Delete Modal Start -->
                                    {{-- <div class="modal fade" id="exampleModal{{ $event->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark1 p-4">
                                                <h5 class="modal-title text-white pb-2" id="exampleModalLabel">Are you
                                                    sure
                                                    want to delete this event!</h5>
                                                <p class="text-white">This will be delete this event permanently.
                                                    You cannot undo this action.</p>
                                                <div class="modal-footer">
                                                    <button type="button" data-coreui-dismiss="modal"
                                                        class="btn btn-primary">Close</button>
                                                    <form action="{{ route('event.destroy', $event->id) }}"
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
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card-body bg-dark bg-dark1 p-5">

                    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-field">
                            <div class="form-group">
                                <input type="file" class="form-control" onchange="loadFile(event)" id="image"
                                    name="image" placeholder="Post image">
                            </div>
                            <div class="profile-field">
                                <div class="form-group">
                                    @error('title')
                                        <div class="text-warning text-bold mb-2" role="alert">Special character is not
                                            avilable for Name </div>
                                    @enderror
                                    <input type="text" placeholder="Event Title" name="title"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                        value="{{ old('title') }}" autocomplete="off" required="required">

                                </div>

                                <div class="form-group">

                                    <input type="text" id="start_time" placeholder="Start Time" name="start_time"
                                        class="form-control" required="required">
                                </div>

                                <div class="form-group">

                                    <input type="text" id="end_time" placeholder="End Time" name="end_time"
                                        class="form-control" required="required">
                                </div>



                                <div class="form-group">
                                    <input type="date" id='datepicker' placeholder="Event Date" name="date"
                                        class="form-control" autocomplete="off" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Location" name="location" class="form-control"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="External Link" name="external_link"
                                        class="form-control" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <textarea name="description" placeholder="Event Description" class="form-control mb-4" id=""
                                        cols="30" rows="6"></textarea>
                                </div>


                                <div class="form-group">
                                    <button class="btn btn-primary login-button w-100" type="submit">
                                        Add New Event
                                    </button>
                                </div>
                            </div>
                    </form>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            // responsive: true
        });
    })
</script>
<script>
    $(document).ready(function() {

        $(".eventStatus").on("click", function() {
            let eventId = $(this).data('event-id');
            console.log(eventId);
            // alert("Hey")
            let token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('event.status-update') }}",
                method: 'post',
                data: {
                    '_token': token,
                    'eventId': eventId
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })
    });
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
            title: "Are you sure to delete this Event?",
            text: "This will delete this Event permanently. You cannot undo this action.",
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
                    url: val > 0 ? "{{ route('event.destroy', ':id') }} ".replace(
                        ':id', val) : "{{ route('events.delete-selected') }}",
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your event has been deleted. Redirecting .....",
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
