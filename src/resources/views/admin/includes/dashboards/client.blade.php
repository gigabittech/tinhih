<div class="container-fluid h-100vh bg-black p-4">
    <div class="row">



        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-low bg-dark">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Quotes</div>
                        @if (is_string($Quote_Count))
                            <div>{{ $Quote_Count }}</div>
                        @else
                            <div>{{ $Quote_Count->title }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-lg-6">
            <div class="card mb-4 text-low bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">Recovery Days</div>
                        @if ($joiningDays !== null)
                            <p>{{ $joiningDays }}</p>
                        @else
                            <p>Not Recovery yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-low bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">#</div>
                        <div>My Appointment</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-low p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="87" width="312" style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-low bg-info bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">#</div>
                        <div>Prescription</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-low p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="87" width="312" style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-low bg-info bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-bold">#</div>
                        <div>Certification</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-low p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="87" width="312" style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                </div>
            </div>
        </div> --}}



    </div>
</div>
