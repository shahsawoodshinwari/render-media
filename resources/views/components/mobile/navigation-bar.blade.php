<div class="container sticky-bottom bg-theme navigation-bar">
  <ul class="nav nav-pills nav-flush w-100 justify-content-between text-center py-3">
    <li class="nav-item">
      <a class="{{ Route::is('mobile.home') ? 'active': null }} nav-link d-flex rounded-circle p-0 align-items-center justify-content-center"
        href="/mobile/">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house"
          viewBox="0 0 16 16">
          <path
            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
        </svg>
      </a>
    </li>
    <li class="nav-item">
      <a class="{{ Route::is('mobile.bookings') ? 'active': null }} nav-link d-flex rounded-circle p-0 align-items-center justify-content-center"
        href="/mobile/bookings">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar"
          viewBox="0 0 16 16">
          <path
            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
        </svg>
      </a>
    </li>
    <li class="nav-item">
      <a class="{{ Route::is('mobile.tickets') ? 'active': null }} nav-link d-flex rounded-circle p-0 align-items-center justify-content-center"
        href="/mobile/tickets">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope"
          viewBox="0 0 16 16">
          <path
            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
        </svg>
      </a>
    </li>
    <li class="nav-item">
      <a class="{{ Route::is('mobile.profile') ? 'active': null }} nav-link d-flex rounded-circle p-0 align-items-center justify-content-center"
        href="/mobile/profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person"
          viewBox="0 0 16 16">
          <path
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
        </svg>
      </a>
    </li>
  </ul>
</div>
