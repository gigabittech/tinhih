<style>
    #searchInput:focus {
        border-color: #ffdd00 !important;
        outline: none;
        /* Removes the default blue outline */
    }
</style>
<header class="header header-sticky pb-4 bg-black ">
    <div class="container-fluid">
        <div class="header-nav ms-3 d-flex align-items-center">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <ul class="header-nav align-items-center">
                <li class="nav-item">
                    <a class="dropdown-item" style="color: rgba(255, 255, 255, 0.6)"
                        href="{{ route('provider.index') }}">Profile Settings</a>
                </li>

            </ul>
        </div>
        <a class="header-brand d-md-none" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('admin/assets/img/Logo.png') }}" width="50" alt="Logo">
        </a>

        <ul class="header-nav ms-3">
            <li class="nav-item profile-field" style="margin-top: 10px">
                <input type="text" placeholder="Search here..." id="searchInput" class="form-control form-control-sm"
                    style="height: 30px; width: 150px; background: transparent; color: rgba(255, 255, 255, 0.6);">
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-coreui-toggle="dropdown" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <svg
                            class="icon icon-lg {{ auth()->user()->unreadNotifications()->count() == 0 ? '' : 'text-primary' }}">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-bell') }}"
                                id="bell"></use>
                        </svg>
                        <span class="rounded-circle px-1"
                            style="margin-top: -25px; margin-left:-6px; background: #ffdd00;
                            font-weight: bolder;
                            font-size: 10px; color: #000; }}"
                            id="notification-no">
                            {{ auth()->user()->unreadNotifications()->count() > 0 ? auth()->user()->unreadNotifications()->count() : '' }}
                        </span>
                    </div>
                </a>

                <div class="dropdown-menu bg-dark dropdown-menu-end pt-0" style="width:300px!important;">
                    <div class="dropdown-header py-2">
                        <div class="fw-semibold text-primary">Notifications</div>
                    </div>
                    <hr class="m-0 text-primary">

                    @if (auth()->user()->unreadNotifications()->count() > 0)

                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <p style=" color: rgba(255,255,255, 0.6)" class="ps-3 pb-0 my-2">

                                {{ auth()->user()->type == 'provider' ? $notification->data['providerMessage'] : '' }}
                                <span style="font-size: 9px;"
                                    class="text-primary">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                </span>
                            </p>
                        @endforeach

                        <hr class="m-0 text-primary">
                        <a class="dropdown-item text-primary mt-2" href="{{ route('notification.markRead') }}">Mark all
                            as
                            read</a>
                    @else
                        <p style="padding: 0 5px 5px 15px; margin-top: 10px; color:  rgba(255,255,255, 0.6)"
                            class="text-center"> You have no
                            notifications</p>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown bg-black">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        @if (isset(auth()->user()->provider->provider_image))
                            <img class="avatar-img mt-3" style="margin-top: 9px;"
                                src="{{ asset(auth()->user()->provider->provider_image) }}" alt="user@email.com" />
                        @else
                            <img class="avatar-img mt-3" style="margin-top: 9px;"
                                src="{{ asset('admin/assets/img/avatars/profile.png') }}" alt="user@email.com" />
                        @endif
                    </div>
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-end bg-dark pt-0 mt-1" style="background: #051821">
                    <div class="dropdown-header py-2" style="background: #142f2f">
                        <div class="fw-semibold">Account</div>
                    </div>
                    <hr class="m-1 text-primary">


                    <a class="dropdown-item text-white" href="{{ route('provider.index') }}">
                        <svg class="icon me-2" style="margin-top: 9px;
                        ">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                        </svg>
                        Profile</a>

                    <a class="dropdown-item text-white" href="{{ route('changePassword') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                            </use>
                        </svg>
                        Change Password</a>

                    <a class="dropdown-item text-white" href="{{ route('logout') }}">
                        <svg class="icon me-2">
                            <use
                                xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                            </use>
                        </svg>
                        Logout</a>
                </div> --}}
                <div class="dropdown-menu dropdown-menu-end pt-0 mt-1 bg-dark">
                    <div class="dropdown-header py-2">
                        <div class="fw-semibold">Accounts</div>
                    </div>
                    <hr class="m-1 text-primary">
                    <a class="dropdown-item " style="color: rgba(255, 255, 255, 0.6)" href="javascript:void(0);">

                        <i class="fa-regular fa-bell me-2 text-primary" style="margin-top: 9px;"></i>
                        Updates
                    </a>
                    <a class="dropdown-item " style="color: rgba(255, 255, 255, 0.6)" href="javascript:void(0);">
                        <i class="fa-regular fa-message me-2 text-primary" style="margin-top: 9px;"></i>
                        Messages
                    </a>


                    <div class="dropdown-header py-2">
                        <div class="fw-semibold">Settings</div>
                    </div>
                    <hr class="m-1 text-primary">

                    <a class="dropdown-item" style="color: rgba(255, 255, 255, 0.6)"
                        href="{{ route('provider.index') }}">
                        <svg class="icon me-2 text-primary" style="margin-top: 9px;
                        ">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                        </svg>
                        Profile</a>

                    <a class="dropdown-item" style="color: rgba(255, 255, 255, 0.6)"
                        href="{{ route('changePassword') }}">
                        <svg class="icon me-2 text-primary" style="margin-top: 9px;">
                            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                            </use>
                        </svg>
                        Change Password</a>

                    <hr class="m-1 text-primary">
                    <a class="dropdown-item" style="color: rgba(255, 255, 255, 0.6)" href="{{ route('logout') }}">
                        <svg class="icon me-2 text-primary" style="margin-top: 9px;">
                            <use
                                xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                            </use>
                        </svg>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
    {{-- <div class="header-divider"></div> --}}
    {{--    <div class="container-fluid"> --}}
    {{--        <nav aria-label="breadcrumb"> --}}
    {{--            <ol class="breadcrumb my-0 ms-2"> --}}
    {{--                <li class="breadcrumb-item"> --}}
    {{--                    <!-- if breadcrumb is single--><span>Home</span> --}}
    {{--                </li> --}}
    {{--                <li class="breadcrumb-item active"><span>Dashboard</span></li> --}}
    {{--            </ol> --}}
    {{--        </nav> --}}
    {{--    </div> --}}
</header>
