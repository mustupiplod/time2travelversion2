<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/admin/login') }}">
      <img src="{{ url('Web/images/logo.jpg') }}" alt="" /> </a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('/admin/login') }}">
      <img src="{{ url('Web/images/logo.jpg') }}" alt="" /> </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text d-none d-md-inline-flex">{{auth()->guard('admin')->user()->name}}</span>
          <img class="img-xs rounded-circle" src="{{ url('Admin/assets/images/faces/face8.jpg') }}" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

{{--          <a class="dropdown-item mt-2"> Manage Accounts </a>--}}
          <a class="dropdown-item" href="{{route('admin.change_pass')}}"> Change Password </a>
{{--          <a class="dropdown-item"> Check Inbox </a>--}}
          <a class="dropdown-item" href="{{route('admin.logout')}}"> Sign Out </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu icon-menu"></span>
    </button>
  </div>
</nav>
