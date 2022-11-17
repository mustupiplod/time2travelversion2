<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ url('Admin/assets/images/faces/face8.jpg') }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{auth()->guard('admin')->user()->name}}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                               href="#" data-toggle="dropdown" aria-expanded="false">
                                <small class="designation text-muted">Administrator</small>
                                <span class="status-indicator online"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                                <a class="dropdown-item p-0">
                                    <div class="d-flex border-bottom">
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                        </div>
                                        <div
                                            class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                            <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                        </div>
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item mt-2"> Manage Accounts </a>
                                <a class="dropdown-item"> Change Password </a>
                                <a class="dropdown-item"> Check Inbox </a>
                                <a class="dropdown-item"> Sign Out </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user_list')}}">
                <i class="menu-icon mdi mdi-nature-people"></i>
                <span class="menu-title">Manage Users</span>
            </a>
        </li>


{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('admin.categ_list') }}">--}}
{{--                <i class="menu-icon mdi mdi-progress-alert"></i>--}}
{{--                <span class="menu-title">Manage Categories</span>--}}
{{--            </a>--}}
{{--        </li>--}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('featured_city.list') }}">
                <i class="menu-icon mdi mdi-city-variant"></i>
                <span class="menu-title">Featured City</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('hotel.list') }}">
                <i class="menu-icon mdi mdi-office-building"></i>
                <span class="menu-title">Hotels</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.list_faq') }}">
                <i class="menu-icon mdi mdi-account-question"></i>
                <span class="menu-title">FAQs</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.list_cms_page') }}">
                <i class="menu-icon mdi mdi-table-of-contents"></i>
                <span class="menu-title">CMS Pages</span>
            </a>
        </li>

        {{--        <li data-toggle="collapse" data-target="#notification" class="collapsed  nav-item ">--}}
        {{--            <a href="#!" class="nav-link"><i class="menu-icon mdi mdi-note-multiple"></i>--}}
        {{--                <span class="menu-title">Manage Notification</span>--}}
        {{--                <i class="menu-arrow"></i>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        <ul class="sub-menu flex-column collapse list-unstyled ml-3" id="notification">--}}
        {{--            <li class="nav-item">--}}
        {{--                <a class="nav-link" href="{{ route('admin.list_announcement') }}">--}}
        {{--                    <i class="menu-icon mdi mdi-chart-line"></i>--}}
        {{--                    <span class="menu-title">Announcements</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item">--}}
        {{--                <a class="nav-link" href="{{route('admin.notif_list')}}">--}}
        {{--                    <i class="menu-icon mdi mdi-nature-people"></i>--}}
        {{--                    <span class="menu-title">Notifications</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}

        {{--        </ul>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{route('admin.contact-list')}}">--}}
{{--                <i class="menu-icon mdi mdi-receipt"></i>--}}
{{--                <span class="menu-title">Contact-Us List</span>--}}
{{--            </a>--}}
{{--        </li>--}}

    </ul>
</nav>
