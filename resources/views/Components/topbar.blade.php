<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <!-- Button Trigger Customizer Offcanvas -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <iconify-icon icon="solar:minimize-square-outline" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </li>

                <!-- Light/Dark Mode Button Themes -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <iconify-icon icon="solar:moon-outline" class="fs-24 align-middle dark-mode"></iconify-icon>
                        <iconify-icon icon="solar:sun-2-outline" class="fs-24 align-middle light-mode"></iconify-icon>
                    </button>
                </li>

                <!-- User Dropdown -->
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=0D6EFD&color=fff"
                            alt="user-image" class="rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">
                                {{ auth()->user()->nama }}
                            </h6>

                            <small class="text-muted">
                                {{ ucfirst(auth()->user()->role) }}
                            </small>
                        </div>

                        <!-- item-->
                        <a class='dropdown-item notify-item rounded-2' href='{{ route('profile.index') }}'>
                            <iconify-icon icon="solar:shield-user-outline" class="fs-18 align-middle"></iconify-icon>
                            <span>Profile</span>
                        </a>

                        <!-- item-->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="dropdown-item notify-item rounded-2 border-0 bg-transparent w-100 text-start">

                                <iconify-icon icon="solar:logout-2-outline" class="fs-18 align-middle">
                                </iconify-icon>

                                <span>Logout</span>

                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
