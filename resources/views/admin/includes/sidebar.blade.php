<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.index' ? '' : 'collapsed' }}" href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            @php
                $collapsed = true;
                if(in_array(Route::currentRouteName(), 
                ['adminjobs.index','adminjobs.create', 'category.index','categories.edit'])){
                    $collapsed = false;
                }
            @endphp
            <a class="nav-link {{ $collapsed ? 'collapsed' : '' }} " data-bs-target="#components-nav" data-bs-toggle="{{ $collapsed ? 'collapse' : '' }}" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Manage Jobs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content {{ $collapsed ? 'collapse' : '' }} " data-bs-parent="#sidebar-nav">
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
            <a class="nav-link {{ Route::currentRouteName() == 'admin.users' ? '' : 'collapsed' }}" href="{{ route('admin.users') }}">
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
        

   

   
        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-gem"></i>
                <span>Membership</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-journal-text"></i>
                <span>Pages</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-gear"></i>
                <span>Setting</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
