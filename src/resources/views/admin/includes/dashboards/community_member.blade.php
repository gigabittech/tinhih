@php
    $DBrecoveryDate = auth()->user()->community_member->recovery_date;
    $recoveryDate = \Carbon\Carbon::parse(auth()->user()->community_member->recovery_date ?? '');
    $recoveryDays = $recoveryDate->diffInDays(\Carbon\Carbon::now());
@endphp

<div class="container-fluid h-100vh bg-black pt-4">
    <div class="row">



        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Recovery Days</div>
                        @if ($DBrecoveryDate !== null)
                            <p>{{ $recoveryDays }}</p>
                        @else
                            <p>Not Recovery yet</p>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Recovery Quotes</div>
                        @if (is_string($Quote_Count))
                            <div>{{ $Quote_Count }}</div>
                        @else
                            <div>{{ $Quote_Count->title }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start ">
                    <div>
                        <div class="fs-4 fw-bold">Journal Feature</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-dark">
                <a class="text-white" href="#">
                    <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-bold">Different Recovery Paths</div>
                            <div></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Meeting Lists </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-7">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Sober Living </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-5">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Volunteering</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Events</div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-5 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Resources</div>

                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
