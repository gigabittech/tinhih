@extends('admin.layout.template')
{{-- {{ dd($school_work->degree_earned1) }} --}}
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black vh-100">
        <!-- Display validation errors -->



        <div class="row">

            <div class="col-lg-12 bg-dark1 p-5">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif

                {{-- Special Education Starts Here --}}
                <div class="tab-content" data-tab="8">
                    <form
                        @if ($school_work_data->school_work_data != null) action="{{ route('school_work_data.update', ['school_work_datum' => $school_work_data->school_work_data->id]) }}"
                method="post"
             @else
                action="{{ route('school_work_data.store') }}"
                method="post" @endif
                        enctype="multipart/form-data">
                        @csrf
                        @if ($school_work_data->school_work_data != null)
                            @method('put')
                        @endif

                        <i class="btn btn-primary text-black text-center">
                            Did you know the real name for a hashtag is an octothorpe?
                        </i>
                        <!-- School Data Section -->
                        <div class="row profile-field mt-5 border-0">
                            <div class="col-lg-12">
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}" class="form-control">

                                <table class=" table border-top-0">
                                    <tr>
                                        <td class="col-lg-3 border-top-0 ">
                                            <label for="special_education" class="mt-9">Special Education (IEP):</label>
                                            <div class="radio-options">
                                                <input type="radio" id="special_education_yes" name="special_education"
                                                    value="1"
                                                    {{ old('special_education', $school_work_data->special_education) == 1 ? 'checked' : '' }}>

                                                <label for="special_education_yes">YES</label>
                                                <input class="" type="radio" id="special_education_no"
                                                    name="special_education" value="0"
                                                    {{ old('special_education', $school_work_data->special_education) == 0 ? 'checked' : '' }}>
                                                <label for="special_education_no">NO</label>
                                            </div>
                                        </td>
                                        <td class="col-lg-3 border-top-0">
                                            <label for="504">504:</label>
                                            <div class="radio-options">
                                                <input type="radio" id="504_yes" name="_504" value="1"
                                                    @if (old('504', isset($school_work->_504) ? $school_work->_504 : '') == '1') checked @endif>

                                                {{-- {{ $school_work->{'504'} == 1 ? 'checked' : '' }}> --}}
                                                <label for="504_yes">YES</label>
                                                <input type="radio" id="504_no" name="_504" value="0"
                                                    @if (old('_504', isset($school_work->_504) ? $school_work->_504 : '') == '0') checked @endif>

                                                {{-- {{ $school_work->{'504'} == 0 ? 'checked' : '' }}> --}}
                                                <label for="504_no">NO</label>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="col-lg-3 border-top-0">
                                            <label for="degree_earned">Degree Earned:</label>
                                            <div class="radio-options">
                                                <input type="radio" id="degree_earned_yes" name="degree_earned"
                                                    {{ isset($school_work->degree_earned) && $school_work->degree_earned == 1 ? 'checked' : '' }}
                                                    value="1" value="1">
                                                <label for="degree_earned_yes">YES</label>
                                                <input type="radio" id="degree_earned_no" name="degree_earned"
                                                    value="0"
                                                    {{ isset($school_work->degree_earned) && $school_work->degree_earned == 0 ? 'checked' : '' }}>
                                                <label for="degree_earned_no">NO</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="additional-info d-none">
                                        {{-- degree --}}
                                        <td class="border-top-0">
                                            <label for="degree">Degree:</label>
                                            <input type="text" name="degree" id="degree" class="form-control"
                                                value="{{ old('degree', isset($school_work_data->school_work_data->degree) ? $school_work_data->school_work_data->degree : '') }}"
                                                required>
                                            @error('degree')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        {{-- school --}}
                                        <td class="col-lg-3 border-top-0">
                                            <label for="current_school">Current School/University:</label>
                                            <input type="text" name="current_school" id="current_school"
                                                class="form-control"
                                                value="{{ old('current_school', isset($school_work_data->school_work_data->current_school) ? $school_work_data->school_work_data->current_school : '') }}"
                                                required>
                                            @error('current_school')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        {{-- Grade --}}
                                        <td class="col-lg-3 border-top-0">
                                            <label for="academic_level">Grade/Academic Level:</label>
                                            <input type="text" name="academic_level" id="academic_level"
                                                class="form-control"
                                                value="{{ old('academic_level', isset($school_work_data->school_work_data->academic_level) ? $school_work_data->school_work_data->academic_level : '') }}"
                                                required>
                                            @error('academic_level')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <!-- Add more cells as needed for this row -->
                                    </tr>
                                    <tr class="additional-info d-none">
                                        <td class="col-lg-3 border-top-0">
                                            <label for="current_gpa">Current GPA:</label>
                                            <input type="text" name="current_gpa" id="current_gpa" class="form-control"
                                                value="{{ old('current_gpa', isset($school_work_data->school_work_data->current_gpa) ? $school_work_data->school_work_data->current_gpa : '') }}"
                                                required>
                                            @error('current_gpa')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="advisor">Educational Advisor/School Counselor:</label>
                                            <input type="text" name="advisor" id="advisor" class="form-control"
                                                value="{{ old('advisor', isset($school_work_data->school_work_data->advisor) ? $school_work_data->school_work_data->advisor : '') }}"
                                                required>
                                            @error('advisor')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="primary_teacher">Primary Teacher:</label>
                                            <input type="text" name="primary_teacher" id="primary_teacher"
                                                class="form-control"
                                                value="{{ old('primary_teacher', isset($school_work_data->school_work_data->primary_teacher) ? $school_work_data->school_work_data->primary_teacher : '') }}"
                                                required>
                                            @error('primary_teacher')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="additional-info d-none">
                                        <td class="col-lg-3 border-top-0">
                                            <label for="school_principle">School Principal:</label>
                                            <input type="text" name="school_principle" id="school_principle"
                                                class="form-control"
                                                value="{{ old('school_principle', isset($school_work_data->school_work_data->school_principle) ? $school_work_data->school_work_data->school_principle : '') }}"
                                                required>
                                            @error('school_principle')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="school_telephone">School Telephone:</label>
                                            <input type="text" name="school_telephone" id="school_telephone"
                                                class="form-control"
                                                value="{{ old('school_telephone', isset($school_work_data->school_work_data->school_telephone) ? $school_work_data->school_work_data->school_telephone : '') }}"
                                                required>
                                            @error('school_telephone')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="school_fax">School Fax:</label>
                                            <input type="text" name="school_fax" id="school_fax" class="form-control"
                                                value="{{ old('school_fax', isset($school_work_data->school_work_data->school_fax) ? $school_work_data->school_work_data->school_fax : '') }}"
                                                required>
                                            @error('school_fax')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="additional-info d-none">
                                        <td class="col-lg-3 border-top-0">
                                            <label for="school_email">School Email:</label>
                                            <input type="email" name="school_email" id="school_email"
                                                class="form-control"
                                                value="{{ old('school_email', isset($school_work_data->school_work_data->school_email) ? $school_work_data->school_work_data->school_email : '') }}"
                                                required>
                                            @error('school_email')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="place_of_work">Place of Work:</label>
                                            <input type="text" name="place_of_work" id="place_of_work"
                                                class="form-control"
                                                value="{{ old('place_of_work', isset($school_work_data->school_work_data->place_of_work) ? $school_work_data->school_work_data->place_of_work : '') }}"
                                                required>
                                            @error('place_of_work')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="position_held">Position Held:</label>
                                            <input type="text" name="position_held" id="position_held"
                                                class="form-control"
                                                value="{{ old('position_held', isset($school_work_data->school_work_data->position_held) ? $school_work_data->school_work_data->position_held : '') }}"
                                                required>
                                            @error('position_held')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="additional-info d-none">
                                        <td class="col-lg-3 border-top-0">
                                            <label for="contact_supervisor">Contact person/Supervisor:</label>
                                            <input type="text" name="contact_supervisor" id="contact_supervisor"
                                                class="form-control"
                                                value="{{ old('contact_supervisor', isset($school_work_data->school_work_data->contact_supervisor) ? $school_work_data->school_work_data->contact_supervisor : '') }}"
                                                required>
                                            @error('contact_supervisor')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-lg-3 border-top-0">
                                            <label for="tel">Tel:</label>
                                            <input type="text" name="tel" id="tel" class="form-control"
                                                value="{{ old('tel', isset($school_work_data->school_work_data->tel) ? $school_work_data->school_work_data->tel : '') }}"
                                                required>
                                            @error('tel')
                                                <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>

                                <div class="form-group mt-4">
                                    <button id="btn" class="btn btn-primary" type="submit"
                                        onclick="validateForm()">Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Special Education Ends -->
            </div>
        </div>
    </div>
@endsection


@section('extra-script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("tr.additional-info").hide();
            $("tr.additional-info").prop('disabled', true);

            if ($("input[name='degree_earned']:checked").val() == 1) {
                $("tr.additional-info").show();
                $("tr.additional-info input").prop('disabled', false);
                $("tr.additional-info").removeClass('d-none');
            } else {
                $("tr.additional-info").hide();
                $("tr.additional-info input").prop('disabled', true);
                $("tr.additional-info").addClass('d-none');
            }

            $("input[name='degree_earned']").change(function() {
                if ($(this).val() == '1') {
                    $("tr.additional-info").show();
                    $("tr.additional-info").removeClass('d-none');
                    $("tr.additional-info input").prop('disabled', false);
                } else {
                    $("tr.additional-info").hide();
                    $("tr.additional-info input").prop('disabled', true);
                }
            });

        });

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
