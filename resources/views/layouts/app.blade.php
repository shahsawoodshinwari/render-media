<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <link rel="icon" type="image/png" sizes="16x16" href="{{ theme('images/favicon.png') }}">

  <link href="{{ theme('plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ theme('plugins/chartist/css/chartist.min.css') }}">
  <link rel="stylesheet" href="{{ theme('plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
  <link href="{{ theme('css/style.css') }}" rel="stylesheet">
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

    <x-navbar />
    <x-header />
    <x-sidebar />


  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">
    @yield('content')
  </div>
  <!--**********************************
        Main wrapper end
    ***********************************-->

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="{{ theme('plugins/common/common.min.js') }}"></script>
  <script src="{{ theme('js/custom.min.js') }}"></script>
  <script src="{{ theme('js/settings.js') }}"></script>
  <script src="{{ theme('js/gleek.js') }}"></script>
  <script src="{{ theme('js/styleSwitcher.js') }}"></script>

  <!-- Chartjs -->
  <script src="{{ theme('plugins/chart.js/Chart.bundle.min.js') }}"></script>

  <!-- Circle progress -->
  <script src="{{ theme('plugins/circle-progress/circle-progress.min.js') }}"></script>

  <!-- Datamap -->
  <script src="{{ theme('plugins/d3v3/index.js') }}"></script>
  <script src="{{ theme('plugins/topojson/topojson.min.js') }}"></script>
  <script src="{{ theme('plugins/datamaps/datamaps.world.min.js') }}"></script>

  <!-- Morrisjs -->
  <script src="{{ theme('plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ theme('plugins/morris/morris.min.js') }}"></script>

  <!-- Pignose Calender -->
  <script src="{{ theme('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ theme('plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>

  <!-- ChartistJS -->
  <script src="{{ theme('plugins/chartist/js/chartist.min.js') }}"></script>
  <script src="{{ theme('plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>



  <script src="{{ theme('js/dashboard/dashboard-1.js') }}"></script>

</body>

</html>