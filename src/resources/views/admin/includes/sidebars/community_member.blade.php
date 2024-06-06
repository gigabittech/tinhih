<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img src="{{ asset('admin/assets/img/Logo.png') }}" width="50" alt="Logo">
    </div>

    <!-- Theme Setting Menus Start -->
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{route('dashboard.index')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg>
                Community Member </a></li>
        

                <hr>

                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('viewEvent')}}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                        </svg>
                        Events</a></li>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recovery.resources') }}">
                        <div class="nav-icon">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        Recovery Resources</a></li>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('terms_of_use') }}">
                        <div class="nav-icon">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        Terms of Use</a></li>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('donation.index') }}">
                    <div class="nav-icon">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                       Donate</a></li>

                       
        <li class="nav-item">
            <a class="nav-link" href="{{ route('showProduct') }}">
                <div class="nav-icon"><i class="fa-solid fa-cart-shopping"></i>
                </div>
                Products</a></li>
            
        <li class="nav-item">
            <a class="nav-link" href="{{ route('video') }}">
                <div class="nav-icon"><i class="fa-solid fa-video"></i>
                </div>
                Media</a></li>


    </ul>

</div>
<style>
    #sidebar {
        font-family: 'Your-Desired-Font', sans-serif;
        background-color: #343a40; /* Adjust the background color as needed */
        color: #ffffff; /* Adjust the text color as needed */
    }

    .sidebar-nav .nav-item .nav-link {
        font-family: 'Your-Desired-Font', sans-serif;
        color: #ffffff; /* Adjust the text color as needed */
    }
</style>
