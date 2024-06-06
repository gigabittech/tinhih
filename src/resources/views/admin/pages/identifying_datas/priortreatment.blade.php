@extends('admin.layout.template')
{{-- {{ dd($prior_treatment_therapy_goal->prior_treatment_therapy_goal) }} --}}
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black vh-100">
        <div class="row">
            <div class="col-lg-12 bg-dark1 p-5">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif

                {{-- Prior Treatment and TherapyGoals Starts --}}
                <div class="tab-content" data-tab="5">
                    <form
                        @if (
                            $prior_treatment_therapy_goal->prior_treatment_therapy_goal != null ||
                                $prior_treatment_therapy_goal->prior_treatment_therapy_goal != null) action="{{ route('prior_treatment_therapy_goal.update', ['prior_treatment_therapy_goal' => $prior_treatment_therapy_goal->prior_treatment_therapy_goal ?? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->id]) }}"
                        @else
                            action="{{ route('prior_treatment_therapy_goal.store') }}" @endif
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <i class="btn btn-primary text-black text-center">
                            Smile! You’re doing what you need to take better care of yourself!
                        </i>
                        @if (
                            $prior_treatment_therapy_goal->prior_treatment_therapy_goal ||
                                $prior_treatment_therapy_goal->prior_treatment_therapy_goal)
                            @method('put')
                        @endif

                        <!-- prior_treatment_therapy_goal custody table -->
                        <h2 class="text-white mt-5">Prior Treatment </h2>
                        <div class="row profile-field">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                        class="form-control">
                                </div>

                                <label for="previous_therapy">Previous Therapy</label>
                                <div class="radio-options">
                                    <input type="radio" id="previous_therapy_yes" name="previous_therapy" value="1"
                                        {{ old('previous_therapy') == '1' ? 'checked' : '' }}
                                        {{ isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->previous_therapy) && $prior_treatment_therapy_goal->prior_treatment_therapy_goal->previous_therapy == 1 ? 'checked' : '' }}>
                                    <label for="previous_therapy_yes">Yes</label>
                                    <input type="radio" id="previous_therapy_no" name="previous_therapy" value="2"
                                        {{ old('previous_therapy') == '2' ? 'checked' : '' }}
                                        {{ isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->previous_therapy) && $prior_treatment_therapy_goal->prior_treatment_therapy_goal->previous_therapy == 2 ? 'checked' : '' }}>
                                    <label for="previous_therapy_no">No</label>
                                </div>
                            </div>

                            <div class="d-none" id="showAdditionalProperty">
                                <div class="col-lg-4 additional-fields">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->location) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->location : '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-4 additional-fields">
                                    <div class="form-group">
                                        <label for="dates">Date</label>
                                        <input type="date" name="dates" id="datepicker"
                                            class="form-control flatpicker-input"
                                            value="{{ old('dates', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->dates) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->dates : '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-4 additional-fields">
                                    <div class="form-group">
                                        <label for="medication_name">Medication name</label>
                                        <input type="text" name="medication_name" class="form-control"
                                            value="{{ old('medication_name', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_name) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_name : '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-4 additional-fields">
                                    <div class="form-group">
                                        <label for="medication_purpose">Medication purpose</label>
                                        <input type="text" name="medication_purpose" class="form-control"
                                            value="{{ old('medication_purpose', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_purpose) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_purpose : '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-4 additional-fields">
                                    <div class="form-group">
                                        <label for="medication_dosage">Medication dosage</label>
                                        <input type="text" name="medication_dosage" class="form-control"
                                            value="{{ old('medication_dosage', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_dosage) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->medication_dosage : '') }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <h2 class="text-white mt-5">Therapy Goals</h2>
                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="goals">Goals</label>
                                        <input type="text" name="goals"
                                            class="form-control {{ $errors->has('goals') ? 'is-invalid' : '' }}"
                                            value="{{ old('goals', isset($prior_treatment_therapy_goal->prior_treatment_therapy_goal->goals) ? $prior_treatment_therapy_goal->prior_treatment_therapy_goal->goals : '') }}"
                                            required>
                                        @error('goals')
                                            <span class="text-primary">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit" onclick="validateForm()">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Prior Treatment and TherapyGoals Ends --}}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".additional-fields").hide();
            $(".additional-fields input").prop('disabled', true);

            if ($("input[name='previous_therapy']:checked").val() == 1) {
                $('#showAdditionalProperty').removeClass('d-none');
                $(".additional-fields").show();
                $(".additional-fields input").prop('disabled', false);
            }


            // Attach an event listener to the radio group
            $("input[name='previous_therapy']").change(function() {
                // Check if "Yes" is selected in the "Previous Therapy" radio group
                if ($(this).val() == 1) {
                    // If "Yes" is selected, show the additional fields for this group
                    $('#showAdditionalProperty').removeClass('d-none');
                    $(".additional-fields").show();
                    $(".additional-fields input").prop('disabled', false);
                } else {
                    // If "No" is selected, hide the additional fields for this group
                    $(".additional-fields").hide();
                    $(".additional-fields input").prop('disabled', true);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                // You can customize further options here
            });
        });
    </script>
    <script>
        function validateForm() {
            var inputs = document.querySelectorAll('input[required]');
            var isValid = true;

            inputs.forEach(function(input) {
                if (!input.value.trim() && input.value.length <= 0) {
                    isValid = false;
                    // Add Bootstrap error class
                    input.classList.add('is-invalid');
                    return false;
                } else {
                    // Remove Bootstrap error class if previously added
                    input.classList.remove('is-invalid');
                }
            });
        }
    </script>
@endsection
