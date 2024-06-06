<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('dashboard.index') }}">
            <img src="{{ asset('admin/assets/img/Logo.png') }}" width="50" alt="Logo">
        </a>
    </div>

    <!-- Theme Setting Menus Start -->
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg>
                Provider Dashboard </a>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                </svg>
                Book Appointments</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('providerIndex') }}"><span
                            class="nav-icon"></span>My Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('providerAppointment') }}"><span
                            class="nav-icon"></span> Add New Appointment</a></li>
            </ul>
        </li>

        <hr>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewEvent') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                </svg>
                Events</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('recovery.resources') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                Recovery Resources
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('terms_of_use') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>
                Terms of Use
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('donation.index') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                Donate
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('showProduct') }}">
                <div class="nav-icon"><i class="fa-solid fa-cart-shopping"></i>
                </div>
                Products
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('video') }}">
                <div class="nav-icon"><i class="fa-solid fa-video"></i>
                </div>
                Media
            </a>
        </li>


    </ul>

</div>
