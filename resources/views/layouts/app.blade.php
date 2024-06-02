<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>{{ isset($title) ? "$title | " : '' }}{{ config('app.name') }}</title>

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ theme('images/favicon.png') }}">

  <!-- Custom Stylesheet -->
  <link href="{{ theme('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
  <link href="{{ theme('css/style.css') }}" rel="stylesheet">

  <style>
    .no-padding .dataTables_wrapper {
      padding: 0px !important;
    }

    .top-50 {
      top: 50%;
    }

    .end-0 {
      right: 0;
    }

    .translate-middle-y {
      transform: translateY(-50%);
    }
  </style>

  @stack('css')

</head>

<body>

  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->


  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">

    <!--**********************************
            Nav header start
        ***********************************-->
    <x-navbar></x-navbar>
    <!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
            Header start
        ***********************************-->
    <x-header></x-header>
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    <x-sidebar></x-sidebar>
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
      @yield('content')
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <x-footer></x-footer>
    <!--**********************************
            Footer end
        ***********************************-->
  </div>
  <!--**********************************
      Main wrapper end
      ***********************************-->

  <!--**********************************
  Scripts
  ***********************************-->
  <x-messages></x-messages>

  <script src="{{ theme('plugins/common/common.min.js') }}"></script>
  <script src="{{ theme('js/custom.min.js') }}"></script>
  <script src="{{ theme('js/settings.js') }}"></script>
  <script src="{{ theme('js/gleek.js') }}"></script>
  <script src="{{ theme('js/styleSwitcher.js') }}"></script>
  <script src="{{ theme('plugins/sweetalert/js/sweetalert.min.js') }}"></script>

  @stack('js')

</body>

</html>