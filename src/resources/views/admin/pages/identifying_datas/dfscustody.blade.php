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

                {{-- DFS custody Starts --}}
                <div class="tab-content" data-tab="4">
                    <i class="btn btn-primary text-black text-center">
                        Did you know humans are the only animals that blush?
                    </i>
                    <h2 class="text-white mt-5">DFS custody</h2>
                    <form
                        @if ($DFS_custody->DFS_custody != null) action="{{ route('DFS_custody.update', ['DFS_custody' => $DFS_custody->DFS_custody->id]) }}"
                            method="post"
                        @else
                            action="{{ route('DFS_custody.store') }}"
                            method="post" @endif
                        enctype="multipart/form-data">
                        @csrf
                        @if ($DFS_custody->DFS_custody != null)
                            @method('put')
                        @endif

                        <!-- DFS custody table -->

                        <div class="row profile-field">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                        class="form-control">
                                </div>

                                <label>DFS Custody of your Children</label>
                                <div class="radio-options">
                                    <input type="radio" name="dfs_custody_of_your_children" value="1"
                                        {{ isset($DFS_custody->DFS_custody->dfs_custody_of_your_children) && $DFS_custody->DFS_custody->dfs_custody_of_your_children == 1 ? 'checked' : '' }}>
                                    <label class="labels">Yes</label>
                                    <input type="radio" name="dfs_custody_of_your_children" value="2"
                                        {{ isset($DFS_custody->DFS_custody->dfs_custody_of_your_children) && $DFS_custody->DFS_custody->dfs_custody_of_your_children == 2 ? 'checked' : '' }}>
                                    <label class="labels">No</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-none row" id="showAdditionalProperty1">

                                            <div class="col-lg-12 additional-fields">
                                                <div class="form-group ">
                                                    <label for="dfs_caseworker">DFS caseworker</label>
                                                    <input type="text" name="dfs_caseworker" class="form-control"
                                                        value="{{ old('dfs_caseworker', isset($DFS_custody->DFS_custody->dfs_caseworker) ? $DFS_custody->DFS_custody->dfs_caseworker : '') }}"
                                                        required disabled>
                                                    @error('dfs_caseworker')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 additional-fields">
                                                <div class="form-group">
                                                    <label for="dfs_tel">Tel</label>
                                                    <input type="text" name="dfs_tel" class="form-control"
                                                        value="{{ old('dfs_tel', isset($DFS_custody->DFS_custody->dfs_tel) ? $DFS_custody->DFS_custody->dfs_tel : '') }}"
                                                        required disabled>
                                                    @error('dfs_tel')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 additional-fields">
                                                <div class="form-group">
                                                    <label>DFS Caseworker email</label>
                                                    <input type="email" name="dfs_email" class="form-control"
                                                        value="{{ old('dfs_email', isset($DFS_custody->DFS_custody->dfs_email) ? $DFS_custody->DFS_custody->dfs_email : '') }}"
                                                        required disabled>
                                                    @error('dfs_email')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group additional-fields">
                                                    <label>DFS Caseworker Office Location</label>
                                                    <input type="text" name="dfs_location" class="form-control"
                                                        value="{{ old('dfs_location', isset($DFS_custody->DFS_custody->dfs_location) ? $DFS_custody->DFS_custody->dfs_location : '') }}"
                                                        required disabled>
                                                    @error('dfs_location')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <label for="Is client covered under Mother’s Health Insurance policy?">Juvenile Justice
                                    Custody of your Child</label>
                                <div class="radio-options">
                                    <input type="radio" id="juvenile_Justice_Custody_of_your_child"
                                        name="juvenile_Justice_Custody_of_your_child" value="1"
                                        {{ isset($DFS_custody->DFS_custody->juvenile_Justice_Custody_of_your_child) && $DFS_custody->DFS_custody->juvenile_Justice_Custody_of_your_child == 1 ? 'checked' : '' }}>
                                    <label for="juvenile_Justice_Custody_of_your_child">Yes</label>
                                    <input type="radio" id="juvenile_Justice_Custody_of_your_child"
                                        name="juvenile_Justice_Custody_of_your_child" value="2"
                                        {{ isset($DFS_custody->DFS_custody->juvenile_Justice_Custody_of_your_child) && $DFS_custody->DFS_custody->juvenile_Justice_Custody_of_your_child == 2 ? 'checked' : '' }}>
                                    <label for="juvenile_Justice_Custody_of_your_child">No</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-none row" id="showAdditionalProperty2">
                                            <div class="col-lg-6 additional-fields2">
                                                <div class="form-group">
                                                    <label for="child_probation_officer"> Child probation officer</label>
                                                    <input type="text" name="child_probation_officer"
                                                        class="form-control"
                                                        value="{{ old('child_probation_officer', isset($DFS_custody->DFS_custody->child_probation_officer) ? $DFS_custody->DFS_custody->child_probation_officer : '') }}"
                                                        required disabled>
                                                    @error('child_probation_officer')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 additional-fields2">
                                                <div class="form-group">
                                                    <label for="child_probation_officer_tel">Child probation officer
                                                        tel</label>
                                                    <input type="text" name="child_probation_officer_tel"
                                                        class="form-control"
                                                        value="{{ old('child_probation_officer_tel', isset($DFS_custody->DFS_custody->child_probation_officer_tel) ? $DFS_custody->DFS_custody->child_probation_officer_tel : '') }}"
                                                        required disabled>
                                                    @error('child_probation_officer_tel')
                                                        <span class="text-primary">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-primary" type="submit" onclick="validateForm()">Next</button>
                        </div>
                    </form>
                </div>
                {{-- DFS custody Ends --}}

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        // Initially hide the additional fields
        $(".additional-fields").hide();
        $(".additional-fields input").prop('disabled', true);
        $(".additional-fields2").hide();
        $(".additional-fields2 input").prop('disabled', true);


        if ($("input[name='dfs_custody_of_your_children']:checked").val() == 1) {
            // $(".additional-fields").show();
            // $(".additional-fields input").prop('disabled', false);
            $('#showAdditionalProperty1').removeClass('d-none');
            $(".additional-fields").show();
            $(".additional-fields input").prop('disabled', false);

        }
        if ($("input[name='juvenile_Justice_Custody_of_your_child']:checked").val() == 1) {
            // $(".additional-fields").show();
            // $(".additional-fields input").prop('disabled', false);
            $('#showAdditionalProperty2').removeClass('d-none');
            $(".additional-fields2").show();
            $(".additional-fields2 input").prop('disabled', false);

        }
        // Attach an event listener to the radio groups
        $("input[name='dfs_custody_of_your_children']").change(function() {
            // Check if "Yes" is selected in the "DFS Custody of your Children" radio group
            if ($(this).val() == 1) {
                // If "Yes" is selected, show the additional fields for this group
                $(".additional-fields").show();
                $(".additional-fields input").prop('disabled', false);

            } else {
                // If "No" is selected, hide the additional fields for this group
                $(".additional-fields").hide();
                $(".additional-fields input").val("");
                $(".additional-fields input").prop('disabled', true);

            }
        });

        $("input[name='juvenile_Justice_Custody_of_your_child']").change(function() {
            // Check if "Yes" is selected in the "Juvenile Justice Custody of your Child" radio group
            if ($(this).val() == 1) {
                // If "Yes" is selected, show the additional fields for this group
                $(".additional-fields2").show();
                $(".additional-fields2 input").prop('disabled', false);

            } else {
                // If "No" is selected, hide the additional fields for this group
                $(".additional-fields2").hide();
                $(".additional-fields2 input").val("");
                $(".additional-fields2 input").prop('disabled', true);

            }
        });

        $('input[name="dfs_custody_of_your_children"]').change(function() {
            if ($(this).val() === '1') {
                $('#showAdditionalProperty1').removeClass('d-none');
            } else {
                $('#showAdditionalProperty1').addClass('d-none');
            }
        });
        $('input[name="juvenile_Justice_Custody_of_your_child"]').change(function() {
            if ($(this).val() === '1') {
                $('#showAdditionalProperty2').removeClass('d-none');
            } else {
                $('#showAdditionalProperty2').addClass('d-none');
            }
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
