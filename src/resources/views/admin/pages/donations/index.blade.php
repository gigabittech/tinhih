@extends('admin.layout.template')

@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid h-100vh p-5 bg-black">

        <div class="row">

            <div class="col-lg-12">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
            </div>

            <div class="col-lg-8 mb-5">
                <div class="card-body bg-dark bg-dark1 p-5">
                    <h4 class="text-white text-center mb-4"><strong>Donate to TINHIH Las Vegas</strong></h4>
                    <p class="text-white-50 text-center">There Is No Hero In Heroin Foundation is a nonprofit organization
                        dedicated to ending the
                        devastation addiction causes families. We envision a world where fewer lives are lost and help
                        exists for the millions of Americans affected by addiction. All proceeds go to furthering our
                        mission. We appreciate your support.
                    </p>

                    <form action="{{ route('payment.checkout') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-field ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="donate-check">
                                        <li>
                                            <input class="radio" type="radio" name="residency" value="Immigrant"
                                                id="immigrant" onclick="enableInput1()">
                                            <label class="text-white" for="immigrant">One-time Donation</label>
                                            <fieldset class="conditional">
                                                <input name="one_time" class="ps-2 w-100 check-filed input-1"
                                                    placeholder="One-time Donation Amount" type="text"
                                                    id="country_citizenship" onkeyup="enableBtn(this.value)" disabled>
                                            </fieldset>
                                        </li>
                                        <li>
                                            <input class="radio" type="radio" name="residency" value="Immigrant"
                                                id="immigrant" onclick="enableInput2()">
                                            <label class="text-white" for="immigrant">Recurring Donation</label>
                                            <fieldset class="conditional">
                                                <input name="one_time" class="ps-2 w-100 check-filed input-2"
                                                    placeholder="Recurring Donation Amount" type="text"
                                                    id="country_citizenship" onkeyup="enableBtn(this.value)" disabled>
                                            </fieldset>
                                        </li>
                                    </ul>


                                    <div class="form-group">
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"
                                            class="form-control" autocomplete="off" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary login-button" type="submit" disabled>
                                    Donate with Stripe
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
    <script>
        function enableInput1() {
            document.querySelector('.input-1').disabled = false;
            document.querySelector('.input-2').disabled = true;
            // document.querySelector('.input-2').value = 0;
            enableBtn(0 ? 0 : document.querySelector('.input-1').value);

        }

        function enableInput2() {
            document.querySelector('.input-1').disabled = true;
            document.querySelector('.input-2').disabled = false;
            enableBtn(0 ? 0 : document.querySelector('.input-2').value);


        }

        function enableBtn(val) {
            if (val > 0) {
                document.querySelector('.login-button').disabled = false;
                val = 0;
            } else {
                document.querySelector('.login-button').disabled = true;
            }

        }
    </script>
@endsection
