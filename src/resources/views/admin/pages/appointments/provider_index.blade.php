@extends('admin.layout.template')

@section('extra-style')
    {{-- datatables style --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

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
</style>
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid bg-black vh-100 p-5">

        <div class="col-lg-12">
            @if (Session::has('success'))
                @include('admin.includes.message.success')
            @elseif(Session::has('error'))
                @include('admin.includes.message.error')
            @endif
        </div>

        <h4 class="text-white mb-4"><strong>Appointments</strong></h4>

        <div class="d-none mb-1" id="selected-form">

            <input type="hidden" name="selectedIds[]" id="formIds">
            <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                Selected <span id="totalSelected"></span> </button>
        </div>

        <div class="col-lg-12">
            <div class="card-body bg-dark table-responsive rounded-3 py-2 mb-5">
                <table class="border-none  w-100" id="table" width="100%">
                    <thead class="text-light">
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="selectAll" onclick="selectAll()" class="custom-checkbox">
                                <label for="selectAll"></label>
                            </th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Appointment Time</th>
                            <th scope="col">Zoom Meeting</th>
                            <th scope="col">Chat</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-light border-none">

                        @foreach ($appointments as $i => $appointment)
                            <tr class="mb-3">
                                <td scope="row">
                                    <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                        onclick="updateFormIds()" value="{{ $appointment->id }}" class="custom-checkbox">
                                    <label for="custom-checkbox_{{ $i }}"></label>
                                </td>
                                <td>{{ $appointment->client->first_name ?? '' }}
                                    {{ $appointment->client->last_name ?? '' }}
                                </td>

                                <td>{{ $appointment->booking_time }}</td>
                                <td>
                                    {{ optional($appointment->schedule)->start_time ? date('h:i A', strtotime($appointment->schedule->start_time)) : '' }}
                                    -
                                    {{ optional($appointment->schedule)->end_time ? date('h:i A', strtotime($appointment->schedule->end_time)) : '' }}
                                </td>
                                <td>
                                    <a href="{{ route('zoom.authorize', ['appointment_id' => $appointment->id]) }}"
                                        class="btn btn-primary">Create zoom meeting</a>
                                </td>
                                <td>
                                    <a href="{{ route('chat.index', ['id' => $appointment->id]) }}"
                                        class="btn btn-primary">Chat</a>
                                </td>

                                <td>

                                    <div class="dropdown">
                                        <button class="btn bg-transparent text-light btn-sm dropdown-toggle" type="button"
                                            data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                        </button>
                                        <ul class="dropdown-menu bg-black">
                                            {{-- <li class="dropdown-item text-light" style="cursor: pointer;"
                                                data-coreui-toggle="modal"
                                                data-coreui-target="#exampleModal14{{ $appointment->id }}">
                                                Edit (Not Enabled)
                                            </li>
                                            <li class="dropdown-item text-light" style="cursor: pointer;"
                                                onclick="confirmDelete({{ $appointment->id }})">
                                                Delete
                                            </li> --}}

                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('appointment.show', $appointment->id) }}"
                                                    class="btn dropdown-icon text-light mx-2"
                                                    title="View Appointment Details" style="cursor: pointer">
                                                    <i class="fa-solid fa-book-open fs-5"></i>
                                                </a>
                                                <a class="btn nav-link text-light mx-2 fs-5" title="View Details"
                                                    style="cursor:pointer">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <span class="btn fs-5 text-light mx-2" title="Delete Appointment"
                                                    style="cursor: pointer">
                                                    <i class="fa-solid fa-trash text-primary"
                                                        onclick="confirmDelete({{ $appointment->id }})"></i>
                                                </span>
                                            </div>
                                        </ul>
                                    </div>
                                </td><!-- Button trigger modal -->



                                <!-- Delete Modal Start -->
                                {{-- <div class="modal fade" id="exampleModal{{ $appointment->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Do You Confirm to
                                                    Delete This Appointment!</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-coreui-dismiss="modal"
                                                    class="btn btn-secondary">Close</button>
                                                <form action="{{ route('appointment.destroy', $appointment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    {!! method_field('delete') !!}
                                                    <button type="submit" class="btn btn-primary">Delete</button>
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

    </div>
    <!-- Table Area Ends -->
@endsection

{{-- data table scripts --}}
@section('extra-script')
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
                title: "Are you sure to delete this Appointment?",
                text: "This will delete this Appointment permanently. You cannot undo this action.",
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
                        url: val > 0 ? "{{ route('appointment.destroy', ':id') }} ".replace(
                            ':id', val) : "{{ route('appointments.delete-selected') }}",
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your appointment has been deleted. Redirecting .....",
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
