<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item {{ request()->routeIs('dashboard.index') ? 'selected' : '' }}" > <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false"><i
                            class="fas fa-home"></i><span class="hide-menu">Dashboard</span></a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">User Informations</span></li>

                <li class="sidebar-item {{ request()->routeIs('user-information.supervisor.*') ? 'selected' : '' }}"> <a class="sidebar-link" href="{{ route('user-information.supervisor.index') }}"
                        aria-expanded="false"><i class="fas fa-user-plus"></i><span
                            class="hide-menu">Supervisors
                        </span></a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('user-information.participant.*') ? 'selected' : '' }}"> <a class="sidebar-link" href="{{ route('user-information.participant.index') }}"
                    aria-expanded="false"><i class="fas fa-user-plus"></i><span
                        class="hide-menu">Participants
                    </span></a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('user-information.visitor.*') ? 'selected' : '' }}"> <a class="sidebar-link" href="{{ route('user-information.visitor.index') }}"
                    aria-expanded="false"><i class="fas fa-user-secret"></i><span
                        class="hide-menu">Visitors
                    </span></a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Assessment Information</span></li>


                <li class="sidebar-item {{ request()->routeIs('assessment-information.assessment-group.*') ? 'selected' : '' }}"> <a class="sidebar-link" href="{{ route('assessment-information.assessment-group.index') }}"
                        aria-expanded="false"><i class="fas fa-file"></i><span
                            class="hide-menu">Assessment Group
                        </span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link" href="authentication-register1.html"
                        aria-expanded="false"><i class="fas fa-file"></i><span
                            class="hide-menu">Create Assessment
                        </span></a>
                </li>


                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Setting Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('setting-information.assessment-setting.*') ? 'selected' : '' }}"> <a class="sidebar-link" href="{{ route('setting-information.assessment-setting.index') }}"
                    aria-expanded="false"><i class="fas fa-cog"></i><span
                        class="hide-menu">Assessment Config
                    </span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link" href=""
                    aria-expanded="false"><i class="fas fa-cog"></i><span
                        class="hide-menu">Certificate Config</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href=""
                    aria-expanded="false"><i class="fas fa-cog"></i><span
                        class="hide-menu">Application Config</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
