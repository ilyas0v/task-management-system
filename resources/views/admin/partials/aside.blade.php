<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        @if(\Auth::user()->has_permission('dashboard'))
                        <li>
                            <a href="/admin">
                                <i class="fas fa-map-marker-alt"></i>Dashboard</a>
                        </li>
                        @endif


                        @if(\Auth::user()->has_permission('permissions'))
                            <li>
                                <a href="{{ route('permissions.index') }}">
                                    <i class="fas fa-key"></i>Permissions</a>
                            </li>
                        @endif


                        @if(\Auth::user()->has_permission('user_roles'))
                            <li>
                                <a href="{{ route('user_roles.index') }}">
                                    <i class="fas fa-users"></i>Roles</a>
                            </li>
                        @endif


                        @if(\Auth::user()->has_permission('users'))
                        <li>
                            <a href="{{ route('users.index') }}"">
                                <i class="fas fa-user"></i>Users</a>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>