@extends('admin.layout.template')
{{-- {{ dd($domestic_violence_screening->domestic_violence_screening) }} --}}
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


                {{--  Domestic Violence Start --}}
                <div class="tab-content profile-field" data-tab="7">
                    <i class="btn btn-primary text-black text-center">
                        I can see the finish line!
                    </i>

                    <h2 class="text-white mt-5">Domestic Violence Screenings</h2>
                    <form
                        @if ($domestic_violence_screening->domestic_violence_screening != null) action="{{ route('domestic_violence.update', ['domestic_violence' => $domestic_violence_screening->domestic_violence_screening->id]) }}"
                method="post"
             @else
                action="{{ route('domestic_violence.store') }}"
                method="post" @endif
                        enctype="multipart/form-data">
                        @csrf
                        @if ($domestic_violence_screening->domestic_violence_screening != null)
                            @method('put')
                        @endif

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
                                <input type="radio" id="violent_in_the_home_yes" name="violent_in_the_home" value="1"
                                    {{-- {{ isset($domestic_violence_screening->domestic_violence_screening->violent_in_the_home) && $domestic_violence_screening->domestic_violence_screening->violent_in_the_home == 1 ? 'checked' : '' }} --}} @if (old('violent_in_the_home') ||
                                            (isset($domestic_violence_screening->domestic_violence_screening->violent_in_the_home) &&
                                                $domestic_violence_screening->domestic_violence_screening->violent_in_the_home == 1)) checked @endif
                                    for="violent_in_the_home_yes">Yes</label>
                                <input type="radio"id="violent_in_the_home_no" name="violent_in_the_home" value="2"
                                    {{-- {{ $domestic_violence->violent_in_the_home == 2 ? 'checked' : '' }}> --}} @if (old('violent_in_the_home') ||
                                            (isset($domestic_violence_screening->domestic_violence_screening->violent_in_the_home) &&
                                                $domestic_violence_screening->domestic_violence_screening->violent_in_the_home == 2)) checked @endif>
                                <label for="immigrant">No</label>
                            </div>
                        </div>

                        <!-- violent_in_the_home_describe -->
                        <div class="form-group col-lg-6 " id="violent_in_the_home_describe" style="display: none">
                            <label for="violent_in_the_home_describe">Describe the violence in the
                                home:</label>
                            <textarea name="violent_in_the_home_describe" class="form-control" required>{{ old('violent_in_the_home_describe', isset($domestic_violence_screening->domestic_violence_screening->violent_in_the_home_describe) ? $domestic_violence_screening->domestic_violence_screening->violent_in_the_home_describe : '') }}</textarea>

                        </div>

                        <!-- child_has_been_violent_in_the_home -->
                        <div class="form-group col-lg-6">
                            <label for="child_has_been_violent_in_the_home">Has the child been violent in the
                                home?</label>
                            <div class="radio-options">
                                <input type="radio" id="child_has_been_violent_in_the_home_yes"
                                    name="child_has_been_violent_in_the_home" value="1"
                                    @if (old(
                                            'child_has_been_violent_in_the_home',
                                            isset($domestic_violence->child_has_been_violent_in_the_home)
                                                ? $domestic_violence->child_has_been_violent_in_the_home
                                                : '') == '1') checked @endif>
                                {{-- {{ $domestic_violence->child_has_been_violent_in_the_home == 1 ? 'checked' : '' }}> --}}
                                <label for="child_has_been_violent_in_the_home_yes">Yes</label>
                                <input type="radio" id="child_has_been_violent_in_the_home_no"
                                    name="child_has_been_violent_in_the_home" value="2"
                                    @if (old(
                                            'child_has_been_violent_in_the_home',
                                            isset($domestic_violence->domestic_violence->child_has_been_violent_in_the_home)
                                                ? $domestic_violence->child_has_been_violent_in_the_home
                                                : '') == '2') checked @endif>
                                {{-- {{ $domestic_violence->child_has_been_violent_in_the_home == 2 ? 'checked' : '' }}> --}}
                                <label for="child_has_been_violent_in_the_home_no">No</label>
                            </div>
                        </div>

                        <!-- child_has_been_violent_in_the_home_describe -->
                        <div class="child_has_been_violent_in_the_home_describe "
                            id="child_has_been_violent_in_the_home_describe" style="display: none">
                            <label for="child_has_been_violent_in_the_home_describe">Describe the child's violence in
                                the home:</label>
                            <textarea id="immigrant" name="child_has_been_violent_in_the_home_describe" class="form-control">{{ old('witnessed_domestic_violence_describe', isset($domestic_violence_screening->domestic_violence_screening->child_has_been_violent_in_the_home_describe) ? $domestic_violence_screening->domestic_violence_screening->child_has_been_violent_in_the_home_describe : '') }}                                                        
</textarea>
                        </div>

                        <!-- my_spouse_has_been_violent_in_the_home -->
                        <div class="form-group col-lg-6">
                            <label for="my_spouse_has_been_violent_in_the_home">Has your spouse been violent in the
                                home?</label>
                            <div class="radio-options">
                                <input type="radio" id="my_spouse_has_been_violent_in_the_home_yes"
                                    name="my_spouse_has_been_violent_in_the_home" value="1"
                                    @if (old(
                                            'my_spouse_has_been_violent_in_the_home',
                                            isset($domestic_violence->my_spouse_has_been_violent_in_the_home)
                                                ? $domestic_violence->my_spouse_has_been_violent_in_the_home
                                                : '') == '1') checked @endif>
                                {{-- {{ $domestic_violence->my_spouse_has_been_violent_in_the_home == 1 ? 'checked' : '' }}> --}}
                                <label for="my_spouse_has_been_violent_in_the_home_yes">Yes</label>
                                <input type="radio" id="my_spouse_has_been_violent_in_the_home_no"
                                    name="my_spouse_has_been_violent_in_the_home" value="2"
                                    @if (old(
                                            'my_spouse_has_been_violent_in_the_home',
                                            isset($domestic_violence->my_spouse_has_been_violent_in_the_home)
                                                ? $domestic_violence->my_spouse_has_been_violent_in_the_home
                                                : '') == '2') checked @endif>
                                {{-- {{ $domestic_violence->my_spouse_has_been_violent_in_the_home == 2 ? 'checked' : '' }}> --}}
                                <label for="my_spouse_has_been_violent_in_the_home_no">No</label>
                            </div>
                        </div>

                        <!-- my_spouse_has_been_violent_in_the_home_describe -->
                        <div class="my_spouse_has_been_violent_in_the_home_describe"
                            id="my_spouse_has_been_violent_in_the_home_describe" style="display: none">
                            <label for="my_spouse_has_been_violent_in_the_home_describe">Describe your spouse's
                                violence in the home:</label>
                            <textarea name="my_spouse_has_been_violent_in_the_home_describe" class="form-control" required>{{ old('my_spouse_has_been_violent_in_the_home_describe', isset($domestic_violence_screening->domestic_violence_screening->my_spouse_has_been_violent_in_the_home_describe) ? $domestic_violence_screening->domestic_violence_screening->my_spouse_has_been_violent_in_the_home_describe : '') }}     
                            </textarea>
                        </div>

                        <!-- witnessed_domestic_violence -->
                        <div class="form-group col-lg-6">
                            <label for="witnessed_domestic_violence">Have you witnessed domestic violence?</label>
                            <div class="radio-options">
                                <input type="radio" id="witnessed_domestic_violence_yes"
                                    name="witnessed_domestic_violence" value="1"
                                    @if (old(
                                            'witnessed_domestic_violence',
                                            isset($domestic_violence->witnessed_domestic_violence) ? $domestic_violence->witnessed_domestic_violence : '') == '1') checked @endif>
                                {{-- {{ $domestic_violence->witnessed_domestic_violence == 1 ? 'checked' : '' }}> --}}
                                <label for="witnessed_domestic_violence_yes">Yes</label>
                                <input type="radio" id="witnessed_domestic_violence_no" name="witnessed_domestic_violence"
                                    value="2" @if (old(
                                            'witnessed_domestic_violence',
                                            isset($domestic_violence->witnessed_domestic_violence) ? $domestic_violence->witnessed_domestic_violence : '') == '2') checked @endif>
                                {{-- {{ $domestic_violence->witnessed_domestic_violence == 2 ? 'checked' : '' }}> --}}
                                <label for="witnessed_domestic_violence_no">No</label>
                            </div>
                        </div>

                        <!-- witnessed_domestic_violence_describe -->
                        <div class="witnessed_domestic_violence_describe" id="witnessed_domestic_violence_describe"
                            style="display: none">
                            <label for="witnessed_domestic_violence_describe">Describe the domestic violence you
                                witnessed:</label>
                            <textarea name="witnessed_domestic_violence_describe" class="form-control" required>{{ old('witnessed_domestic_violence_describe', isset($domestic_violence_screening->domestic_violence_screening->witnessed_domestic_violence_describe) ? $domestic_violence_screening->domestic_violence_screening->witnessed_domestic_violence_describe : '') }}</textarea>
                        </div>
                        <!-- weapons -->
                        <div class="form-group col-lg-6">
                            <label for="weapons">Are there weapons in the home?</label>
                            <div class="radio-options">
                                <input type="radio" id="weapons_yes" name="weapons" value="1"
                                    @if (old('weapons', isset($domestic_violence->weapons) ? $domestic_violence->weapons : '') == '1') checked @endif>
                                {{-- {{ $domestic_violence->weapons == 1 ? 'checked' : '' }}> --}}
                                <label for="weapons_yes">Yes</label>
                                <input type="radio" id="weapons_no" name="weapons" value="2"
                                    @if (old('weapons', isset($domestic_violence->weapons) ? $domestic_violence->weapons : '') == '2') checked @endif>
                                {{-- {{ $domestic_violence->weapons == 2 ? 'checked' : '' }}> --}}
                                <label for="weapons_no">No</label>
                            </div>
                        </div>

                        <!-- weapons_describe -->
                        <div class="weapons_describe " id="weapons_describe" style="display: none">
                            <label for="weapons_describe">Describe the weapons in the home:</label>
                            <textarea name="weapons_describe" class="form-control" required>{{ old('weapons_describe', isset($domestic_violence_screening->domestic_violence_screening->weapons_describe) ? $domestic_violence_screening->domestic_violence_screening->weapons_describe : '') }}
                            </textarea>
                        </div>

                        <!-- initials -->
                        <div class="form-group col-lg-6">
                            <label for="initials">Initials</label>
                            <input type="text" name="initials" class="form-control" required
                                value="{{ old('initials', isset($domestic_violence_screening->domestic_violence_screening->initials) ? $domestic_violence_screening->domestic_violence_screening->initials : '') }}">
                        </div>


                        <div class="form-group col-lg-12 mt-4">
                            <button id="btn" class="btn btn-primary" type="submit"
                                onclick="formValidate()">Next</button>
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
                            // Using plain JavaScript
                            violentInHomeDescribeField.querySelector('textarea').disabled = false;

                        } else {
                            violentInHomeDescribeField.style.display = "none";
                            violentInHomeDescribeField.querySelector('textarea').disabled = true;
                        }

                        if (childViolenceYesRadio.checked) {
                            childViolenceDescribeField.style.display = "block";
                            childViolenceDescribeField.querySelector('textarea').disabled = false;
                        } else {
                            childViolenceDescribeField.style.display = "none";
                            childViolenceDescribeField.querySelector('textarea').disabled = true;

                        }

                        if (spouseViolenceYesRadio.checked) {
                            spouseViolenceDescribeField.style.display = "block";
                            spouseViolenceDescribeField.querySelector('textarea').disabled = false;
                        } else {
                            spouseViolenceDescribeField.style.display = "none";
                            spouseViolenceDescribeField.querySelector('textarea').disabled = true;
                        }

                        if (witnessedDomesticViolenceYesRadio.checked) {
                            witnessedDomesticViolenceDescribeField.style.display = "block";
                            witnessedDomesticViolenceDescribeField.querySelector('textarea').disabled = false;
                        } else {
                            witnessedDomesticViolenceDescribeField.style.display = "none";
                            witnessedDomesticViolenceDescribeField.querySelector('textarea').disabled = true;
                        }

                        if (weaponsYesRadio.checked) {
                            weaponsDescribeField.style.display = "block";
                            weaponsDescribeField.querySelector('textarea').disabled = false;

                        } else {
                            weaponsDescribeField.style.display = "none";
                            weaponsDescribeField.querySelector('textarea').disabled = true;
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

                {{-- Domestic ends here --}}



            </div>
        </div>
    </div>
@endsection
