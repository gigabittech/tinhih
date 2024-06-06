@extends('admin.layout.template')

<style>
    # btn btn-btn primary {
        font-family: 'Arial', sans-serif;
    }

    .tab-container {
        display: flex;
        margin-bottom: 0px;
    }

    .tab {
        flex: 1;
        padding: 15px 5px !important;
        text-align: center;
        background-color: #000;
        cursor: pointer;
        color: #fff !important;
    }

    .tab:hover {
        background-color: #222;
    }

    .tab-content {
        display: none;
    }

    .buttons {
        margin-top: 20px;
        width: 100%;
    }

    button {
        margin-right: 10px;


    }

    .tab-content.show.active {
        display: block !important;
    }



    body {
        font-family: Arial, sans-serif;
    }

    legend {
        color: rgb(255, 221, 0);
        display: flex;
        justify-content: center;
    }

    h1 {
        text-align: center;
        color: #fff;

    }


    fieldset {
        border: 1px solid #e0e0e0;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 20px;

    }

    label {
        display: block;
        margin-top: 10px;
        color: #fff;
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="date"] {
        width: 100%;
        padding: 5px;
        margin: 5px 0;
    }

    input[type="radio"] {
        margin-right: 10px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Style for the radio options */
    /* Style for the radio options */
    .radio-options {
        display: flex;


        justify-content: flex-start;
    }

    .radio-options input[type="radio"] {
        margin-left: 10px;
    }

    label {

        display: block;
        margin-top: 15px;
    }

    #btn {
        width: 100%;
    }

    */
</style>


@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black">

        <div class="row">

            <div class="col-lg-12 bg-dark1 p-5">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif

                <div id="multiStepForm">
                    <div class="tab-container bg-dark">
                        <div class="tab nav-link active" onclick="showTab(1)">Insurance</div>
                        <div class="tab" onclick="showTab(2)">Parents Information</div>
                        <div class="tab" onclick="showTab(3)">Household and Emergency</div>
                        <div class="tab" onclick="showTab(4)">DFS custody</div>
                        <div class="tab" onclick="showTab(5)">Prior Treatment and Therapy</div>
                        <div class="tab" onclick="showTab(6)">Relationship</div>
                        <div class="tab" onclick="showTab(7)">Domestic Violence</div>
                        <div class="tab" onclick="showTab(8)">School/Work Identifying Data</div>
                        <div class="tab" onclick="showTab(9)">Symptoms and Corelated-Symptoms</div>

                    </div>

                    {{-- Insurance Start --}}
                    <div class="tab-content show-active" data-tab="1">
                        <h2 class="text-white mt-5">Insurance Information</h2>
                        <form action="{{ route('insurance.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- Insurance Table Start --}}
                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="primary_insurance_name">Primary Insurance Name:</label>
                                        <input type="text" name="primary_insurance_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="primary_insurance_id">ID#:</label>
                                        <input type="text" name="primary_insurance_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="primary_insurance_group">Group#:</label>
                                        <input type="text" name="primary_insurance_group" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="secondary_insurance_name">Secondary Insurance Name:</label>
                                        <input type="text" name="secondary_insurance_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="secondary_insurance_id">ID#:</label>
                                        <input type="text" name="secondary_insurance_id" class ="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="secondary_insurance_group">Group#:</label>
                                        <input type="text" name="secondary_insurance_group" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_primary_insurance_name">Spouse Primary Insurance Name:</label>
                                        <input type="text" name="spouse_primary_insurance_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_primary_insurance_id">ID#:</label>
                                        <input type="text" name="spouse_primary_insurance_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_primary_insurance_group">Group#:</label>
                                        <input type="text" name="spouse_primary_insurance_group" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_secondary_insurance_name">Spouse Secondary Insurance
                                            Name:</label>
                                        <input type="text" name="spouse_secondary_insurance_name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_secondary_insurance_id">ID#:</label>
                                        <input type="text" name="spouse_secondary_insurance_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="spouse_secondary_insurance_group">Group#:</label>
                                        <input type="text" name="spouse_secondary_insurance_group"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="covered_by_commercial_insurance">Have you ever been covered by a
                                            commercial insurance policy?</label>
                                        <div class="radio-options">
                                            <input type="radio" name="commercial_insurance_policy" value="1">
                                            <label class="labels">Yes</label>
                                            <input type="radio" name="commercial_insurance_policy" value="2">
                                            <label class="labels">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="current_coverage">Is this policy still current?</label><br>
                                        <div class="radio-options">
                                            <input type="radio" name="policy_still_current" value="1">
                                            <label class="labels">Yes</label>
                                            <input type="radio" name="policy_still_current" value="2">
                                            <label class="labels">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="coverage_expired">Did that coverage expire?</label><br>
                                        <div class="radio-options">
                                            <input type="radio" name="coverage_expire" value="1">
                                            <label class="labels">Yes</label>
                                            <input type="radio" name="coverage_expire" value="2">
                                            <label class="labels">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <label for="expiration_date">If YES, list the expiration date:</label>
                                        <input type="date" name="expiration_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- Insurance Table Ends --}}


                            {{-- Others Insurance Table Start --}}
                            <div class="row profile-field">
                                <fieldset id="insurance">
                                    <h2 class=" text-white">Other Insurance Information</h2>

                                    <div class="form-group">
                                        <label for="are_you_or_your_child_covered_by_any_other_insurance">Are you or your
                                            child covered
                                            by any other insurance?</label>
                                        <div class="radio-options">
                                            <input type="radio" id="other-insurance-yes"
                                                name="are_you_or_your_child_covered_by_any_other_insurance"
                                                value="1">
                                            <label for="other-insurance-yes">Yes</label>
                                            <input type="radio" id="other-insurance-no"
                                                name="are_you_or_your_child_covered_by_any_other_insurance"
                                                value="2">
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
                                                    class="form-control">
                                            </div>

                                            <div class="col-lg-6 form-group">
                                                <label for="insurance_name">Insurance Name</label>
                                                <input type="text" name="insurance_name" class="form-control">
                                            </div>

                                            <div class="col-lg-6 form-group">
                                                <label for="language_preference">Insurance ID</label>
                                                <input type="text" name="insurance_id" class="form-control">
                                            </div>

                                            <div class="col-lg-6 form-group">
                                                <label for="cultural_ethnic_background">Insurance Group</label>
                                                <input type="text" name="insurance_group" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                {{-- Others Insurance Table Ends --}}
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"> Submit </button>
                            </div>
                            <script>
                                const yesRadios = document.getElementById("other-insurance-yes");
                                const noRadios = document.getElementById("other-insurance-no");
                                const insuranceSection1 = document.getElementById("additional-insurance-info");

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



                    {{-- Parents Information Starts --}}
                    <div class="tab-content" data-tab="2">
                        <form action="{{ route('identifying.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="profile-field">
                                <div class="row">

                                    {{-- Father Table Start --}}
                                    <div class="form-group">
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="client_id"
                                            class="form-control" autocomplete="off">
                                    </div>

                                    <h2 class="text-white mt-5 mb-3">*Biological or Adoptive Father</h2>
                                    <div class="form-group">
                                        <select class="form-control" name="father_type">
                                            <option value="">Select Father Type</option>
                                            <option value="1">Biological</option>
                                            <option value="2">Adaptive</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="labels" for="">Father Name</label>
                                            <input type="text" name="father_name" class="form-control"
                                                placeholder="Father Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="">Father SSN</label>
                                            <input type="text" name="father_ssn" class="form-control"
                                                placeholder="Father SSN">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="">Father DOB</label>
                                            <input type="date" name="father_dob" class="form-control"
                                                placeholder="Father Date of Birth">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="labels" for="">Current Address(Street, City, State,
                                                Zip):</label>
                                            <input type="text" name="father_current_address" class="form-control"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Home Phone#</label>
                                            <input type="text" name="father_home_phone" class="form-control"
                                                placeholder="Home Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Cell Phone#</label>
                                            <input type="text" name="father_cell_phone" class="form-control"
                                                placeholder="Cell Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Email</label>
                                            <input type="email" name="father_email" class="form-control"
                                                placeholder="Email">
                                        </div>
                                    </div>

                                    <label for="does_client_live_with_the_father">Does the client live with the
                                        father?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="father-yes" name="client_live_with_the_father"
                                            value="1">
                                        <label for="father-yes">Yes</label>
                                        <input type="radio" id="father-no" name="client_live_with_the_father"
                                            value="2">
                                        <label for="father-no">No</label>
                                    </div>

                                    <label for="Is client covered under a Step-Parent’s Health Insurance policy?">Does
                                        father
                                        carry health insurance for client?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="health-yes" name="health_insurance_for_client"
                                            value="1">
                                        <label for="health-yes">Yes</label>
                                        <input type="radio" id="health-no" name="health_insurance_for_client"
                                            value="2">
                                        <label for="health-no">No</label>
                                    </div>


                                    <div id="fathers-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_name">Primary Insurance Name:</label>
                                            <input type="text" name="father_primary_insurance_name">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="primary_insurance_id">Primary Insurance ID:</label>
                                            <input type="text" name="primary_insurance_id">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_group">Primary Insurance Group:</label>
                                            <input type="text" name="father_primary_insurance_group">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_secondary_insurance_name">Secondary Insurance Name:</label>
                                            <input type="text" name="father_secondary_insurance_name">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_id">Secondary Insurance ID:</label>
                                            <input type="text" name="father_secondary_insurance_id">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_group">Secondary Insurance
                                                Group:</label>
                                            <input type="text" name="father_secondary_insurance_group">
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
                                            value="1">
                                        <label for="father-yes">Yes</label>
                                        <input type="radio" id="step-father-no" name="step_living_with_the_client"
                                            value="2">
                                        <label for="father-no">No</label>
                                    </div>

                                    <label for="Is client covered under a Step-Parent’s Health Insurance policy?">Is client
                                        covered under a Step-Parent’s Health Insurance policy?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="step-health-yes" name="health_insurance_policy"
                                            value="1">
                                        <label for="health-yes">Yes</label>
                                        <input type="radio" id="step-health-no" name="health_insurance_policy"
                                            value="2">
                                        <label for="health-no">No</label>
                                    </div>

                                    <div class="row">
                                        <div class="" id="step-father-yes-fields" style="display: none;">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">What state is the coverage
                                                        in?</label>
                                                    <input type="text" name="coverage_in" class="form-control"
                                                        placeholder="coverage in">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Name:</label>
                                                    <input type="text" name="parent_name" class="form-control"
                                                        placeholder="Step-Parent Name">
                                                </div>
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
                                                    <label class="labels" for="">Step-Parent Date of
                                                        Birth:</label>
                                                    <input type="date" name="parent_name_dob" class="form-control"
                                                        placeholder="date of birth">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Current
                                                        address</label>
                                                    <input type="text" name="parent_current_address"
                                                        class="form-control" placeholder="parent current address">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Home Phone</label>
                                                    <input type="text" name="parent_home_phone" class="form-control"
                                                        placeholder="parent home phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent cell Phone</label>
                                                    <input type="text" name="parent_cell_phone" class="form-control"
                                                        placeholder="parent cell phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent email</label>
                                                    <input type="text" name="parent_email" class="form-control"
                                                        placeholder="parent email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Primaary Insurance
                                                        Name</label>
                                                    <input type="text" name="parent_primary_insurance_name"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primaary Insurance Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="">Step-Parent Primary Insurance
                                                        id</label>
                                                    <input type="text" name="parent_primary_insurance_id"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primaary Insurance Id">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_primary_insurance_group">Step-Parent
                                                        Primary
                                                        Insurance Group</label>
                                                    <input type="text" name="parent_primary_insurance_group"
                                                        class="form-control"
                                                        placeholder="Step-Parent Primary Insurance Group">
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
                                                        placeholder="Step-Parent Secondary Insurance Name">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="labels" for="parent_secondary_insurance_id">Step-Parent
                                                        Secondary
                                                        Insurance Id</label>
                                                    <input type="text" name="parent_secondary_insurance_id"
                                                        class="form-control"
                                                        placeholder="Step-Parent Secondary Insurance Id">
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
                                                        placeholder="Step-Parent Secondary Insurance Group">
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

                                    {{-- Father Table Ends --}}

                                    {{-- Mother Table Start --}}
                                    <h2 class="text-white mt-5 mb-3">*Biological or Adoptive Mother</h2>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="mother_type">
                                            <option value="">Select Mother Type</option>
                                            <option value="1">Biological</option>
                                            <option value="2">Adaptive</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="labels" for="">Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control"
                                                placeholder="Mother Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="">Mother SSN</label>
                                            <input type="text" name="mother_ssn" class="form-control"
                                                placeholder="Mother SSN">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="labels" for="">Mother DOB</label>
                                            <input type="date" name="mother_dob" class="form-control"
                                                placeholder="Mother Date of Birth">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="labels" for="">Current Address(Street, City, State,
                                                Zip):</label>
                                            <input type="text" name="mother_current_address" class="form-control"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Home Phone#</label>
                                            <input type="text" name="mother_home_phone" class="form-control"
                                                placeholder="Home Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Cell Phone#</label>
                                            <input type="text" name="mother_cell_phone" class="form-control"
                                                placeholder="Home Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels" for="">Email</label>
                                            <input type="email" name="mother_email" class="form-control"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <label for="does_client_live_with_the_mother">Does the client live with the
                                        mother?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-yes" name="client_live_with_the_mother"
                                            value="1">
                                        <label for="father-yes">Yes</label>
                                        <input type="radio" id="mother-no" name="client_live_with_the_mother"
                                            value="2">
                                        <label for="father-no">No</label>
                                    </div>

                                    <label for="Is client covered under Mother’s Health Insurance policy?">Does mother
                                        carry
                                        health insurance for client?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-health-yes"
                                            name="mother_health_insurance_for_client" value="1">
                                        <label for="mother-health-yes">Yes</label>
                                        <input type="radio" id="mother-health-no"
                                            name="mother_health_insurance_for_client" value="2">
                                        <label for="mother-health-no">No</label>
                                    </div>

                                    <div id="mothers-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_name">Primary Insurance Name:</label>
                                            <input type="text" name="mother_primary_insurance_name">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="primary_insurance_id">Primary Insurance ID:</label>
                                            <input type="text" name="mother_primary_insurance_id">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_primary_insurance_group">Primary Insurance Group:</label>
                                            <input type="text" name="mother_primary_insurance_group">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_secondary_insurance_name">Secondary Insurance Name:</label>
                                            <input type="text" name="mother_secondary_insurance_name">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_id">Secondary Insurance ID:</label>
                                            <input type="text" name="mother_secondary_insurance_id">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="father_Secondary_insurance_group">Secondary Insurance
                                                Group:</label>
                                            <input type="text" name="mother_Secondary_insurance_group">
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
                                            } else if (mothersYesFieldsSection.checked) {
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
                                        Step-paremt's?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="mother-yes" name="step_living_with_the_client"
                                            value="1">
                                        <label for="mother-yes">Yes</label>
                                        <input type="radio" id="mother-no" name="step_living_with_the_client"
                                            value="2">
                                        <label for="mother-no">No</label>
                                    </div>

                                    <label for="Is client covered under Mother’s Health Insurance policy?">Is the client
                                        covered under Step-Parent Health Insurance policy?</label>
                                    <div class="radio-options">
                                        <input type="radio" id="step1-health-yes" name="health_insurance_policy"
                                            value="1">
                                        <label for="step-health-yes">Yes</label>
                                        <input type="radio" id="step2-health-no" name="health_insurance_policy"
                                            value="2">
                                        <label for="mother-health-no">No</label>
                                    </div>

                                    <div class="row" id="step-mother-yes-fields" style="display: none;">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Name:</label>
                                                <input type="text" name="coverage_in" class="form-control"
                                                    placeholder="Coverage In">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Name:</label>
                                                <input type="text" name="parent_name" class="form-control"
                                                    placeholder="Step-Parent Name">
                                            </div>
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
                                                <input type="date" name="parent_name_dob" class="form-control"
                                                    placeholder="date of birth">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Current address</label>
                                                <input type="text" name="parent_current_address" class="form-control"
                                                    placeholder="parent current address">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Home Phone</label>
                                                <input type="text" name="parent_home_phone" class="form-control"
                                                    placeholder="parent home phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent cell Phone</label>
                                                <input type="text" name="parent_cell_phone" class="form-control"
                                                    placeholder="parent cell phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent email</label>
                                                <input type="text" name="parent_email" class="form-control"
                                                    placeholder="parent email">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Primaary Insurance
                                                    Name</label>
                                                <input type="text" name="parent_primary_insurance_name"
                                                    class="form-control"
                                                    placeholder="Step-Parent Primaary Insurance Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="">Step-Parent Primary Insurance
                                                    id</label>
                                                <input type="text" name="parent_primary_insurance_id"
                                                    class="form-control" placeholder="Step-Parent Primaary Insurance Id">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="parent_primary_insurance_group">Step-Parent
                                                    Primary
                                                    Insurance Group</label>
                                                <input type="text" name="parent_primary_insurance_group"
                                                    class="form-control"
                                                    placeholder="Step-Parent Primary Insurance Group">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="parent_secondary_insurance_name">Step-Parent
                                                    Secondary
                                                    Insurance Name</label>
                                                <input type="text" name="parent_secondary_insurance_name"
                                                    class="form-control"
                                                    placeholder="Step-Parent Secondary Insurance Name">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="parent_secondary_insurance_id">Step-Parent
                                                    Secondary
                                                    Insurance Id</label>
                                                <input type="text" name="parent_secondary_insurance_id"
                                                    class="form-control" placeholder="Step-Parent Secondary Insurance Id">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="labels" for="parent_secondary_insurance_group">Step-Parent
                                                    Secondary Insurance Group</label>
                                                <input type="text" name="parent_secondary_insurance_group"
                                                    class="form-control"
                                                    placeholder="Step-Parent Secondary Insurance Group">
                                            </div>
                                        </div>
                                        <!-- Continue adding the mother's fields as required -->
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="labels">Initials</label>
                                            <input type="text" name="initials" class="form-control"
                                                placeholder="Initials">
                                        </div>
                                    </div>
                                    {{-- Mother Table Ends --}}
                                    <div class="form-group mt-4 col-lg-12">
                                        <button class="btn btn-primary" type="submit">Submit</button>
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
                        </form>
                    </div>
                    {{-- Parents Information  Ends --}}


                    <!-- Household and Emergency Starts -->
                    <div class="tab-content" data-tab="3">
                        <form action="{{ route('household_emergency_contact.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Emergency Contacts -->
                            <h2 class="text-white mt-5">Emergency Contacts</h2>
                            <div class="row profile-field">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="contact_name">Contact Name:</label>
                                        <input type="text" name="contact_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="contact_relationship">Relationship</label>
                                        <input type="text" name="contact_relationship" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="contact_tel">Tel</label>
                                        <input type="text" name="contact_tel" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="contact_cell">Cell</label>
                                        <input type="text" name="contact_cell" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Household Members -->
                            <h2 class="text-white mt-4">Household Members</h2>
                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" name="age" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="relationship">Relationship</label>
                                        <input type="text" name="relationship" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    {{-- Household and Emergency ends here --}}



                    {{-- DFS custody Starts --}}
                    <div class="tab-content" data-tab="4">
                        <h2 class="text-white mt-5">DFS custody</h2>
                        <form action="{{ route('DFS_custody.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- DFS custody table -->

                            <div class="row profile-field">

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>

                                    <label>DFS Custody of your Children</label>
                                    <div class="radio-options">
                                        <input type="radio" name="dfs_custody_of_your_children" value="1">
                                        <label class="labels">Yes</label>
                                        <input type="radio" name="dfs_custody_of_your_children" value="2">
                                        <label class="labels">No</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label for="dfs_caseworker">DFS caseworker</label>
                                        <input type="text" name="dfs_caseworker" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="dfs_tel">tel</label>
                                        <input type="text" name="dfs_tel" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>DFS Caseworker email</label>
                                        <input type="email" name="dfs_email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>DFS Caseworker Office Location</label>
                                        <input type="text" name="dfs_location" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="Is client covered under Mother’s Health Insurance policy?">Juvenile Justice
                                        Custody of your Child</label>
                                    <div class="radio-options">
                                        <input type="radio" id="juvenile_Justice_Custody_of_your_child"
                                            name="juvenile_Justice_Custody_of_your_child" value="1">
                                        <label for="juvenile_Justice_Custody_of_your_child">Yes</label>
                                        <input type="radio" id="juvenile_Justice_Custody_of_your_child"
                                            name="juvenile_Justice_Custody_of_your_child" value="2">
                                        <label for="juvenile_Justice_Custody_of_your_child">No</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="child_probation_officer"> Child probation officer</label>
                                        <input type="text" name="child_probation_officer" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="child_probation_officer_tel">Child probation officer tel</label>
                                        <input type="text" name="child_probation_officer_tel" class="form-control">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    {{-- DFS custody Ends --}}



                    {{-- Prior Treatment and TherapyGoals Starts --}}
                    <div class="tab-content" data-tab="5">
                        <form action="{{ route('prior_treatment_therapy_goal.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- prior_treatment_therapy_goal custody table -->
                            <h2 class="text-white mt-5">Prior Treatment </h2>
                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>

                                    <label for="Is client covered under Mother’s Health Insurance policy?">Previous
                                        Therapy</label>
                                    <div class="radio-options">
                                        <input type="radio" id="previous_therapy" name="previous_therapy"
                                            value="1">
                                        <label for="previous_therapy">Yes</label>
                                        <input type="radio" id="previous_therapy"
                                            name="juvenile_Justice_Custody_of_your_child" value="2">
                                        <label for="previous_therapy">No</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="location">location</label>
                                        <input type="location" name="location" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="dates">Dates</label>
                                        <input type="date" name="dates" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="medication_name">Medication name</label>
                                        <input type="text" name="medication_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="medication_purpose">Medication purpose</label>
                                        <input type="text" name="medication_purpose" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="medication_dosage">Medication dosage</label>
                                        <input type="text" name="medication_dosage" class="form-control">
                                    </div>
                                </div>

                                <h2 class="text-white mt-5">Therapy Goals</h2>
                                <div class="row profile-field">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="goals">Goals</label>
                                            <input type="text" name="goals" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Prior Treatment starts -->

                    <!-- Relationship starts -->
                    <div class="tab-content" data-tab="6">

                        <style>
                            .form-check-input {
                                width: 1em;
                                height: 1em;
                                margin-top: 1pc;

                            }
                        </style>
                        <h2 class="text-white mt-5">Relationship</h2><br>
                        <form action="{{ route('relationship.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Relationship table -->
                            <h4 class="text-white">Best describes your or your child's relationship</h4>
                            <div class="row profile-field radio-options  ">
                                <div class="col-lg-4">
                                    <div class="radio-options">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12 ">

                                        <div class="form-check col-lg-10 ">
                                            <input class="form-check-input mt-8" type="checkbox"
                                                name="best_describes_your_or_your_childs_relationship"
                                                id="strong-relationships" value="1">
                                            <label class="" for="strong-relationships">I have several strong
                                                relationships</label>
                                        </div>
                                        <div class="form-check col-lg-10">
                                            <input class="form-check-input" type="checkbox"
                                                name="best_describes_your_or_your_childs_relationship" id="close-friends"
                                                value="2">
                                            <label class="" for="close-friends">I have a few close friends</label>
                                        </div>
                                        <div class="form-check col-lg-10">
                                            <input class="form-check-input" type="checkbox"
                                                name="best_describes_your_or_your_childs_relationship" id="no-friends"
                                                value="3">
                                            <label class="" for="no-friends">I have no friends</label>
                                        </div>
                                    </div>

                                    <h4 class="text-white mt-5">What describes your current relationships</h4>

                                    <div class="col-lg-12 ">

                                        <div class="form-check col-lg-12">
                                            <input class="form-check-input" type="checkbox"
                                                name="what_describes_your_current_relationships"
                                                id="emotionally_close_support" value="1">
                                            <label class="" for="emotionally_close_support">I am emotionally close
                                                and feel support with family</label>
                                        </div>

                                        <div class="form-check col-lg-12">
                                            <input class="form-check-input" type="checkbox"
                                                name="what_describes_your_current_relationships"
                                                id="emotionally_close_some_frustration" value="2">
                                            <label class="" for="emotionally_close_some_frustration">I am
                                                emotionally close to some family but others are a great source of
                                                frustration and stress</label>
                                        </div>

                                        <div class="form-check col-lg-12">
                                            <input class="form-check-input" type="checkbox"
                                                name="what_describes_your_current_relationships[]"
                                                id="no_family_in_community" value="no_family_in_community">
                                            <label class="" for="no_family_in_community">I have no family in the
                                                Las Vegas

                                        </div>

                                        <div class="form-check col-lg-12">
                                            <input class="form-check-input" type="checkbox"
                                                name="what_describes_your_current_relationships"
                                                id="family_tension_danger" value="4">
                                            <label class="" for="family_tension_danger">I have family living in
                                                Las Vegas but they are a source of great tension and/or danger</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group mt-4 ">
                                    <button id="btn" class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--  Relationship ends here --}}


                    {{--  Domestic Violence Start --}}
                    <div class="tab-content profile-field" data-tab="7">

                        <h2 class="text-white mt-5">Domestic Violence Screenings</h2>
                        <form action="{{ route('domestic_violence.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group col-lg-6 row">
                                        <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>


                            <!-- violent_in_the_home -->
                            <div class="form-group col-lg-6">
                                <label for="violent_in_the_home">Is there violence in the home?</label>
                                <div class="radio-options">
                                    <input type="radio" id="violent_in_the_home_yes" name="violent_in_the_home"
                                        value="1">
                                    <label for="violent_in_the_home_yes">Yes</label>
                                    <input type="radio"id="violent_in_the_home_no" name="violent_in_the_home"
                                        value="2">
                                    <label for="immigrant">No</label>
                                </div>
                            </div>

                            <!-- violent_in_the_home_describe -->
                            <div class="form-group col-lg-6 " id="violent_in_the_home_describe" style="display: none">
                                <label for="violent_in_the_home_describe">Describe the violence in the
                                    home:</label>
                                <textarea name="violent_in_the_home_describe" class="form-control"></textarea>

                            </div>

                            <!-- child_has_been_violent_in_the_home -->
                            <div class="form-group col-lg-6">
                                <label for="child_has_been_violent_in_the_home">Has the child been violent in the
                                    home?</label>
                                <div class="radio-options">
                                    <input type="radio" id="child_has_been_violent_in_the_home_yes"
                                        name="child_has_been_violent_in_the_home" value="1">
                                    <label for="child_has_been_violent_in_the_home_yes">Yes</label>
                                    <input type="radio" id="child_has_been_violent_in_the_home_no"
                                        name="child_has_been_violent_in_the_home" value="2">
                                    <label for="child_has_been_violent_in_the_home_no">No</label>
                                </div>
                            </div>

                            <!-- child_has_been_violent_in_the_home_describe -->
                            <div class="child_has_been_violent_in_the_home_describe "
                                id="child_has_been_violent_in_the_home_describe" style="display: none">
                                <label for="child_has_been_violent_in_the_home_describe">Describe the child's violence in
                                    the home:</label>
                                <textarea id="immigrant" name="child_has_been_violent_in_the_home_describe" class="form-control"></textarea>
                            </div>

                            <!-- my_spouse_has_been_violent_in_the_home -->
                            <div class="form-group col-lg-6">
                                <label for="my_spouse_has_been_violent_in_the_home">Has your spouse been violent in the
                                    home?</label>
                                <div class="radio-options">
                                    <input type="radio" id="my_spouse_has_been_violent_in_the_home_yes"
                                        name="my_spouse_has_been_violent_in_the_home" value="1">
                                    <label for="my_spouse_has_been_violent_in_the_home_yes">Yes</label>
                                    <input type="radio" id="my_spouse_has_been_violent_in_the_home_no"
                                        name="my_spouse_has_been_violent_in_the_home" value="2">
                                    <label for="my_spouse_has_been_violent_in_the_home_no">No</label>
                                </div>
                            </div>

                            <!-- my_spouse_has_been_violent_in_the_home_describe -->
                            <div class="my_spouse_has_been_violent_in_the_home_describe"
                                id="my_spouse_has_been_violent_in_the_home_describe" style="display: none">
                                <label for="my_spouse_has_been_violent_in_the_home_describe">Describe your spouse's
                                    violence in the home:</label>
                                <textarea name="my_spouse_has_been_violent_in_the_home_describe" class="form-control"></textarea>
                            </div>

                            <!-- witnessed_domestic_violence -->
                            <div class="form-group col-lg-6">
                                <label for="witnessed_domestic_violence">Have you witnessed domestic violence?</label>
                                <div class="radio-options">
                                    <input type="radio" id="witnessed_domestic_violence_yes"
                                        name="witnessed_domestic_violence" value="1">
                                    <label for="witnessed_domestic_violence_yes">Yes</label>
                                    <input type="radio" id="witnessed_domestic_violence_no"
                                        name="witnessed_domestic_violence" value="2">
                                    <label for="witnessed_domestic_violence_no">No</label>
                                </div>
                            </div>

                            <!-- witnessed_domestic_violence_describe -->
                            <div class="witnessed_domestic_violence_describe" id="witnessed_domestic_violence_describe"
                                style="display: none">
                                <label for="witnessed_domestic_violence_describe">Describe the domestic violence you
                                    witnessed:</label>
                                <textarea name="witnessed_domestic_violence_describe" class="form-control"></textarea>
                            </div>

                            <!-- weapons -->
                            <div class="form-group col-lg-6">
                                <label for="weapons">Are there weapons in the home?</label>
                                <div class="radio-options">
                                    <input type="radio" id="weapons_yes" name="weapons" value="1">
                                    <label for="weapons_yes">Yes</label>
                                    <input type="radio" id="weapons_no" name="weapons" value="2">
                                    <label for="weapons_no">No</label>
                                </div>
                            </div>

                            <!-- weapons_describe -->
                            <div class="weapons_describe " id="weapons_describe" style="display: none">
                                <label for="weapons_describe">Describe the weapons in the home:</label>
                                <textarea name="weapons_describe" class="form-control"></textarea>
                            </div>

                            <!-- initials -->
                            <div class="form-group col-lg-6">
                                <label for="initials">Initials</label>
                                <input type="text" name="initials" class="form-control">
                            </div>

                            <div class="form-group col-lg-12 mt-4">
                                <button id="btn" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                    <script>
                        const violentInHomeYesRadio = document.getElementById("violent_in_the_home_yes");
                        const violentInHomeNoRadio = document.getElementById("violent_in_the_home_no");
                        const violentInHomeDescribeField = document.getElementById("violent_in_the_home_describe");

                        // Get references to the radio buttons and the related form field sections for child's violence in the home
                        const childViolenceYesRadio = document.getElementById("child_has_been_violent_in_the_home_yes");
                        const childViolenceNoRadio = document.getElementById("child_has_been_violent_in_the_home_no");
                        const childViolenceDescribeField = document.getElementById("child_has_been_violent_in_the_home_describe");

                        // Get references to the radio buttons and the related form field sections for spouse's violence in the home
                        const spouseViolenceYesRadio = document.getElementById("my_spouse_has_been_violent_in_the_home_yes");
                        const spouseViolenceNoRadio = document.getElementById("my_spouse_has_been_violent_in_the_home_no");
                        const spouseViolenceDescribeField = document.getElementById("my_spouse_has_been_violent_in_the_home_describe");

                        // Get references to the radio buttons and the related form field sections for witnessing domestic violence
                        const witnessedDomesticViolenceYesRadio = document.getElementById("witnessed_domestic_violence_yes");
                        const witnessedDomesticViolenceNoRadio = document.getElementById("witnessed_domestic_violence_no");
                        const witnessedDomesticViolenceDescribeField = document.getElementById("witnessed_domestic_violence_describe");

                        // Get references to the radio buttons and the related form field sections for weapons in the home
                        const weaponsYesRadio = document.getElementById("weapons_yes");
                        const weaponsNoRadio = document.getElementById("weapons_no");
                        const weaponsDescribeField = document.getElementById("weapons_describe");

                        // Function to handle radio button changes and toggle the section visibility
                        function handleRadioChange() {
                            if (violentInHomeYesRadio.checked) {
                                violentInHomeDescribeField.style.display = "block";
                            } else {
                                violentInHomeDescribeField.style.display = "none";
                            }

                            if (childViolenceYesRadio.checked) {
                                childViolenceDescribeField.style.display = "block";
                            } else {
                                childViolenceDescribeField.style.display = "none";
                            }

                            if (spouseViolenceYesRadio.checked) {
                                spouseViolenceDescribeField.style.display = "block";
                            } else {
                                spouseViolenceDescribeField.style.display = "none";
                            }

                            if (witnessedDomesticViolenceYesRadio.checked) {
                                witnessedDomesticViolenceDescribeField.style.display = "block";
                            } else {
                                witnessedDomesticViolenceDescribeField.style.display = "none";
                            }

                            if (weaponsYesRadio.checked) {
                                weaponsDescribeField.style.display = "block";
                            } else {
                                weaponsDescribeField.style.display = "none";
                            }
                        }

                        // Add event listeners to the radio buttons to handle changes
                        violentInHomeYesRadio.addEventListener("change", handleRadioChange);
                        violentInHomeNoRadio.addEventListener("change", handleRadioChange);

                        childViolenceYesRadio.addEventListener("change", handleRadioChange);
                        childViolenceNoRadio.addEventListener("change", handleRadioChange);

                        spouseViolenceYesRadio.addEventListener("change", handleRadioChange);
                        spouseViolenceNoRadio.addEventListener("change", handleRadioChange);

                        witnessedDomesticViolenceYesRadio.addEventListener("change", handleRadioChange);
                        witnessedDomesticViolenceNoRadio.addEventListener("change", handleRadioChange);

                        weaponsYesRadio.addEventListener("change", handleRadioChange);
                        weaponsNoRadio.addEventListener("change", handleRadioChange);

                        // Call the function initially to set the initial visibility state
                        handleRadioChange();
                    </script>

                    {{-- Domestic Violence ends here --}}

                    {{-- Special Education Starts Here --}}
                    <div class="tab-content" data-tab="8">
                        <form action="{{ route('school_work_data.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- School Data Section -->
                            <div class="row profile-field mt-5">
                                <div class="col-lg-12">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                        class="form-control">

                                    <div class="row">
                                        <div class="col-lg-4 mb-8">
                                            <label for="special_education" class="mt-9">Special Education
                                                (IEP):</label>
                                            <div class="radio-options">
                                                <input type="radio" id="special_education_yes"
                                                    name="special_education" value="1">
                                                <label for="special_education_yes">YES</label>
                                                <input class="" type="radio" id="special_education_no"
                                                    name="special_education" value="0">
                                                <label for="special_education_no">NO</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="504">504:</label>
                                            <div class="radio-options">
                                                <input type="radio" id="504_yes" name="504" value="1">
                                                <label for="504_yes">YES</label>
                                                <input type="radio" id="504_no" name="504" value="0">
                                                <label for="504_no">NO</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="current_school">Current School/University:</label>
                                            <input type="text" name="current_school" id="current_school">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="academic_level">Grade/Academic Level:</label>
                                            <input type="text" name="academic_level" id="academic_level">
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                                        <div class="col-lg-4">
                                            <label for="degree_earned">Degree Earned:</label>
                                            <div class="radio-options">
                                                <input type="radio" id="degree_earned_yes" name="degree_earned"
                                                    value="1">
                                                <label for="degree_earned_yes">YES</label>
                                                <input type="radio" id="degree_earned_no" name="degree_earned"
                                                    value="0">
                                                <label for="degree_earned_no">NO</label>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                // Initially, hide the "Degree Earned" section
                                                $('#degree-earned-section').hide();

                                                // Listen for changes in the "Degree Earned" radio buttons
                                                $('input[name="degree_earned"]').change(function() {
                                                    if ($(this).val() === "1") {
                                                        // If "YES" is selected, show the section
                                                        $('#degree-earned-section').show();
                                                    } else {
                                                        // If "NO" is selected, hide the section
                                                        $('#degree-earned-section').hide();
                                                    }
                                                });
                                            });
                                        </script>


                                        <div class="col-lg-4 " id="degree-earned-section">
                                            <label for="degree">Degree:</label>
                                            <input type="text" name="degree" id="degree">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="current_gpa">Current GPA:</label>
                                            <input type="text" name="current_gpa" id="current_gpa">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for = "advisor">Educational Advisor/School Counselor:</label>
                                            <input type="text" name="advisor" id="advisor">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="primary_teacher">Primary Teacher:</label>
                                            <input type="text" name="primary_teacher" id="primary_teacher">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="school_principle">School Principal:</label>
                                            <input type="text" name="school_principle" id="school_principle">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="school_telephone">School Telephone:</label>
                                            <input type="text" name="school_telephone" id="school_telephone">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="school_fax">School Fax:</label>
                                            <input type="text" name="school_fax" id="school_fax">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="school_email">School Email:</label>
                                            <input type="email" name="school_email" id="school_email">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="place_of_work">Place of Work:</label>
                                            <input type="text" name="place_of_work" id="place_of_work">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="position_held">Position Held:</label>
                                            <input type="text" name="position_held" id="position_held">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="contact_supervisor">Contact person/Supervisor:</label>
                                            <input type="text" name="contact_supervisor" id="contact_supervisor">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="tel">Tel:</label>
                                            <input type="text" name="tel" id="tel">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button id="btn" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- Special Education Ends -->







                    {{-- Symtoms Start Here --}}
                    <div class="tab-content" data-tab="9">
                        <h2 class="text-white mt-5">Symptoms</h2>
                        <form action="{{ route('symtoms.store') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_name">Symptoms Name</label>
                                        <input type="text" name="symtoms_name" placeholder="Symtoms Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_type">Symptoms Type</label>
                                        <input type="text" name="symtoms_type" placeholder="Symptoms Type">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        {{-- Symtoms Ends Here --}}

                        <h2 class="text-white mt-5">Symptoms</h2>
                        <form action="{{ route('user_co_related_symtoms.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="row profile-field">
                                <div class="col-lg-4">

                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">

                                    <label>Please Select a Symptoms</label>
                                    <select name="symtoms_id" class="form-control">
                                        <option value="">Please Select a Symptoms</option>
                                        @foreach ($symtoms as $symtom)
                                            <option value="{{ $symtom->id }}">{{ $symtom->symtoms_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        {{-- Symtoms Ends Here --}}

                        {{-- Co Related Symptoms Starts Here --}}
                        <h2 class="text-white mt-5">Co Related Symptoms</h2>
                        <form action="{{ route('co_related_symtoms.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_name">Symptoms Name</label>
                                        <input type="text" name="symtoms_name" placeholder="Symtoms Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_type">Symptoms Type</label>
                                        <input type="text" name="symtoms_type" placeholder="Symptoms Type">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        {{-- Co Related Symptoms Ends Here --}}

                        {{-- User Co Related Symptoms Starts Here --}}
                        <h2 class="text-white mt-5">Co-Related Symptoms</h2>
                        <form action="{{ route('user_co_related_symtoms.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row profile-field">
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                    class="form-control">
                                <div class="col-lg-4">
                                    <label for="symptoms_type">Please Select a Symptoms</label>
                                    <select name="symtoms_id" class="form-control">
                                        <option value="">Please Select a Symptoms</option>
                                        @foreach ($co_realated_symptoms as $co_realated_symptom)
                                            <option value="{{ $co_realated_symptom->id }}">
                                                {{ $co_realated_symptom->symtoms_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="is_client">Is Client</label>
                                        <input type="text" name="is_client" placeholder="Is Client">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="is_mother">Is Mother</label>
                                        <input type="text" name="is_mother" placeholder="Is Mother">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div alass="form-group">
                                        <label for="is_father">Is Father</label>
                                        <input type="text" name ="is_father" placeholder="Is Father">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <input type="text" name="comments" placeholder="Comments">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button id="btn" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    {{-- Symtoms Ends Here --}}






                </div>
                <div class="buttons"><br> <br>
                    <button class="btn btn-primary" type="button" onclick="prevTab()">Previous</button>
                    <button class="btn btn-primary" type="button" onclick="nextTab()">Next</button>
                </div>


            </div>

        </div>
    </div>
@endsection


<script>
    let currentTab = 1;

    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach((content) => {
            content.style.display = 'none';
        });

        document.querySelector(`.tab-content[data-tab="${tab}"]`).style.display = 'block';
        currentTab = tab;
        updateButtonVisibility();
    }

    function nextTab() {
        if (currentTab < 10) {
            showTab(currentTab + 1);
        }
    }

    function prevTab() {
        if (currentTab > 1) {
            showTab(currentTab - 1);
        }
    }

    function updateButtonVisibility() {
        const prevButton = document.querySelector('button[onclick="prevTab()"]');
        const nextButton = document.querySelector('button[onclick="nextTab()"]');

        prevButton.style.display = currentTab === 1 ? 'none' : 'inline-block';
        nextButton.style.display = currentTab === 10 ? 'none' : 'inline-block';
    }

    document.getElementById('multiStepForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle form submission here
        alert('Form submitted!');
    });
</script>
