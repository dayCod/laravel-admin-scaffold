<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('admin.profile') }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->roles()->first()->name }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.utilities.*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#utilitiesToggle" aria-expanded="false"
                aria-controls="utilitiesToggle">
                <span class="menu-title">Utilities</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-access-point"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.utilities.*') ? 'show' : '' }}" id="utilitiesToggle">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.utilities.rolepermission.*') ? 'active' : '' }}" href="{{ route('admin.utilities.rolepermission.index') }}">
                            Role & Permission
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">
                            User & Role
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">
                            Activity Log
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">
                            Visitor Counter
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
