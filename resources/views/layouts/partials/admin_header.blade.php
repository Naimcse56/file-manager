<header class="top-header">
    <nav class="navbar navbar-expand">
    <div class="mobile-toggle-icon d-xl-none">
        <i class="bi bi-list"></i>
    </div>

    <div class="search-toggle-icon d-xl-none ms-auto">
        <i class="bi bi-search"></i>
    </div>
    <form class="searchbar d-none d-xl-flex ms-auto">
        <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
        <input class="form-control" type="text" placeholder="Type here to search">
        <div class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon"><i
            class="bi bi-x-lg"></i></div>
    </form>
    <div class="top-navbar-right ms-3">
        <ul class="navbar-nav align-items-center">

        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                @php
                    if (moduleManager('Mututal Assesments')) {
                        $bgClass = 'bg-primary bg-gradient';
                        $iconClass = 'bi bi-people-fill';
                    } elseif (moduleManager('Clearance')) {
                        $bgClass = 'bg-orange bg-gradient';
                        $iconClass = 'bi bi-shield-exclamation';
                    } else {
                        $bgClass = 'bg-secondary';
                        $iconClass = 'bi bi-grid-3x3-gap-fill';
                    }
                @endphp
                <div class="projects text-white {{ $bgClass }}">
                    <i class="{{ $iconClass }}"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="row row-cols-3 gx-2">
                    <div class="col">
                        <a href="{{ url('/') }}">
                        <div class="apps p-2 radius-10 text-center {{ moduleManager('Mututal Assesments') ? 'active-app' : '' }}">
                            <div class="apps-icon-box mb-1 text-white bg-primary bg-gradient">
                            <i class="bi bi-people-fill"></i>
                            </div>
                            <p class="mb-0 apps-name">Mutual Assessment</p>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                        <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-white bg-danger bg-gradient">
                            <i class="bi bi-bank2"></i>
                            </div>
                            <p class="mb-0 apps-name">Fund Management</p>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="ecommerce-products-grid.php">
                        <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-white bg-success bg-gradient">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                            <p class="mb-0 apps-name">Complane Management</p>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{route('clearance.dashboard')}}">
                        <div class="apps p-2 radius-10 text-center {{ moduleManager('Clearance') ? 'active-app' : '' }}">
                            <div class="apps-icon-box mb-1 text-white bg-orange bg-gradient">
                            <i class="bi bi-shield-exclamation"></i>
                            </div>
                            <p class="mb-0 apps-name">Clearance Management</p>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="pages-user-profile.php">
                        <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-white bg-purple bg-gradient">
                            <i class="bi bi-card-checklist"></i>
                            </div>
                            <p class="mb-0 apps-name">Feedback Management</p>
                        </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                        <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-dark bg-info bg-gradient">
                            <i class="bi bi-cart-plus-fill"></i>
                            </div>
                            <p class="mb-0 apps-name">Library Management</p>
                        </div>
                        </a>
                    </div>
                </div><!--end row-->
            </div>
        </li>
        <li class="nav-item dropdown dropdown-large d-none d-sm-block">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="notifications">
                <span class="notify-badge">2</span>
                <i class="bi bi-bell-fill"></i>
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0">
            <div class="p-2 border-bottom m-2">
                <h5 class="h5 mb-0">Notifications</h5>
            </div>
            <div class="header-notifications-list p-2">
                <div class="dropdown-item bg-light radius-10 mb-1">
                <form class="dropdown-searchbar position-relative">
                    <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i
                        class="bi bi-search"></i></div>
                    <input class="form-control" type="search" placeholder="Search Messages">
                </form>
                </div>
                <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-bookmark-heart-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0 dropdown-msg-user">4 New Sign Up <span
                            class="msg-time float-end text-secondary">2 w</span></h6>
                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New 4 user
                            registartions</small>
                        </div>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-briefcase-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0 dropdown-msg-user">All Documents Uploaded <span
                            class="msg-time float-end text-secondary">1 mo</span></h6>
                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Sussessfully
                            uploaded all files</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="p-2">
                <div>
                    <hr class="dropdown-divider">
                </div>
                <a class="dropdown-item" href="#">
                    <div class="text-center">View All Notifications</div>
                </a>
            </div>
            </div>
        </li>
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting d-flex align-items-center gap-1">
                <img src="{{showUserAvatar(auth()->user()->avatar)}}" class="user-img" alt="">
                <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                    <img src="{{showUserAvatar(auth()->user()->avatar)}}" alt="" class="rounded-circle" width="60"
                    height="60">
                    <div class="ms-3">
                    <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                    <small class="mb-0 dropdown-user-designation text-secondary">{{ auth()->user()->role->name }}</small>
                    </div>
                </div>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="pages-user-profile.html">
                <div class="d-flex align-items-center">
                    <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                    <div class="setting-text ms-3"><span>My Profile</span></div>
                </div>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{route('change_password')}}">
                <div class="d-flex align-items-center">
                    <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                    <div class="setting-text ms-3"><span>Change Password</span></div>
                </div>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="d-flex align-items-center">
                        <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                        <div class="setting-text ms-3"><span>Logout</span></div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
</header>