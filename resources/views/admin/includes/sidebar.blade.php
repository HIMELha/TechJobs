<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.index' ? '' : 'collapsed' }}"
                href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            @php
                $collapsed = true;
                if (
                    in_array(Route::currentRouteName(), [
                        'adminjobs.index',
                        'adminjobs.create',
                        'category.index',
                        'categories.edit',
                    ])
                ) {
                    $collapsed = false;
                }
            @endphp
            <a class="nav-link {{ $collapsed ? 'collapsed' : '' }} " data-bs-target="#components-nav"
                data-bs-toggle="{{ $collapsed ? 'collapse' : '' }}" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Manage Jobs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content {{ $collapsed ? 'collapse' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminjobs.create') }}">
                        <i class="bi bi-circle"></i><span>Post Job</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminjobs.index') }}">
                        <i class="bi bi-circle"></i><span>All Jobs</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.users' ? '' : 'collapsed' }}"
                href="{{ route('admin.users') }}">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bx bx-briefcase"></i>
                <span>Companies</span>
            </a>
        </li>





        <li class="nav-heading">System</li>
        @php
                $collapsed2 = true;
                if (
                    in_array(Route::currentRouteName(), [
                        'membership.requests',
                        'membership.index'
                    ])
                ) {
                    $collapsed2 = false;
                }
            @endphp
        <li class="nav-item">
            <a class="nav-link {{ $collapsed2 ? 'collapsed' : '' }} " data-bs-target="#memberships"
                data-bs-toggle="{{ $collapsed2 ? 'collapse' : '' }}" href="#">
                <i class="bi bi-gem"></i><span>Memberships</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>



            <ul id="memberships" class="nav-content {{ $collapsed2 ? 'collapse' : '' }} " data-bs-parent="#memberships">
                <li>
                    <a href="{{ route('membership.requests') }}">
                        <i class="bi bi-circle"></i><span>Requests</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('membership.index') }}">
                        <i class="bi bi-circle"></i><span>Members</span>
                    </a>
                </li>
            </ul>

        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'pages.index' ? '' : 'collapsed' }}"
                href="{{ route('pages.index') }}">
                <i class="bi bi-journal-text"></i>
                <span>Pages</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.settings' ? '' : 'collapsed' }}"
                href="{{ route('admin.settings') }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
