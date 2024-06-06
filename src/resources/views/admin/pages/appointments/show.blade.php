@extends('admin.layout.template')

<style>
    .text-low {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .text-field {
        background-color: #181924 !important;
        border: 1px solid #ffdd00 !important;
        box-shadow: 0 0 0 0.25rem rgb(255 193 7 / 25%);
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
        bottom: 0;
        left: 0;
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
    <div class="container-fluid bg-black p-5 h-100vh">
        <div class="row">
            <!-- Doctor Info & Appointment Details Column -->
            <div class="col-md-6">
                <h2 class="text-low mb-4">Doctor Info & Appointment Details</h2>
                <div class="card bg-dark text-low">
                    @if (isset($provider->provider_image))
                        <img src="{{ asset($provider->provider_image) }}" alt="" class="card-img-top rounded">
                    @else
                        <img src="https://cdn.pixabay.com/photo/2017/01/29/21/16/nurse-2019420_1280.jpg"
                            class="card-img-top rounded" alt="Provider Image">
                    @endif
                    <div class="card-body">
                        <span class="d-flex">
                            <h5 class="card-title">{{ $provider->first_name }} {{ $provider->last_name }}</h5>
                            <img src="{{ asset('assets/images/images/doctor.png') }}" alt="" height="12px"
                                width="12px" class="ms-1 mt-2">
                        </span>
                        <p class="card-text">Specialization:
                            @foreach ($provider->specializations as $specialization)
                                <i class="text-primary" style="cursor: pointer">{{ $specialization->title }}</i>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p>
                        <p class="card-text">Location: {{ $provider->address ?? 'USA, California' }}</p>
                        <p class="card-text">Contact: {{ $provider->user->phone ?? 'N/A' }}</p>
                        <h5 class="card-title">Appointment Details</h5>
                        <p class="card-text">Date: <i class="text-primary">{{ $appointment->booking_time }}</i></p>
                        <p class="card-text">Time: <i
                                class="text-primary">{{ optional($appointment->schedule)->start_time ? date('h:i A', strtotime($appointment->schedule->start_time)) : '' }}
                            </i></p>
                        <p class="card-text">Purpose: {{ $appointment->purpose ?? 'No purpose added' }}</p>
                    </div>
                </div>
            </div>


            <!-- Assessment & Progress Notes Column -->
            <div class="col-md-6">
                <h2 class="text-low mb-4">Assessment & Progress Notes</h2>
                <div class="card bg-dark text-low">
                    <div class="card-body">
                        <h5 class="card-title">Assessment</h5>
                        <ul style="list-style: none; text-align: left; padding:5px;" class="bg-black rounded"
                            id="assignedAssessment">
                            @foreach ($appointment->assessments->sortByDesc('created_at') as $assessment)
                                <li class="mb-1">
                                    <input type="checkbox" name="{{ $assessment->id }}"
                                        class="custom-checkbox showAssessment me-2"
                                        style="bottom:0 !important; padding:4px;"
                                        {{ auth()->user()->type != 'client' ? 'disabled' : '' }}
                                        {{ $assessment->is_completed != 0 ? 'checked disabled' : '' }}
                                        onclick="assessmentComplete({{ $assessment->id }})"
                                        id="assessment_{{ $assessment->id }}">
                                    <label class="me-3" for="assessment_{{ $assessment->id }}">
                                        {{ $assessment->diagnosis }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        @if (auth()->user()->type != 'client')
                            <button type="submit" class="btn btn-primary btn-sm"
                                onclick="assignAssesment({{ $appointment->id }})">Assign</button>
                        @endif
                    </div>
                </div>
                <div class="card mt-3 bg-dark text-low">
                    <div class="card-body">
                        <h5 class="card-title">Progress Notes</h5>
                        <div class="bg-black p-2 rounded" clientname="{{ $appointment->client->first_name }}"
                            id="notes">
                            @foreach ($appointment->progressNotes->sortByDesc('created_at') as $note)
                                <p class="card-text mb-1"><span
                                        class="text-primary">{{ $appointment->client->first_name }}</span>:
                                    {{ $note->note }}</p>
                            @endforeach
                        </div>

                        {{-- <form class="profile-fields">
                            <div class="mb-3">
                                <label for="progressNoteInput" class="form-label">Add Progress Note</label>
                                <textarea class="form-control text-field" id="progressNoteInput" rows="2"
                                    placeholder="Tell the provider about your current situation. &#13;&#10;e.g. Feeling good or Facing backpain"></textarea>
                            </div>
                        </form> --}}
                        @if (auth()->user()->type != 'provider')
                            <button type="submit" class="btn btn-primary btn-sm mt-2"
                                onclick="addProgressNote({{ $appointment->id }})">Add Note</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function addProgressNote(progressNoteId) {
            var url = "{{ route('progress-notes.store') }}";
            Swal.fire({
                title: 'Add Your Note',
                html: '<p>Write your progress to the provider, so that he/she can plan proper treatment for you!</p>' +
                    '<textarea id="addProgressNoteInput" cols="10" rows="3" style="border:1px solid #ffdd00 !important;" class="bg-black form-control" placeholder="Now I\'m facing backpain"></textarea>',
                showCancelButton: true,
                confirmButtonText: 'Add Note',
                showLoaderOnConfirm: true,
                background: '#343a40',
                confirmButtonColor: '#ffdd00',
                color: 'rgba(255, 255, 255, 0.6)',
                preConfirm: () => {
                    const inputValue = $('#addProgressNoteInput').val();
                    if (!inputValue) {
                        Swal.showValidationMessage('Note can\'t be empty');
                        $('#addProgressNoteInput').addClass('is-invalid');
                        return false;
                    }
                    // Here you can handle form submission, for example, using AJAX
                    return fetch(url, {
                            method: 'POST',
                            body: JSON.stringify({
                                _token: '{{ csrf_token() }}',
                                appointment_id: progressNoteId,
                                note: inputValue,
                            }),
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            // Check content type
                            const contentType = response.headers.get('content-type');
                            if (contentType && contentType.indexOf('application/json') !== -1) {
                                return response.json(); // Parse JSON response

                            } else {
                                throw new Error('Unexpected response type: ' + contentType);
                            }
                        })
                        .then(data => {
                            viewNotes(progressNoteId);
                            return data;
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            Swal.showValidationMessage(
                                'Failed to add progress note'); // Show validation error message
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Success",
                        text: "Your note has been sent. Provider will review in while",
                        icon: "success",
                        background: '#343a40',
                        confirmButtonColor: '#ffdd00',
                        color: 'rgba(255, 255, 255, 0.6)',
                    });
                }
            });
        }

        function viewNotes(appointmentId) {
            $.ajax({
                url: "{{ route('getProgressNotesByAppointmentId', ':id') }} ".replace(
                    ':id', appointmentId),
                type: 'GET', // Assuming you're retrieving data via GET method
                success: function(response) {
                    let notesContainer = document.getElementById('notes');
                    let clientName = notesContainer.getAttribute('clientname');
                    notesContainer.innerHTML = ''; // Clear previous notes

                    // Loop through the progress notes and append them to the notes container
                    response.notes.forEach(note => {
                        let noteElement = document.createElement('p');
                        noteElement.classList.add('card-text', 'mb-1');
                        noteElement.innerHTML =
                            // ${note.client.first_name}
                            `<span class="text-primary">${clientName}</span>: ${note.note}`;
                        notesContainer.appendChild(noteElement);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error occurred while retrieving notes:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while retrieving notes. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false
                    });
                }
            });

        }

        function showAssessment(appointmentId) {
            $.ajax({
                url: "{{ route('getAssessmentByAppointmentId', ':id') }} ".replace(
                    ':id', appointmentId),
                type: 'GET', // Assuming you're retrieving data via GET method
                success: function(response) {
                    var assignedAssessmentElement = document.getElementById('assignedAssessment');
                    assignedAssessmentElement.innerHTML = '';

                    // Loop through the assessments data and create HTML elements for each assessment
                    response.assessments.forEach(function(assessment) {
                        var li = document.createElement('li');
                        li.classList.add('mb-1');

                        var input = document.createElement('input');
                        input.setAttribute('type', 'checkbox');
                        input.setAttribute('id', assessment.id);
                        input.setAttribute('name', assessment.id);
                        input.setAttribute('name', assessment.id);
                        input.classList.add('custom-checkbox', 'showAssessment', 'me-2');
                        input.style.cssText = 'bottom: 0 !important; padding: 4px;';
                        input.disabled = "{{ auth()->user()->type != 'client' }}";

                        if (assessment.is_completed) {
                            input.setAttribute('checked', 'checked');
                        }

                        var label = document.createElement('label');
                        label.setAttribute('for', assessment.id);
                        label.classList.add('me-3');
                        label.textContent = assessment.diagnosis;

                        li.appendChild(input);
                        li.appendChild(label);

                        assignedAssessmentElement.appendChild(li);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error occurred while retrieving notes:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while retrieving notes. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false
                    });
                }
            });

        }


        function assignAssesment(appointmentId) {
            var url = "{{ route('assesments.store') }}";
            Swal.fire({
                title: 'Assign Assesment',
                html: '<p>Please assign some assesment to your client!</p>' +
                    '<textarea id="assignAssesmentInput" cols="10" rows="3" style="border:1px solid #ffdd00 !important;" class="bg-black form-control" placeholder="10 pushup daily"></textarea>',
                showCancelButton: true,
                confirmButtonText: 'Assign',
                showLoaderOnConfirm: true,
                background: '#343a40',
                confirmButtonColor: '#ffdd00',
                color: 'rgba(255, 255, 255, 0.6)',
                preConfirm: () => {
                    const inputValue = $('#assignAssesmentInput').val();
                    if (!inputValue) {
                        Swal.showValidationMessage('Assesment can\'t be empty');
                        $('#assignAssesmentInput').addClass('is-invalid');
                        return false;
                    }
                    // Here you can handle form submission, for example, using AJAX
                    return fetch(url, {
                            method: 'POST',
                            body: JSON.stringify({
                                _token: '{{ csrf_token() }}',
                                appointment_id: appointmentId,
                                diagnosis: inputValue,
                            }),
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            if (response.status == 501) {
                                Swal.showValidationMessage(
                                    'Diagnosis field is required');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            showAssessment(appointmentId);
                            return data;
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                            Swal.showValidationMessage(
                                'Diagnosis field is required'); // Show validation error message
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Success",
                        text: "Assesment assign successfully! Now it seems easy to treatment your client",
                        icon: "success",
                        background: '#343a40',
                        confirmButtonColor: '#ffdd00',
                        color: 'rgba(255, 255, 255, 0.6)',
                    });
                }
            })
        }


        function assessmentComplete(assessmentId) {
            $.ajax({
                url: "{{ route('assessmentComplete') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    assessmentId: assessmentId
                }, // Add CSRF token if needed
                success: function(response) {
                    // Handle success response if needed
                    if (response == true) {
                        $('#assessment_' + assessmentId).prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response if needed
                    console.error('Error occurred while marking assessment as completed:', error);
                }
            });

        }
    </script>
@endsection
