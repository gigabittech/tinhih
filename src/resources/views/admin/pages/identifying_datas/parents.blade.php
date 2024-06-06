@extends('admin.layout.template')
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black vh-100 ">

        <div class="row">

            <div class="col-lg-12 bg-dark1 p-5">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif


                {{-- Parents Information Starts --}}
                <div class="tab-content" data-tab="2">
                    <form
                        @if ($parents_information->parents_information != null || $parents_informations->parents_informations != null) action="{{ route('identifying.update', ['identifying' => $parents_information->parents_information->id ?? $parents_informations->parents_informations->id]) }}"
                        @else
                            action="{{ route('identifying.store') }}" @endif
                        method="post" enctype="multipart/form-data">
                        @csrf

                        @if ($parents_information->parents_information || $parents_informations->parents_informations)
                            @method('put')
                        @endif

                        {{-- Your form fields go here --}}


                        <div class="profile-field">
                            <div class="row">

                                {{-- Father Form Start --}}
                                <div>
                                    <div class="form-group">
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="client_id"
                                            class="form-control" autocomplete="off">
                                    </div>
                                    <i class="btn btn-primary text-black text-center">
                                        Did you know it’s illegal to own just one guinea pig in Switzerland?
                                    </i>
                                    <h2 class="text-white mt-5 mb-3">*Biological or Adoptive Father</h2>
                                    <div class="form-group">
                                        <select class="form-control" name="father_type">
                                            <option value="">Select Father Type</option>
                                            <option value="1" @if (old(
                                                    'father_type',
                                                    isset($parents_information->parents_information->father_type)
                                                        ? $parents_information->parents_information->father_type
                                                        : '') == '1') selected @endif>
                                                Biological
                                            </option>
                                            <option value="2" @if (old(
                                                    'father_type',
                                                    isset($parents_information->parents_information->father_type)
                                                        ? $parents_information->parents_information->father_type
                                                        : '') == '2') selected @endif>
                                                Adaptive
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="labels" for="father_name">Father Name</label>
                                            <input type="text" name="father_name" class="form-control"
                                                placeholder="Father Name"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_name) ? $parents_information->parents_information->father_name : '') }}"
                                                required>
                                            @error('father_name')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="father_ssn">Father SSN</label>
                                            <input type="text" name="father_ssn" class="form-control"
                                                placeholder="Father SSN"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_ssn) ? $parents_information->parents_information->father_ssn : '') }}"
                                                required>
                                            @error('father_ssn')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="father_dob">Father DOB</label>
                                            <input type="date" name="father_dob" id="datepicker"
                                                class="form-control flatpicker-input" placeholder="Father Date of Birth"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_dob) ? $parents_information->parents_information->father_dob : '') }}"
                                                required>
                                            @error('father_dob')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="labels" for="father_current_address">Current Address(Street, City,
                                                State, Zip):</label>
                                            <input type="text" name="father_current_address" class="form-control"
                                                placeholder="Address"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_current_address) ? $parents_information->parents_information->father_current_address : '') }}"
                                                required>
                                            @error('father_current_address')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="father_home_phone">Home Phone#</label>
                                            <input type="text" name="father_home_phone" class="form-control"
                                                placeholder="Home Phone"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_home_phone) ? $parents_information->parents_information->father_home_phone : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="father_cell_phone">Cell Phone#</label>
                                            <input type="text" name="father_cell_phone" class="form-control"
                                                placeholder="Cell Phone"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_cell_phone) ? $parents_information->parents_information->father_cell_phone : '') }}"
                                                required>
                                            @error('father_cell_phone')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="father_email">Email</label>
                                            <input type="email" name="father_email" class="form-control"
                                                placeholder="Email"
                                                value="{{ old('parents_information', isset($parents_information->parents_information->father_email) ? $parents_information->parents_information->father_email : '') }}"
                                                required>
                                            @error('father_email')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <label for="does_client_live_with_the_father">Does the client live with the
                                        father?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="father-yes" name="client_live_with_the_father"
                                            value="1"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->client_live_with_the_father == 1 ? 'checked' : '') : '' }}>

                                        {{-- {{ $parents_information->parents_information->client_live_with_the_father == 1 ? 'checked' : '' }}> --}}
                                        <label for="father-yes">Yes</label>
                                        <input type="radio" id="father-no" name="client_live_with_the_father"
                                            value="2"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->client_live_with_the_father == 2 ? 'checked' : '') : '' }}>
                                        <label for="father-no">No</label>
                                    </div>

                                    <label for="Is client covered under a Step-Parent’s Health Insurance policy?">Does
                                        father
                                        carry health insurance for client?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="health-yes" name="health_insurance_for_client"
                                            value="1"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->health_insurance_for_client == 1 ? 'checked' : '') : '' }}>
                                        <label for="health-yes">Yes</label>
                                        <input type="radio" id="health-no" name="health_insurance_for_client"
                                            value="2"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->health_insurance_for_client == 2 ? 'checked' : '') : '' }}>
                                        <label for="health-no">No</label>
                                    </div>

                                    <div id="fathers-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_name">Primary Insurance Name:</label>
                                            <input type="text" name="father_primary_insurance_name"
                                                value="{{ old('father_primary_insurance_name', isset($parents_information->parents_information->father_primary_insurance_name) ? $parents_information->parents_information->father_primary_insurance_name : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="primary_insurance_id">Primary Insurance ID:</label>
                                            <input type="text" name="primary_insurance_id"
                                                value="{{ old('primary_insurance_id', isset($parents_information->parents_information->primary_insurance_id) ? $parents_information->parents_information->primary_insurance_id : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_group">Primary Insurance Group:</label>
                                            <input type="text" name="father_primary_insurance_group"
                                                value="{{ old('father_primary_insurance_group', isset($step_parents_information->parents_information->father_primary_insurance_group) ? $parents_information->parents_information->father_primary_insurance_group : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_secondary_insurance_name">Secondary Insurance Name:</label>
                                            <input type="text" name="father_secondary_insurance_name"
                                                value="{{ old('father_secondary_insurance_name', isset($parents_information->parents_information->father_secondary_insurance_name) ? $parents_information->parents_information->father_secondary_insurance_name : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_id">Secondary Insurance ID:</label>
                                            <input type="text" name="father_secondary_insurance_id"
                                                value="{{ old('father_secondary_insurance_id', isset($parents_information->parents_information->father_secondary_insurance_id) ? $parents_information->parents_information->father_secondary_insurance_id : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_group">Secondary Insurance
                                                Group:</label>
                                            <input type="text" name="father_secondary_insurance_group"
                                                value="{{ old('father_secondary_insurance_group', isset($parents_information->parents_information->father_secondary_insurance_group) ? $parents_information->parents_information->father_secondary_insurance_group : '') }}">
                                        </div>
                                    </div>


                                    <script>
                                        // Get references to the radio buttons and the related form field section
                                        const healthYesRadio = document.getElementById("health-yes");
                                        const healthNoRadio = document.getElementById("health-no");
                                        const fatherYesFieldsSection = document.getElementById("fathers-yes-fields");

                                        // Function to handle radio button changes and toggle the section visibility
                                        function handleRadioChange() {
                                            if (healthYesRadio.checked) {
                                                fatherYesFieldsSection.style.display = "block";
                                            } else if (healthNoRadio.checked) {
                                                fatherYesFieldsSection.style.display = "none";
                                            }
                                        }

                                        // Add event listeners to the "health-yes" and "health-no" radio buttons to handle changes
                                        healthYesRadio.addEventListener("change", handleRadioChange);
                                        healthNoRadio.addEventListener("change", handleRadioChange);

                                        // Call the function initially to set the initial visibility state
                                        handleRadioChange();
                                    </script>

                                    <label for="does_client_live_with_the_father">Does the client live with the
                                        Step-parent's?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="step-father-yes" name="step_living_with_the_client"
                                            value="1"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->step_living_with_the_client == 1 ? 'checked' : '') : '' }}>
                                        <label for="father-yes">Yes
                                            {{-- {{ $parents_information->parents_information->step_living_with_the_client }} --}}
                                        </label>
                                        <input type="radio" id="step-father-no" name="step_living_with_the_client"
                                            value="2"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->step_living_with_the_client == 2 ? 'checked' : '') : '' }}>
                                        <label for="father-no">No</label>
                                    </div>

                                    <label for="Is client covered under a Step-Parent’s Health Insurance policy?">Is client
                                        covered under a Step-Parent’s Health Insurance policy?</label>
                                    <div class="radio-options">
                                        {{-- {{ dd($parents_information->parents_information->health_insurance_policy) }} --}}
                                        <input type="radio" id="step-health-yes" name="health_insurance_policy"
                                            value="1" {{-- {{ dd($parents_information->parents_information) != null ? ($parents_information->parents_information->health_insurance_policy == 1 ? 'checked' : '') : '' }}> --}} <label for="health-yes">Yes</label>
                                        <input type="radio" id="step-health-no" name="health_insurance_policy"
                                            value="2"
                                            {{ $parents_information->parents_information != null ? ($parents_information->parents_information->health_insurance_policy == 2 ? 'checked' : '') : '' }}>
                                        <label for="health-no">No
                                            {{-- {{ $parents_information->parents_information->health_insurance_policy }}  --}}
                                        </label>
                                    </div>

                                    <div class="row">
                                        <div class="" id="step-father-yes-fields" style="display: none;">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="coverage_in">What state is the coverage
                                                        in?</label>
                                                    <input type="text" name="coverage_in" class="form-control"
                                                        placeholder="coverage in"
                                                        value="{{ old('coverage_in', isset($parents_information->parents_information->coverage_in) ? $parents_information->parents_information->coverage_in : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_name">Step-Parent Name:</label>
                                                    <input type="text" name="parent_name" class="form-control"
                                                        placeholder="Step-Parent Name"
                                                        value="{{ old('parent_name', isset($parents_information->parents_information->parent_name) ? $parents_information->parents_information->parent_name : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_name_ssn">Step-Parent Name
                                                        SSN:</label>
                                                    <input type="text" name="parent_name_ssn" class="form-control"
                                                        placeholder="Step-Parent Name SSN"
                                                        value="{{ old('parent_name_ssn', isset($parents_information->parents_information->parent_name_ssn) ? $parents_information->parents_information->parent_name_ssn : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_name_dob">Step-Parent Date of
                                                        Birth:</label>
                                                    <input type="date" name="parent_name_dob" class="form-control"
                                                        placeholder="date of birth"
                                                        value="{{ old('parent_name_dob', isset($parents_information->parents_information->parent_name_dob) ? $parents_information->parents_information->parent_name_dob : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_current_address">Step-Parent Current
                                                        address</label>
                                                    <input type="text" name="parent_current_address"
                                                        class="form-control" placeholder="parent current address"
                                                        value="{{ old('parent_current_address', isset($parents_information->parents_information->parent_current_address) ? $parents_information->parents_information->parent_current_address : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_home_phone">Step-Parent Home
                                                        Phone</label>
                                                    <input type="text" name="parent_home_phone" class="form-control"
                                                        placeholder="parent home phone"
                                                        value="{{ old('parent_home_phone', isset($parents_information->parents_information->parent_home_phone) ? $parents_information->parents_information->parent_home_phone : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_cell_phone">Step-Parent cell
                                                        Phone</label>
                                                    <input type="text" name="parent_cell_phone" class="form-control"
                                                        placeholder="parent cell phone"
                                                        value="{{ old('parent_cell_phone', isset($parents_information->parents_information->parent_cell_phone) ? $parents_information->parents_information->parent_cell_phone : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_email">Step-Parent email</label>
                                                    <input type="text" name="parent_email" class="form-control"
                                                        placeholder="parent email"
                                                        value="{{ old('parent_email', isset($parents_information->parents_information->parent_email) ? $parents_information->parents_information->parent_email : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Primaary Insurance
                                                        Name</label>
                                                    <input type="text" name="parent_primary_insurance_name"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primaary Insurance Name"
                                                        value="{{ old('parent_primary_insurance_name', isset($parents_information->parents_information->parent_primary_insurance_name) ? $parents_information->parents_information->parent_primary_insurance_name : '') }}">>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Primary Insurance
                                                        id</label>
                                                    <input type="text" name="parent_primary_insurance_id"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primaary Insurance Id"
                                                        value="{{ old('parent_primary_insurance_id', isset($parents_information->parents_information->parent_primary_insurance_id) ? $parents_information->parents_information->parent_primary_insurance_id : '') }}">>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_primary_insurance_group">Step-Parent
                                                        Primary
                                                        Insurance Group</label>
                                                    <input type="text" name="parent_primary_insurance_group"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primary Insurance Group"
                                                        value="{{ old('parent_primary_insurance_group', isset($parents_information->parents_information->parent_primary_insurance_group) ? $parents_information->parents_information->parent_primary_insurance_group : '') }}">>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels"
                                                        for="parent_secondary_insurance_name">Step-Parent
                                                        Secondary
                                                        Insurance Name</label>
                                                    <input type="text" name="parent_secondary_insurance_name"
                                                        class="form-control"
                                                        placeholder="Step-Parent Secondary Insurance Name"value="{{ old('parent_secondary_insurance_name', isset($parents_information->parents_information->parent_secondary_insurance_name) ? $parents_information->parents_information->parent_secondary_insurance_name : '') }}">>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_secondary_insurance_id">Step-Parent
                                                        Secondary
                                                        Insurance Id</label>
                                                    <input type="text" name="parent_secondary_insurance_id"
                                                        class="form-control"
                                                        placeholder="Step-Parent Secondary Insurance Id"value="{{ old('parent_secondary_insurance_id', isset($parents_information->parents_information->parent_secondary_insurance_id) ? $parents_information->parents_information->parent_secondary_insurance_id : '') }}">>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels"
                                                        for="parent_secondary_insurance_group">Step-Parent
                                                        Secondary
                                                        Insurance Group</label>
                                                    <input type="text" name="parent_secondary_insurance_group"
                                                        class="form-control"
                                                        placeholder="Step-Parent Secondary Insurance Group"value="{{ old('parent_secondary_insurance_group', isset($parents_information->parents_information->parent_secondary_insurance_group) ? $parents_information->parents_information->parent_secondary_insurance_group : '') }}">>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // Get references to the radio buttons and the related form field section
                                        const healthYesRadio2 = document.getElementById("step-health-yes");
                                        const healthNoRadio3 = document.getElementById("step-health-no");
                                        const fatherYesFieldsSections = document.getElementById("step-father-yes-fields");

                                        // Function to handle radio button changes and toggle the section visibility
                                        function handleRadioChange() {
                                            if (healthYesRadio2.checked) {
                                                fatherYesFieldsSections.style.display = "block";
                                            } else if (healthNoRadio3.checked) {
                                                fatherYesFieldsSections.style.display = "none";
                                            }
                                        }

                                        // Add event listeners to the "health-yes" and "health-no" radio buttons to handle changes
                                        healthYesRadio2.addEventListener("change", handleRadioChange);
                                        healthNoRadio3.addEventListener("change", handleRadioChange);

                                        // Call the function initially to set the initial visibility state
                                        handleRadioChange();
                                    </script>
                                </div>
                                {{-- Father Form Ends --}}

                                {{-- Mother Form Start --}}
                                <div>
                                    <h2 class="text-white mt-5 mb-3">*Biological or Adoptive Mother</h2>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="mother_type">
                                            <option value="">Select Mother Type</option>
                                            <option value="1"
                                                {{ old('mother_type', isset($parents_informations->parents_informations->mother_type) && $parents_informations->parents_informations->mother_type == 1 ? 'selected' : '') }}>
                                                Biological</option>
                                            <option value="2"
                                                {{ old('mother_type', isset($parents_informations->parents_informations->mother_type) && $parents_informations->parents_informations->mother_type == 2 ? 'selected' : '') }}>
                                                Adaptive</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="labels" for="mother_name">Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control"
                                                placeholder="Mother Name"
                                                value="{{ old('mother_name', isset($parents_informations->parents_informations->mother_name) ? $parents_informations->parents_informations->mother_name : '') }}"
                                                required>
                                            @error('mother_name')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="mother_ssn">Mother SSN</label>
                                            <input type="text" name="mother_ssn" class="form-control"
                                                placeholder="Mother SSN"
                                                value="{{ old('mother_ssn', isset($parents_informations->parents_informations->mother_ssn) ? $parents_informations->parents_informations->mother_ssn : '') }}"
                                                required>
                                            @error('mother_ssn')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="mother_dob">Mother DOB</label>
                                            <input type="date" name="mother_dob" id="datepicker"
                                                class="form-control flatpicker-input" placeholder="Mother Date of Birth"
                                                value="{{ old('mother_dob', isset($parents_informations->parents_informations->mother_dob) ? $parents_informations->parents_informations->mother_dob : '') }}"
                                                required>
                                            @error('mother_dob')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="labels" for="">Current Address(Street, City, State,
                                                Zip):</label>
                                            <input type="text" name="mother_current_address" class="form-control"
                                                placeholder="Address"
                                                value="{{ old('mother_current_address', isset($parents_informations->parents_informations->mother_current_address) ? $parents_informations->parents_informations->mother_current_address : '') }}"
                                                required>
                                            @error('mother_current_address')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Home Phone#</label>
                                            <input type="text" name="mother_home_phone" class="form-control"
                                                placeholder="Home Phone"
                                                value="{{ old('mother_home_phone', isset($parents_informations->parents_informations->mother_home_phone) ? $parents_informations->parents_informations->mother_home_phone : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Cell Phone#</label>
                                            <input type="text" name="mother_cell_phone" class="form-control"
                                                placeholder="Cell Phone"
                                                value="{{ old('mother_cell_phone', isset($parents_informations->parents_informations->mother_cell_phone) ? $parents_informations->parents_informations->mother_cell_phone : '') }}"
                                                required>
                                            @error('mother_cell_phone')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Email</label>
                                            <input type="email" name="mother_email" class="form-control"
                                                placeholder="Email"
                                                value="{{ old('mother_email', optional($parents_informations->parents_informations)->mother_email) }}"
                                                required>
                                            @error('mother_email')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <label for="does_client_live_with_the_mother">Does the client live with the
                                        mother?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-yes" name="client_live_with_the_mother"
                                            value="1"
                                            {{ old('client_live_with_the_mother', isset($parents_informations->parents_informations->client_live_with_the_mother) && $parents_informations->parents_informations->client_live_with_the_mother == 1 ? 'checked' : '') }}>
                                        <label for="mother-yes">Yes</label>
                                        <input type="radio" id="mother-no" name="client_live_with_the_mother"
                                            value="2"
                                            {{ old('client_live_with_the_mother', isset($parents_informations->parents_informations->client_live_with_the_mother) && $parents_informations->parents_informations->client_live_with_the_mother == 2 ? 'checked' : '') }}>
                                        <label for="mother-no">No</label>
                                    </div>

                                    <label for="Is client covered under Mother’s Health Insurance policy?">Does mother
                                        carry
                                        health insurance for client?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-health-yes"
                                            name="mother_health_insurance_for_client" value="1"
                                            @if (old(
                                                    'mother_health_insurance_for_client',
                                                    isset($parents_informations->parents_informations->mother_health_insurance_for_client) &&
                                                    $parents_informations->parents_informations->mother_health_insurance_for_client == 1
                                                        ? 'checked'
                                                        : ''))  @endif>
                                        <label for="mother-health-yes">Yes</label>
                                        <input type="radio" id="mother-health-no"
                                            name="mother_health_insurance_for_client" value="2"
                                            {{ old('mother_health_insurance_for_client', isset($parents_informations->parents_informations->mother_health_insurance_for_client) && $parents_informations->parents_informations->mother_health_insurance_for_client == 2 ? 'checked' : '') }}>
                                        <label for="mother-health-no">No</label>
                                    </div>


                                    <div id="mothers-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_name">Primary Insurance Name:</label>
                                            <input type="text" name="mother_primary_insurance_name"
                                                value="{{ old('mother_primary_insurance_name', isset($parents_informations->parents_informations->mother_primary_insurance_name) ? $parents_informations->parents_informations->mother_primary_insurance_name : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="primary_insurance_id">Primary Insurance ID:</label>
                                            <input type="text" name="mother_primary_insurance_id"
                                                value="{{ old('mother_primary_insurance_id', isset($parents_informations->parents_informations->mother_primary_insurance_id) ? $parents_informations->parents_informations->mother_primary_insurance_id : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_group">Primary Insurance Group:</label>
                                            <input type="text" name="mother_primary_insurance_group"
                                                value="{{ old('mother_primary_insurance_group', isset($parents_informations->parents_informations->mother_primary_insurance_group) ? $parents_informations->parents_informations->mother_primary_insurance_group : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_name">Secondary Insurance Name:</label>
                                            <input type="text" name="mother_secondary_insurance_name"
                                                value="{{ old('mother_secondary_insurance_name', isset($parents_informations->parents_informations->mother_secondary_insurance_name) ? $parents_informations->parents_informations->mother_secondary_insurance_name : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_id">Secondary Insurance ID:</label>
                                            <input type="text" name="mother_secondary_insurance_id"
                                                value="{{ old('mother_secondary_insurance_id', isset($parents_informations->parents_informations->mother_secondary_insurance_id) ? $parents_informations->parents_informations->mother_secondary_insurance_id : '') }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_group">Secondary Insurance
                                                Group:</label>
                                            <input type="text" name="mother_Secondary_insurance_group"
                                                value="{{ old('mother_Secondary_insurance_group', isset($parents_informations->parents_informations->mother_Secondary_insurance_group) ? $parents_informations->parents_informations->mother_Secondary_insurance_group : '') }}">
                                        </div>
                                    </div>


                                    <script>
                                        // Get references to the radio buttons and the related form field section for the mother
                                        const motherhealthYesRadio = document.getElementById("mother-health-yes");
                                        const motherhealthNoRadio = document.getElementById("mother-health-no");
                                        const mothersYesFieldsSection = document.getElementById("mothers-yes-fields");

                                        // Function to handle radio button changes and toggle the section visibility
                                        function handleRadioChange() {
                                            if (motherhealthYesRadio.checked) {
                                                mothersYesFieldsSection.style.display = "block";
                                            } else if (motherhealthNoRadio.checked) {
                                                mothersYesFieldsSection.style.display = "none";
                                            }
                                        }

                                        // Add event listeners to the "health-yes" and "health-no" radio buttons to handle changes
                                        motherhealthYesRadio.addEventListener("change", handleRadioChange);
                                        motherhealthNoRadio.addEventListener("change", handleRadioChange);

                                        // Call the function initially to set the initial visibility state
                                        handleRadioChange();
                                    </script>


                                    <label for="does_client_live_with_the_mother">Does the client live with the
                                        Step-parent's?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-yes" name="step_living_with_the_client"
                                            value="1"
                                            {{ old('step_living_with_the_client', isset($parents_informations->parents_informations->step_living_with_the_client) && $parents_informations->parents_informations->step_living_with_the_client == 1 ? 'checked' : '') }}>
                                        <label for="mother-yes">Yes</label>
                                        <input type="radio" id="mother-no" name="step_living_with_the_client"
                                            value="2"
                                            {{ old('step_living_with_the_client', isset($parents_informations->parents_informations->step_living_with_the_client) && $parents_informations->parents_informations->step_living_with_the_client == 2 ? 'checked' : '') }}>
                                        <label for="mother-no">No</label>
                                    </div>

                                    <label for="Is client covered under Mother’s Health Insurance policy?">Is the client
                                        covered under Step-Parent Health Insurance policy?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="step1-health-yes" name="health_insurance_policy"
                                            value="1"
                                            {{ old('step_living_with_the_client', isset($parents_informations->parents_informations->step_living_with_the_client) && $parents_informations->parents_informations->step_living_with_the_client == 1 ? 'checked' : '') }}>
                                        <label for="step-health-yes">Yes</label>
                                        <input type="radio" id="step2-health-no" name="health_insurance_policy"
                                            value="2"
                                            {{ old('health_insurance_policy', isset($parents_informations->parents_informations->health_insurance_policy) && $parents_informations->parents_informations->health_insurance_policy == 2 ? 'checked' : '') }}>
                                        <label for="mother-health-no">No</label>
                                    </div>

                                    <div class="row" id="step-mother-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Name:</label>
                                                <input type="text" name="coverage_in" class="form-control"
                                                    placeholder="Coverage In"
                                                    value="{{ old('coverage_in', isset($parents_informations->parents_informations->coverage_in) ? $parents_informations->parents_informations->coverage_in : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Name:</label>
                                                <input type="text" name="parent_name" class="form-control"
                                                    placeholder="Step-Parent Name"
                                                    value="{{ old('parent_name', isset($parents_informations->parents_informations->parent_name) ? $parents_informations->parents_informations->parent_name : '') }}">
                                            </div>
                                        </div>
                                        <!-- Continue adding the remaining fields with isset checks -->
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Name SSN:</label>
                                            <input type="text" name="parent_name_ssn" class="form-control"
                                                placeholder="Step-Parent Name SSN">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Date of Birth:</label>
                                            <input type="date" name="parent_name_dob" id="datepicker"
                                                class="form-control flatpicker-input" placeholder="date of birth">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Home Phone</label>
                                            <input type="text" name="parent_home_phone" class="form-control"
                                                placeholder="parent home phone"
                                                value="{{ old('parent_home_phone', isset($parents_informations->parents_informations->parent_home_phone) ? $parents_informations->parents_informations->parent_home_phone : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Cell Phone</label>
                                            <input type="text" name="parent_cell_phone" class="form-control"
                                                placeholder="parent cell phone"
                                                value="{{ old('parent_cell_phone', isset($parents_informations->parents_informations->parent_cell_phone) ? $parents_informations->parents_informations->parent_cell_phone : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Email</label>
                                            <input type="text" name="parent_email" class="form-control"
                                                placeholder="parent email"
                                                value="{{ old('parent_email', isset($parents_informations->parents_informations->parent_email) ? $parents_informations->parents_informations->parent_email : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Primary Insurance
                                                Name</label>
                                            <input type="text" name="parent_primary_insurance_name"
                                                class="form-control" placeholder="Step-Parent Primary Insurance Name"
                                                value="{{ old('parent_primary_insurance_name', isset($parents_informations->parents_informations->parent_primary_insurance_name) ? $parents_informations->parents_informations->parent_primary_insurance_name : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Step-Parent Primary Insurance ID</label>
                                            <input type="text" name="parent_primary_insurance_id" class="form-control"
                                                placeholder="Step-Parent Primary Insurance ID"
                                                value="{{ old('parent_primary_insurance_id', isset($parents_informations->parents_informations->parent_primary_insurance_id) ? $parents_informations->parents_informations->parent_primary_insurance_id : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="parent_primary_insurance_group">Step-Parent Primary
                                                Insurance Group</label>
                                            <input type="text" name="parent_primary_insurance_group"
                                                class="form-control" placeholder="Step-Parent Primary Insurance Group"
                                                value="{{ old('parent_primary_insurance_group', isset($parents_informations->parents_informations->parent_primary_insurance_group) ? $parents_informations->parents_informations->parent_primary_insurance_group : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="parent_secondary_insurance_name">Step-Parent
                                                Secondary
                                                Insurance Name</label>
                                            <input type="text" name="parent_secondary_insurance_name"
                                                class="form-control" placeholder="Step-Parent Secondary Insurance Name"
                                                value="{{ old('parent_secondary_insurance_name', isset($parents_informations->parents_informations->parent_secondary_insurance_name) ? $parents_informations->parents_informations->parent_secondary_insurance_name : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="parent_secondary_insurance_id">Step-Parent
                                                Secondary
                                                Insurance ID</label>
                                            <input type="text" name="parent_secondary_insurance_id"
                                                class="form-control" placeholder="Step-Parent Secondary Insurance ID"
                                                value="{{ old('parent_secondary_insurance_id', isset($parents_informations->parents_informations->parent_secondary_insurance_id) ? $parents_informations->parents_informations->parent_secondary_insurance_id : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="parent_secondary_insurance_group">Step-Parent
                                                Secondary
                                                Insurance Group</label>
                                            <input type="text" name="parent_secondary_insurance_group"
                                                class="form-control" placeholder="Step-Parent Secondary Insurance Group"
                                                value="{{ old('parent_secondary_insurance_group', isset($parents_informations->parents_informations->parent_secondary_insurance_group) ? $parents_informations->parents_informations->parent_secondary_insurance_group : '') }}">
                                        </div>
                                    </div>
                                    <!-- Continue adding isset checks for the remaining fields in a similar manner -->

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels">Initials</label>
                                            <input type="text" name="initials" class="form-control"
                                                placeholder="Initials"
                                                value="{{ old('initials', isset($parents_informations->parents_informations->initials) ? $parents_informations->parents_informations->initials : '') }}">
                                        </div>
                                    </div>

                                    {{-- Mother Table Ends --}}
                                    <div class="form-group mt-4 col-lg-12">
                                        <button class="btn btn-primary" type="submit"
                                            onclick="validateForm()">Next</button>
                                    </div>

                                </div>
                            </div>
                            <script>
                                // Get references to the radio buttons and the related form field section for the mother
                                const stepmotherYesRadio = document.getElementById("step1-health-yes");
                                const stepmotherNoRadio = document.getElementById("step2-health-no");
                                const stepmotherYesFields = document.getElementById("step-mother-yes-fields");

                                // Function to handle radio button changes and toggle the section visibility
                                function handleRadioChange() {
                                    if (stepmotherYesRadio.checked) {
                                        stepmotherYesFields.style.display = "block";
                                    } else if (stepmotherNoRadio.checked) {
                                        stepmotherYesFields.style.display = "none";
                                    }
                                }

                                // Add event listeners to the mother's radio buttons to handle changes
                                stepmotherYesRadio.addEventListener("change", handleRadioChange);
                                stepmotherNoRadio.addEventListener("change", handleRadioChange);

                                // Call the function initially to set the initial visibility state
                                handleRadioChange();
                            </script>
                        </div>
                    </form>
                </div>
                {{-- Parents Information  Ends --}}
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
                } else {
                    // Remove Bootstrap error class if previously added
                    input.classList.remove('is-invalid');
                }
            });
        }
    </script>
@endsection
