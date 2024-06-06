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
    <!-- Table Area Start -->
    <div class="container-fluid h-100vh p-5 bg-black">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
            </div>
            <h4 class="text-white mb-4"><strong>Create New Quote</strong></h4>
            <div class="col-lg-6">
                <div class="d-none" id="selected-form">
                    <input type="hidden" name="selectedIds[]" id="formIds">
                    <button type="submit" class="btn btn-sm btn-primary" onclick="confirmDelete(0)">Delete
                        Selected <span id="totalSelected"></span>
                    </button>
                </div>
                <div class="card-body table-responsive py-2 bg-dark rounded-3" ref="hasScrolledToBottom">
                    <table class=" border-none w-100" id="table">
                        <thead class="text-light">
                            <tr>
                                {{-- <th scope="col">Quote ID</th> --}}
                                <th scope="col">
                                    <input type="checkbox" id="selectAll" onclick="selectAll()"
                                        class="custom-checkbox mt-3">
                                    <label for="selectAll"></label>
                                </th>
                                <th scope="col">Quote Title</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            @foreach ($quotes as $i => $quote)
                                <tr class>
                                    {{-- <td scope="row">{{ ++$i }}</td> --}}
                                    {{-- <td scope="row"><input type="checkbox" name="selectedIds[]" class="mt-3"
                                            id="quote_{{ $quote->id }}" value="{{ $quote->id }}"
                                            onclick="updateFormIds()"></td> --}}
                                    <td scope="row">
                                        <input type="checkbox" id="custom-checkbox_{{ $i }}" name="selectedIds[]"
                                            onclick="updateFormIds()" value="{{ $quote->id }}" class="custom-checkbox">
                                        <label for="custom-checkbox_{{ $i }}"></label>
                                    </td>
                                    <td>{{ $quote->title }}</td>
                                    <td class="">
                                        <div class="dropdown">
                                            <button class="btn bg-transparent text-light btn-sm dropdown-toggle"
                                                type="button" data-coreui-toggle="dropdown" aria-expanded="false">Actions
                                            </button>
                                            <ul class="dropdown-menu bg-black">
                                                <div class="d-flex align-items-center">
                                                    <span class="btn fs-5 text-light mx-2" data-coreui-toggle="modal"
                                                        data-coreui-target="#exampleModal1{{ $quote->id }}"
                                                        title="Edit Quote Info" style="cursor:pointer">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </span>
                                                    <span class="btn fs-5 text-light mx-2" title="Delete Quote"
                                                        style="cursor: pointer">
                                                        <i class="fa-solid fa-trash text-primary"
                                                            onclick="confirmDelete({{ $quote->id }})"></i>
                                                    </span>
                                                </div>
                                            </ul>
                                        </div>
                                    </td>

                                    <!-- Edit Modal Start-->
                                    <div class="modal fade" id="exampleModal1{{ $quote->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark p-4">
                                                <h5 class="text-white mb-3">Update the Quote Information</h5>
                                                <form action="{{ route('quote.update', $quote->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="profile-field">
                                                        <div class="form-group">
                                                            <input type="text" value="{{ $quote->title }}"
                                                                placeholder="Quote Title" name="title"
                                                                class="form-control" autocomplete="off" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary login-button w-100"
                                                                type="submit">Update Quote</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal Ends-->
                                    {{-- <!-- Delete Modal Start -->
                                    <div class="modal fade" id="exampleModal{{ $quote->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark1 p-4">
                                                <h5 class="modal-title text-white pb-2" id="exampleModalLabel">Are you sure
                                                    you want to delete this Quote?</h5>
                                                <p class="text-white">This will delete this Quote permanently. You cannot
                                                    undo this action.</p>
                                                <div class="modal-footer">
                                                    <button type="button" data-coreui-dismiss="modal"
                                                        class="btn btn-primary">Close</button>
                                                    <form action="{{ route('quote.destroy', $quote->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit "
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
            <div class="col-lg-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body bg-dark bg-dark1 p-5">
                    <form action="{{ route('quote.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-field">
                            <div class="form-group">
                                <input type="text" placeholder="Quote Title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary login-button w-100" type="submit">Add New Quote</button>
                            </div>
                        </div>
                    </form>
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
            }
            Swal.fire({
                title: "Are you sure to delete this Quote?",
                text: "This will delete this Quote permanently. You cannot undo this action.",
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
                        url: val > 0 ? "{{ route('quote.destroy', ':id') }} ".replace(
                            ':id', val) : "{{ route('quotes.delete-selected') }}",
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your quote has been deleted. Redirecting .....",
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
