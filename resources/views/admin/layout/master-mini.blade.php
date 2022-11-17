<!DOCTYPE html>
<html>
<head>
  <title>Ok Ek | Admin Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link rel="stylesheet" href="{{asset('Admin/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!-- end plugin css -->

    @stack('plugin-styles')

    <link rel="stylesheet" href="{{asset('Admin/css/app.css')}}">
    <!-- end common css -->

    @stack('style')
</head>
<body>

  <div class="container-scroller" id="app">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      @yield('content')
    </div>
  </div>

  <script src="{{asset('Admin/js/app.js')}}"></script>

  @stack('custom-scripts')
</body>
</html>
