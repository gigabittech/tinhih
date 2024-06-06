@extends('admin.layout.template')
@section('extra-style')
    <style>
        /* Hide the default radio button */
        input[type="radio"] {
            display: ;
        }

        /* Style for the custom radio button */
        .custom-radio {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #000;
            /* Black border */
            background-color: #FFF;
            /* White background */
            cursor: pointer;
            margin-right: 10px;
            /* Add some spacing between the radio button and the label */
        }

        /* Style for the checked custom radio button */
        input[type="radio"]:checked+label .custom-radio {
            background-color: #FFD700;
            /* Yellow when selected */
            border-color: #FFD700;
            /* Yellow border when selected */
        }
    </style>
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

                {{-- Insurance Start --}}
                <div class="tab-content show-active profile-field" data-tab="1">
                    <i class="btn btn-primary text-black text-center">
                        It’s going to take some time, but this is the best way we can ensure that you receive the
                        best holistic care. Please grab something to drink, get yourself in a private space, and
                        snuggle up.
                    </i>
                    <h2 class="text-white mt-5">Insurance Information</h2>
                    <form
                        @if (
                            $insurance_information->insurance_information != null ||
                                $insurance_information_two->insurance_information_two != null) action="{{ route('insurance.update', ['insurance' => $insurance_information->insurance_information ?? $insurance_information_two->insurance_information_two->id]) }}"
                    method="post"
                 @else
                    action="{{ route('insurance.store') }}"
                    method="post" @endif
                        enctype="multipart/form-data">
                        @csrf
                        @if (
                            $insurance_information->insurance_information != null ||
                                $insurance_information_two->insurance_information_two != null)
                            @method('put')
                        @endif


                        {{-- Insurance Table Start --}}
                        <div class="row profile-field">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="primary_insurance_name">Primary Insurance Name:</label>
                                    <input type="text" name="primary_insurance_name" class="form-control"
                                        value="{{ old('primary_insurance_name', isset($insurance_information->insurance_information->primary_insurance_name) ? $insurance_information->insurance_information->primary_insurance_name : '') }}"
                                        required>

                                    @error('primary_insurance_name')
                                        <p class="text-primary">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="primary_insurance_id">ID#:</label>
                                    <input type="text" name="primary_insurance_id" class="form-control"
                                        value="{{ old('primary_insurance_id', isset($insurance_information->insurance_information->primary_insurance_id) ? $insurance_information->insurance_information->primary_insurance_id : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="primary_insurance_group">Group#:</label>
                                    <input type="text" name="primary_insurance_group" class="form-control"
                                        value="{{ old('primary_insurance_group', isset($insurance_information->insurance_information->primary_insurance_group) ? $insurance_information->insurance_information->primary_insurance_group : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="secondary_insurance_name">Secondary Insurance Name:</label>
                                    <input type="text" name="secondary_insurance_name" class="form-control"
                                        value="{{ old('secondary_insurance_name', isset($insurance_information->insurance_information->secondary_insurance_name) ? $insurance_information->insurance_information->secondary_insurance_name : '') }}"
                                        required>
                                    @error('secondary_insurance_name')
                                        <p class="text-primary">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="secondary_insurance_id">ID#:</label>
                                    <input type="text" name="secondary_insurance_id" class="form-control"
                                        value="{{ old('secondary_insurance_id', isset($insurance_information->insurance_information->secondary_insurance_id) ? $insurance_information->insurance_information->secondary_insurance_id : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="secondary_insurance_group">Group#:</label>
                                    <input type="text" name="secondary_insurance_group" class="form-control"
                                        value="{{ old('secondary_insurance_group', isset($insurance_information->insurance_information->secondary_insurance_group) ? $insurance_information->insurance_information->secondary_insurance_group : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_primary_insurance_name">Spouse Primary Insurance Name:</label>
                                    <input type="text" name="spouse_primary_insurance_name" class="form-control"
                                        value="{{ old('spouse_primary_insurance_name', isset($insurance_information->insurance_information->spouse_primary_insurance_name) ? $insurance_information->insurance_information->spouse_primary_insurance_name : '') }}"
                                        required>
                                    @error('spouse_primary_insurance_name')
                                        <p class="text-primary">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_primary_insurance_id">ID#:</label>
                                    <input type="text" name="spouse_primary_insurance_id" class="form-control"
                                        value="{{ old('spouse_primary_insurance_id', isset($insurance_information->insurance_information->spouse_primary_insurance_id) ? $insurance_information->insurance_information->spouse_primary_insurance_id : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_primary_insurance_group">Group#:</label>
                                    <input type="text" name="spouse_primary_insurance_group" class="form-control"
                                        value="{{ old('spouse_primary_insurance_group', isset($insurance_information->insurance_information->spouse_primary_insurance_group) ? $insurance_information->insurance_information->spouse_primary_insurance_group : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_secondary_insurance_name">Spouse Secondary Insurance
                                        Name:</label>
                                    <input type="text" name="spouse_secondary_insurance_name" class="form-control"
                                        value="{{ old('spouse_secondary_insurance_name', isset($insurance_information->insurance_information->spouse_secondary_insurance_name) ? $insurance_information->insurance_information->spouse_secondary_insurance_name : '') }}"
                                        required>
                                    @error('spouse_secondary_insurance_name')
                                        <p class="text-primary">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_secondary_insurance_id">ID#:</label>
                                    <input type="text" name="spouse_secondary_insurance_id" class="form-control"
                                        value="{{ old('spouse_secondary_insurance_id', isset($insurance_information->insurance_information->spouse_secondary_insurance_id) ? $insurance_information->insurance_information->spouse_secondary_insurance_id : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="spouse_secondary_insurance_group">Group#:</label>
                                    <input type="text" name="spouse_secondary_insurance_group" class="form-control"
                                        value="{{ old('spouse_secondary_insurance_group', isset($insurance_information->insurance_information->spouse_secondary_insurance_group) ? $insurance_information->insurance_information->spouse_secondary_insurance_group : '') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="covered_by_commercial_insurance">Have you ever been covered by a
                                        commercial insurance policy?</label>
                                    <div class="radio-options">
                                        <input type="radio" name="commercial_insurance_policy" value="1"
                                            {{ old('commercial_insurance_policy', isset($insurance_information->insurance_information->commercial_insurance_policy) && $insurance_information->insurance_information->commercial_insurance_policy == 1 ? 'checked' : '') }}>
                                        <label class="labels">Yes</label>
                                        <input type="radio" class="custom-radio" name="commercial_insurance_policy"
                                            value="2"
                                            {{ old('commercial_insurance_policy', isset($insurance_information->insurance_information->commercial_insurance_policy) && $insurance_information->insurance_information->commercial_insurance_policy == 2 ? 'checked' : '') }}>
                                        <label class="labels">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="current_coverage">Is this policy still current?</label><br>
                                    <div class="radio-options">
                                        <input type="radio" name="policy_still_current" value="1"
                                            {{ old('policy_still_current', isset($insurance_information->insurance_information->policy_still_current) && $insurance_information->insurance_information->policy_still_current == 1 ? 'checked' : '') }}>
                                        <label class="labels">Yes</label>
                                        <input type="radio" name="policy_still_current" value="2"
                                            {{ old('policy_still_current', isset($insurance_information->insurance_information->policy_still_current) && $insurance_information->insurance_information->policy_still_current == 2 ? 'checked' : '') }}>
                                        <label class="labels">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="coverage_expired">Did that coverage expire?</label><br>
                                    <div class="radio-options">
                                        <input type="radio" name="coverage_expire" value="1"
                                            {{ old('coverage_expire', isset($insurance_information->insurance_information->coverage_expire) && $insurance_information->insurance_information->coverage_expire == 1 ? 'checked' : '') }}>
                                        <label class="labels">Yes</label>
                                        <input type="radio" name="coverage_expire" value="2"
                                            {{ old('coverage_expire', isset($insurance_information->insurance_information->coverage_expire) && $insurance_information->insurance_information->coverage_expire == 2 ? 'checked' : '') }}>
                                        <label class="labels">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="form-group">
                                    <label for="expiration_date">If YES, list the expiration date:</label>
                                    <input type="date" name="expiration_date"
                                        class="form-control flatpicker-input flatpicker-input-sm" id="datepicker"
                                        value="{{ old('expiration_date', isset($insurance_information->insurance_information->expiration_date) ? $insurance_information->insurance_information->expiration_date : '') }}">
                                </div>
                            </div>
                        </div>
                        {{-- Insurance Table Ends --}}

                        {{-- Others Insurance Table Start --}}
                        <div class="row profile-field">
                            <fieldset id="insurance">
                                <h2 class="text-white">Other Insurance Information</h2>

                                <div class="form-group">
                                    <label for="are_you_or_your_child_covered_by_any_other_insurance">Are you or your
                                        child covered
                                        by any other insurance?</label>
                                    <div class="radio-options">

                                        <input type="radio" id="other-insurance-yes" value="1"
                                            name="child_covered_by_any_other_insurance"
                                            {{ $insurance_information_two->insurance_information_two != null ? ($insurance_information_two->insurance_information_two->child_covered_by_any_other_insurance == 1 ? 'checked' : '') : '' }}>
                                        <label for="other-insurance-yes">Yes

                                        </label>
                                        <input type="radio" id="other-insurance-no"
                                            name="child_covered_by_any_other_insurance" value="2"
                                            {{ $insurance_information_two->insurance_information_two != null ? ($insurance_information_two->insurance_information_two->child_covered_by_any_other_insurance == 2 ? 'checked' : '') : '' }}>
                                        <label for="other-insurance-no">No</label>
                                    </div>
                                </div>

                                <div id="additional-insurance-info" style="display: none;">
                                    <!-- Additional insurance information fields -->
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label for="what_state_is_the_coverage_in">What state is the coverage
                                                in?</label>
                                            <input type="text" name="what_state_is_the_coverage_in"
                                                class="form-control"value="{{ old('what_state_is_the_coverage_in', isset($insurance_information_two->insurance_information_two->what_state_is_the_coverage_in) ? $insurance_information_two->insurance_information_two->what_state_is_the_coverage_in : '') }}">
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <label for="insurance_name">Insurance Name</label>
                                            <input type="text" name="insurance_name" class="form-control"
                                                value="{{ old('insurance_name', isset($insurance_information_two->insurance_information_two->insurance_name) ? $insurance_information_two->insurance_information_two->insurance_name : '') }}">
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <label for="insurance_id">Insurance ID</label>
                                            <input type="text" name="insurance_id" class="form-control"
                                                value="{{ old('insurance_id', isset($insurance_information_two->insurance_information_two->insurance_id) ? $insurance_information_two->insurance_information_two->insurance_id : '') }}">
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <label for="insurance_group">Insurance Group</label>
                                            <input type="text" name="insurance_group" class="form-control"
                                                value="{{ old('insurance_group', isset($insurance_information_two->insurance_information_two->insurance_group) ? $insurance_information_two->insurance_information_two->insurance_group : '') }}">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            {{-- Others Insurance Table Ends --}}
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" onclick="validateForm()"> Next </button>
                        </div>
                        <script>
                            const yesRadios = document.getElementById("other-insurance-yes");
                            const noRadios = document.getElementById("other-insurance-no");
                            const insuranceSection1 = document.getElementById("additional-insurance-info");


                            document.addEventListener("DOMContentLoaded", function() {
                                // This function will be called when the page has finished loading
                                // You can also call showOtherInsuranceData() directly here if needed
                                showOtherInsuranceData();
                            });


                            function showOtherInsuranceData() {
                                if (yesRadios.checked) {
                                    insuranceSection1.style.display = "block";
                                }
                            }

                            function handleRadioChange() {
                                if (yesRadios.checked) {
                                    insuranceSection1.style.display = "block";
                                } else {
                                    insuranceSection1.style.display = "none";
                                }
                            }

                            yesRadios.addEventListener("change", handleRadioChange);
                            noRadios.addEventListener("change", handleRadioChange);

                            // custody-form.js
                            document.addEventListener("DOMContentLoaded", function() {
                                const custodyYesRadio = document.getElementById("custody-yes");
                                const custodyNoRadio = document.getElementById("custody-no");
                                const custodyInfoSection = document.getElementById("dfs-custody-info");

                                function handleCustodyRadioChange() {
                                    if (custodyYesRadio.checked) {
                                        custodyInfoSection.style.display = "block";
                                    } else {
                                        custodyInfoSection.style.display = "none";
                                    }
                                }
                                custodyYesRadio.addEventListener("change", handleCustodyRadioChange);
                                custodyNoRadio.addEventListener("change", handleCustodyRadioChange);
                            });
                        </script>
                        {{-- Others Insurance Table Ends --}}
                    </form>
                </div>
                {{-- Insurance Ends --}}
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
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
