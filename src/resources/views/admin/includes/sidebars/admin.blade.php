<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{route("dashboard.index")}}">
            <img src="{{ asset('admin/assets/img/Logo.png') }}" width="50" alt="Logo">
        </a>
    </div>

    <!-- Theme Setting Menus Start -->
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg>
                Dashboard </a></li>

        {{-- <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg>
                Users</a></li> --> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('specialization.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-cog') }}"></use>
                </svg>
                Specializations
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('certification.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-badge') }}"></use>
                </svg>
                Certifications
            </a>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="{{ route('user.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg>
                Providers
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}"><span
                            class="nav-icon"></span>All Providers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}"><span
                            class="nav-icon"></span> Add New Provider</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                </svg>
                Book appointment</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.index') }}"><span
                            class="nav-icon"></span>All Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.create') }}"><span
                            class="nav-icon"></span> Add New Appointment</a></li>
            </ul>
        </li>

        <hr>


        <li class="nav-group"><a class="nav-link nav-group-toggle">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                </svg>
                Events</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('viewEvent') }}"><span
                            class="nav-icon"></span>All Event</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('event.index') }}"><span
                            class="nav-icon"></span> Add New Event</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('quote.index') }}">
                <div class="nav-icon">
                    <i class="fas fa-quote-left"></i>
                </div>
                Quote
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('recovery.resources') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                Recovery Resources
            </a>
        </li>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('terms_of_use') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>
                Terms of Use
            </a>
        </li>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('donation.index') }}">
                <div class="nav-icon">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                Donate
            </a>
        </li>
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
<style>
    #sidebar {
        font-family: 'Your-Desired-Font', sans-serif;
        background-color: #343a40;
        /* Adjust the background color as needed */
        color: #ffffff;
        /* Adjust the text color as needed */
    }

    .sidebar-nav .nav-item .nav-link {
        font-family: 'Your-Desired-Font', sans-serif;
        color: #ffffff;
        /* Adjust the text color as needed */
    }
</style>
