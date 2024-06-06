@extends('admin.layout.template')
@section('body')
    <div class="container-fluid p-5 bg-black vh-100">

        <div class="row">

            <div class="col-lg-12 bg-dark1 p-5">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif

                <!-- Relationship starts -->
                <div class="tab-content" data-tab="6">

                    <style>
                        .form-check-input {
                            width: 1em;
                            height: 1em;
                        }
                    </style>
                    <i class="btn btn-primary text-black text-center">
                        Did you know pigeons can tell the difference between Picasso and Monet?
                    </i>
                    <h2 class="text-white mt-5">Relationship</h2><br>
                    <form
                        action="{{ $relationship == null ? route('relationship.store') : route('relationship.update', $relationship->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($relationship != null)
                            @method('PUT')
                        @endif
                        <!-- Relationship table -->
                        <h4 class="text-white">Best describes your or your child's relationship</h4>
                        <div class="row profile-field radio-options  ">
                            <div class="col-lg-8">
                                <div class="radio-options">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-check col-lg-10 ">
                                        <input class="form-check-input mt-8" type="radio"
                                            name="best_describes_your_or_your_childs_relationship" id="strong-relationships"
                                            value="1"
                                            {{ isset($relationship->best_describes_your_or_your_childs_relationship) &&
                                            $relationship->best_describes_your_or_your_childs_relationship == '1'
                                                ? 'checked'
                                                : '' }}>

                                        <label class="" for="strong-relationships">I have several strong
                                            relationships</label>
                                    </div>
                                    <div class="form-check col-lg-10">
                                        <input class="form-check-input" type="radio"
                                            name="best_describes_your_or_your_childs_relationship" id="close-friends"
                                            value="2" required
                                            {{ isset($relationship->best_describes_your_or_your_childs_relationship) && $relationship->best_describes_your_or_your_childs_relationship == '2' ? 'checked' : '' }}>
                                        <label class="" for="close-friends">I have a few close friends</label>
                                    </div>
                                    <div class="form-check col-lg-10">
                                        <input class="form-check-input" type="radio"
                                            name="best_describes_your_or_your_childs_relationship" id="no-friends"
                                            value="3"
                                            {{ isset($relationship->best_describes_your_or_your_childs_relationship) && $relationship->best_describes_your_or_your_childs_relationship == '3' ? 'checked' : '' }}>
                                        <label class="" for="no-friends">I have no friends</label>
                                    </div>
                                </div>

                                <h4 class="text-white mt-5">What describes your current relationships</h4>

                                <div class="col-lg-12 ">
                                    <div class="form-check col-lg-12">
                                        <input class="form-check-input" type="radio"
                                            name="what_describes_your_current_relationships" id="emotionally_close_support"
                                            value="1" required
                                            {{ isset($relationship->what_describes_your_current_relationships) && $relationship->what_describes_your_current_relationships == '1' ? 'checked' : '' }}>
                                        <label class="" for="emotionally_close_support">I am emotionally close
                                            and feel support with family</label>
                                    </div>

                                    <div class="form-check col-lg-12">
                                        <input class="form-check-input" type="radio"
                                            name="what_describes_your_current_relationships"
                                            {{ isset($relationship->what_describes_your_current_relationships) && $relationship->what_describes_your_current_relationships == '2' ? 'checked' : '' }}>
                                        <label class="" for="emotionally_close_some_frustration">I am
                                            emotionally close to some family but others are a great source of
                                            frustration and stress</label>
                                    </div>

                                    <div class="form-check col-lg-12">
                                        <input class="form-check-input" type="radio"
                                            name="what_describes_your_current_relationships" id="no_family_in_community"
                                            value="3"
                                            {{ isset($relationship->what_describes_your_current_relationships) && $relationship->what_describes_your_current_relationships == '3' ? 'checked' : '' }}>
                                        <label class="" for="no_family_in_community">I have no family in the
                                            Las Vegas

                                    </div>

                                    <div class="form-check col-lg-12">
                                        <input class="form-check-input" type="radio"
                                            name="what_describes_your_current_relationships" id="family_tension_danger"
                                            value="4"
                                            {{ isset($relationship->what_describes_your_current_relationships) && $relationship->what_describes_your_current_relationships == '4' ? 'checked' : '' }}>
                                        <label class="" for="family_tension_danger">I have family living in
                                            Las Vegas but they are a source of great tension and/or danger</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group mt-4 ">
                                <button id="btn" class="btn btn-primary" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--  Relationship ends here --}}
            </div>
        </div>
    </div>
@endsection
