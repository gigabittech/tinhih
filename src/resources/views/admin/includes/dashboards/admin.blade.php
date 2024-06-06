<div class="container-fluid h-100vh bg-black pt-4">
    <div class="row">
        <!-- Total Clients -->
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-low bg-dark">
                <a class="text-white" href="{{ route('client.index') }}">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-bold">{{ $client_count }}</div>
                            <div>Total Clients</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button"
                                data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="87" width="312"
                        style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Total Providers -->
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-dark">
                <a class="text-white" href="{{ route('user.index') }}">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-bold">{{ $provider_count }}</div>
                            <div>Total Providers</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button"
                                data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70" width="274"
                        style="display: block; box-sizing: border-box; height: 70px; width: 274px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 153px; top: 123.125px;">
                        <!-- Chart tooltip content here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-warning bg-dark">
                <a class="text-white" href="{{ route('appointment.index') }}">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-bold">{{ $appointment_count }}</div>
                            <div>Total Appointments</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button"
                                data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="87" width="352"
                        style="display: block; box-sizing: border-box; height: 69.6px; width: 281.6px;"></canvas>
                </div>
            </div>
        </div>


        <!-- Appointment History -->
        {{-- <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning bg-dark">
                <a class="text-white" href="#">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-bold"></div>
                            <div>Appointment History</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-options') }}"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70" width="274" style="display: block; box-sizing: border-box; height: 70px; width: 274px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 58.8125px; top: 106px;">
                        <!-- Chart tooltip content here -->
                    </div>
                </div>
            </div>
        </div> --}}


    </div>
</div>
