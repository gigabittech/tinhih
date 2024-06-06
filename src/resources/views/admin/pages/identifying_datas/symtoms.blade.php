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

                {{-- Symtoms Start Here --}}
                <div class="tab-content" data-tab="9">
                    <i class="btn btn-primary text-black text-center mb-3">
                        We told you there would take some time.
                    </i>
                    <h2 class="text-white mb-4">Symptoms</h2>
                    <form action="{{ route('symtoms.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row profile-field">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="pb-3">Symptoms Name</label>
                                    <input type="text" class="form-control" name="symtoms_name"
                                        placeholder="Symtoms Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="pb-3">Symptoms Type</label>
                                    <input type="text" class="form-control" name="symtoms_type"
                                        placeholder="Symptoms Type">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                    {{-- Symtoms Ends Here --}}

                    <i class="btn btn-primary text-black text-center mt-5">
                        Did you know people used to say "prunes" instead of "cheese" when getting their pictures
                        taken?
                    </i>

                    <h2 class="text-white mt-5">Symptoms</h2>

                    <div class="row">
                        <!-- First Form -->
                        <div class="col-lg-4 profile-field ">
                            <form action="{{ route('user_symtoms.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                <label>Please Select a Symptoms</label>
                                <select name="symtoms_id" class="form-control">
                                    <option value="">Please Select a Symptoms</option>
                                    @foreach ($symtoms as $symtom)
                                        <option value="{{ $symtom->id }}">
                                            {{ $symtom->symtoms_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>

                        <!-- Second Form -->
                        {{-- <div class="col-lg-4 profile-field">
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                <label>Selected Symptoms</label>
                                <select name="symtoms_id[]" class="form-control" multiple>
                                    @if ($userSymptoms && $userSymptoms->count() > 0)
                                        @foreach ($userSymptoms as $userSymptom)
                                            <option value="{{ $userSymptom->symtoms_id }}"
                                                {{ in_array($userSymptom->symtoms_id, $userSymptoms->pluck('symtoms_id')->toArray()) ? 'selected' : '' }}>
                                                {{ $userSymptom->symtoms_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div> --}}






                        {{-- Symtoms Ends Here --}}

                        {{-- Co Related Symptoms Starts Here --}}
                        <h2 class="text-white mt-5">Co Related Symptoms</h2>
                        <form action="{{ route('co_related_symtoms.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row profile-field">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_name">Symptoms Name</label>
                                        <input class="form-control" type="text" name="symtoms_name"
                                            placeholder="Symtoms Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="symptoms_type">Symptoms Type</label>
                                        <input class="form-control" type="text" name="symtoms_type"
                                            placeholder="Symptoms Type">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        {{-- Co Related Symptoms Ends Here --}}


                        <i class="btn btn-primary text-black text-center mt-5">
                            Congratulations! This is one of the bravest things anyone can do for themselves. We are
                            proud of you! Someone will be in touch with you soon to talk about the next steps.
                        </i>
                        {{-- User Co Related Symptoms Starts Here --}}
                        <h2 class="text-white mt-5">Co-Related Symptoms</h2>
                        <form
                            action="{{ $clientSymtom == null ? route('user_co_related_symtoms.store') : route('user_co_related_symtoms.update', $clientSymtom->id) }}"
                            method="post" enctype="multipart/form-data">

                            @if ($clientSymtom != null)
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="row profile-field">
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}" class="form-control">
                                <div class="col-lg-4">
                                    <label for="symptoms_type">Please Select a Symptoms</label>
                                    <select name="symtoms_id" class="form-control">
                                        <option value="" disabled>Please Select a Symptoms</option>
                                        @foreach ($co_realated_symptoms as $co_realated_symptom)
                                            <option value="{{ $co_realated_symptom->id }}"
                                                {{ $co_realated_symptom->id == $clientSymtom->symtoms_id ? 'selected' : '' }}>
                                                {{ $co_realated_symptom->symtoms_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="is_client">Is Client</label>
                                        <input class="form-control" type="text" name="is_client" placeholder="Is Client"
                                            value="{{ isset($clientSymtom->is_client) && $clientSymtom->is_client ? $clientSymtom->is_client : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="is_mother">Is Mother</label>
                                        <input class="form-control" type="text" name="is_mother" placeholder="Is Mother"
                                            value="{{ isset($clientSymtom->is_mother) && $clientSymtom->is_mother ? $clientSymtom->is_mother : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div alass="form-group">
                                        <label for="is_father">Is Father</label>
                                        <input class="form-control" type="text" name ="is_father"
                                            placeholder="Is Father"
                                            value="{{ isset($clientSymtom->is_father) && $clientSymtom->is_father ? $clientSymtom->is_father : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <input class="form-control" type="text" name="comments"
                                            placeholder="Comments"
                                            value="{{ isset($clientSymtom->comments) && $clientSymtom->comments ? $clientSymtom->comments : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button id="btn" class="btn btn-primary" type="submit">Submit</button>
                                @if (session('finished'))
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-success"
                                        type="submit">Finish</a>
                                @endif
                            </div>
                            <div class="form-group mt-4">
                            </div>
                        </form>
                    </div>
                    {{-- Symtoms Ends Here --}}

                </div>
            </div>
        </div>
    @endsection
