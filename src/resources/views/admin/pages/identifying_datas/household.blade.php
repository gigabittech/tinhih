@extends('admin.layout.template')
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



                <!-- Household and Emergency Starts -->
                <div class="tab-content" data-tab="3">
                    <form
                        @if (
                            $household_emergency_contact_two->household_emergency_contact_two != null ||
                                $household_emergency_contact->household_emergency_contact != null) action="{{ route('household_emergency_contact.update', ['household_emergency_contact' => $parents_information->$household_emergency_contact_two->household_emergency_contact_two->id ?? $household_emergency_contact->household_emergency_contact->id]) }}"
                    @else
                        action="{{ route('household_emergency_contact.store') }}" @endif
                        method="post" enctype="multipart/form-data">
                        @csrf

                        @if (
                            $household_emergency_contact_two->household_emergency_contact_two ||
                                $household_emergency_contact->household_emergency_contact)
                            @method('put')
                        @endif
                        @csrf
                        <i class="btn btn-primary text-black text-center">
                            Phew! You’re moving along so quickly!
                        </i>
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
                                    <input type="text" name="contact_name" class="form-control"
                                        value="{{ old('contact_name', isset($household_emergency_contact_two->household_emergency_contact_two->contact_name) ? $household_emergency_contact_two->household_emergency_contact_two->contact_name : '') }}"
                                        required>
                                    @error('contact_name')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="contact_relationship">Relationship</label>
                                    <input type="text" name="contact_relationship" class="form-control"
                                        value="{{ old('contact_relationship', isset($household_emergency_contact_two->household_emergency_contact_two->contact_relationship) ? $household_emergency_contact_two->household_emergency_contact_two->contact_relationship : '') }}"
                                        required>
                                    >
                                    @error('contact_relationship')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="contact_tel">Tel</label>
                                    <input type="text" name="contact_tel" class="form-control"
                                        value="{{ old('contact_tel', isset($household_emergency_contact_two->household_emergency_contact_two->contact_tel) ? $household_emergency_contact_two->household_emergency_contact_two->contact_tel : '') }}">
                                    >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="contact_cell">Cell</label>
                                    <input type="text" name="contact_cell" class="form-control"
                                        value="{{ old('contact_cell', isset($household_emergency_contact_two->household_emergency_contact_two->contact_cell) ? $household_emergency_contact_two->household_emergency_contact_two->contact_cell : '') }}"
                                        required>
                                    >
                                    @error('contact_cell')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
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
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', isset($household_emergency_contact->household_emergency_contact->name) ? $household_emergency_contact->household_emergency_contact->name : '') }}"
                                        required>
                                    @error('name')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" class="form-control"
                                        value="{{ old('age', isset($household_emergency_contact->household_emergency_contact->age) ? $household_emergency_contact->household_emergency_contact->age : '') }}"
                                        required>
                                    @error('age')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" name="relationship" class="form-control"
                                        value="{{ old('relationship', isset($household_emergency_contact->household_emergency_contact->relationship) ? $household_emergency_contact->household_emergency_contact->relationship : '') }}"
                                        required>
                                    @error('relationship')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-primary" type="submit" onclick="validateForm()">Next</button>
                        </div>
                    </form>
                </div>
                {{-- Household and Emergency ends here --}}
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
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
