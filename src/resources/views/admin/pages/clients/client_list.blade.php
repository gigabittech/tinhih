@extends('admin.layout.template')
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
            <h4 class="text-white mb-4"><strong>Clients</strong></h4>
            <div class="d-none mb-1" id="selected-form">
                <input type="hidden" name="selectedIds[]" id="formIds">
                <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                    Selected <span id="totalSelected"></span> </button>
            </div>
            <div class="col-lg-12">
                <div class="card-body table-responsive bg-dark py-2 rounded-3">
                    <table class=" border-none w-100 bg-dark" id="table">
                        <thead class="text-light">
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" id="selectAll" onclick="selectAll()"
                                        class="custom-checkbox mt-3">
                                    <label for="selectAll"></label>
                                </th>

                                <th scope="col">Client Name</th>
                                <th scope="col">Client Email</th>
                                <th scope="col">Client Phone</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            @foreach ($clients as $i => $client)
                                <tr>
                                    {{-- <td>{{ ++$i }}</td> --}}
                                    {{-- <td><input type="checkbox" name="selectedIds[]" id="client_{{ $client->id }}"
                                            value="{{ $client->id }}" onclick="updateFormIds()"> --}}
                                    <td scope="row">
                                        <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                            onclick="updateFormIds()" value="{{ $client->id }}" class="custom-checkbox">
                                        <label for="custom-checkbox_{{ $i }}"></label>
                                    </td>
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                type="button" data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                            </button>
                                            <ul class="dropdown-menu bg-black">

                                                <div class="d-flex align-items-center">
                                                    <span class="btn fs-5 text-light mx-2" data-coreui-toggle="modal"
                                                        data-coreui-target="#exampleModal1{{ $client->id }}"
                                                        title="Edit Client Info" style="cursor:pointer">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </span>
                                                    <span class="btn fs-5 text-light mx-2" title="Delete Client"
                                                        style="cursor: pointer">
                                                        <i class="fa-solid fa-trash text-primary"
                                                            onclick="confirmDelete({{ $client->id }})"></i>
                                                    </span>
                                                </div>
                                            </ul>
                                        </div>
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
@section('extra-script')
    <script>
        //   function scrollElement(scrollTarget, scrollBy) {
        //   scrollTarget.scrollTop(scrollTarget.scrollTop() + scrollBy);
        // }

        document.addEventListener('DOMContentLoaded', () => {
            const scrollContainer = document.querySelector('.scrollable');
            // You can pass a scrolling container or `document` here:
            addHoverListeners(scrollContainer, hover);
        });
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
                title: "Are you sure to delete this Client?",
                text: "This will delete this client permanently. You cannot undo this action.",
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
                                text: "Your client has been deleted. Redirecting .....",
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
