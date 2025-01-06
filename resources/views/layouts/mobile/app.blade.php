<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.title') }}</title>
  <style>
    :root {
      --theme-color: #001F3F;
    }

    .fs-14px {
      font-size: .75rem;
    }

    .fw-400 {
      font-weight: 400;
    }

    .fs-8px {
      font-size: 8px !important;
    }

    .bg-theme {
      background-color: var(--theme-color);
    }

    .text-theme {
      color: var(--theme-color);
    }

    .navigation-bar .nav-link {
      --size: 40px;
      width: var(--size);
      height: var(--size);
    }

    .navigation-bar .nav-link.active {
      --bs-nav-pills-link-active-bg: white;
      --bs-nav-pills-link-active-color: var(--theme-color);
    }

    .navigation-bar .nav-link:not(.active) {
      --bs-nav-link-color: white;
    }

    .overflow-y-auto.scrollbar-none {
      scrollbar-width: none;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column bg-theme text-white container px-4 vh-100">
  <x-mobile.top-app-bar></x-mobile.top-app-bar>
  <main class="flex-grow-1 overflow-y-auto overflow-x-hidden scrollbar-none">
    @yield('content')
  </main>
  <x-mobile.navigation-bar></x-mobile.navigation-bar>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>
