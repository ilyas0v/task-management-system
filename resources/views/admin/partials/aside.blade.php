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


                        @if(\Auth::user()->has_permission('projects'))
                        <li>
                            <a href="{{ route('projects.index') }}"">
                                <i class="fas fa-user"></i>Projects</a>
                        </li>
                        @endif

                        <hr>


                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>My projects</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                @foreach(\Auth::user()->my_projects as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project->id) }}"><img src="/storage/projects/{{ $project->icon }}" width="20px"> {{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>


                        <hr>


                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Projects</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                @foreach(\Auth::user()->projects as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project->id) }}"><img src="/storage/projects/{{ $project->icon }}" width="20px"> {{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>