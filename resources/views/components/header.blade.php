<div class="header">
  <div class="header-content clearfix">

    <div class="nav-control">
      <div class="hamburger">
        <span class="toggle-icon"><i class="icon-menu"></i></span>
      </div>
    </div>
    <div class="header-left d-none">
      <div class="input-group icons">
        <div class="input-group-prepend">
          <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
              class="mdi mdi-magnify"></i></span>
        </div>
        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
        <div class="drop-down animated flipInX d-md-none">
          <form action="#">
            <input type="text" class="form-control" placeholder="Search">
          </form>
        </div>
      </div>
    </div>
    <div class="header-right">
      <ul class="clearfix">
        {{--<li class="icons dropdown">
          <a href="javascript:void(0)" data-toggle="dropdown">
            <i class="mdi mdi-email-outline"></i>
            <span class="badge badge-pill gradient-1">3</span>
          </a>
          <div class="drop-down animated fadeIn dropdown-menu">
            <div class="dropdown-content-heading d-flex justify-content-between">
              <span class="">3 New Messages</span>
              <a href="javascript:void()" class="d-inline-block">
                <span class="badge badge-pill gradient-1">3</span>
              </a>
            </div>
            <div class="dropdown-content-body">
              <ul>
                <li class="notification-unread">
                  <a href="javascript:void()">
                    <img class="float-left mr-3 avatar-img" src="{{ theme('images/avatar/1.jpg') }}" alt="">
                    <div class="notification-content">
                      <div class="notification-heading">Saiful Islam</div>
                      <div class="notification-timestamp">08 Hours ago</div>
                      <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                    </div>
                  </a>
                </li>
                <li class="notification-unread">
                  <a href="javascript:void()">
                    <img class="float-left mr-3 avatar-img" src="{{ theme('images/avatar/2.jpg') }}" alt="">
                    <div class="notification-content">
                      <div class="notification-heading">Adam Smith</div>
                      <div class="notification-timestamp">08 Hours ago</div>
                      <div class="notification-text">Can you do me a favour?</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void()">
                    <img class="float-left mr-3 avatar-img" src="{{ theme('images/avatar/3.jpg') }}" alt="">
                    <div class="notification-content">
                      <div class="notification-heading">Barak Obama</div>
                      <div class="notification-timestamp">08 Hours ago</div>
                      <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void()">
                    <img class="float-left mr-3 avatar-img" src="{{ theme('images/avatar/4.jpg') }}" alt="">
                    <div class="notification-content">
                      <div class="notification-heading">Hilari Clinton</div>
                      <div class="notification-timestamp">08 Hours ago</div>
                      <div class="notification-text">Hello</div>
                    </div>
                  </a>
                </li>
              </ul>

            </div>
          </div>
        </li>--}}
        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            <span class="badge badge-pill gradient-2">{{ auth()->user()->notifications->count() > 9 ? '9+' :
              auth()->user()->notifications->count() }}</span>
          </a>
          <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
            <div class="dropdown-content-heading d-flex justify-content-between">
              <span class="">{{ auth()->user()->notifications->count() > 0 ? auth()->user()->notifications->count() . '
                New Notifications' : 'No New Notifications' }}</span>
              <a href="javascript:void()" class="d-inline-block">
                <span class="badge badge-pill gradient-2">{{ auth()->user()->notifications->count() }}</span>
              </a>
            </div>
            <div class="dropdown-content-body">
              <ul>
                @forelse(auth()->user()->notifications()->latest()->limit(5)->get() as $notification)
                <li>
                  <a href="{{ isset($notification->data['type']) ? ($notification->data['type'] == 'booking' ? route('bookings.index') : route('tickets.index')) : 'javascript:void()' }}">
                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                    <div class="notification-content">
                      <h6 class="notification-heading">{{ $notification->data['message'] }}</h6>
                      <span class="notification-text">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                  </a>
                </li>
                @empty
                <li>
                  <a href="javascript:void()">
                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                    <div class="notification-content">
                      <h6 class="notification-heading">Enjoy!</h6>
                      <span class="notification-text">Nothing to show</span>
                    </div>
                  </a>
                </li>
                @endforelse
              </ul>
            </div>
          </div>
        </li>
        {{--<li class="icons dropdown d-none d-md-flex">
          <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
            <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
          </a>
          <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
            <div class="dropdown-content-body">
              <ul>
                <li><a href="javascript:void()">English</a></li>
                <li><a href="javascript:void()">Dutch</a></li>
              </ul>
            </div>
          </div>
        </li>--}}
        <li class="icons dropdown">
          <div class="user-img c-pointer position-relative" data-toggle="dropdown">
            <span class="activity active"></span>
            <img src="{{ auth()->user()->avatar?->getUrl() }}" onerror="this.src=this.dataset.fallbackImage"
              data-fallback-image="{{ asset('assets/members/avatar.png') }}" height="40" width="40" alt="">
          </div>
          <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
            <div class="dropdown-content-body">
              <ul>
                {{--<li>
                  <a href="{{ route('profile.show') }}"><i class="icon-user"></i> <span>Profile</span></a>
                </li>
                <li>
                  <a href="javascript:void()">
                    <i class="icon-envelope-open"></i> <span>Inbox</span>
                    <div class="badge gradient-3 badge-pill gradient-1">3</div>
                  </a>
                </li>

                <hr class="my-2">
                <li>
                  <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                </li>--}}
                <li><a href="javascript:void()"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                      class="icon-key"></i> <span>Logout</span></a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<form action="{{ route('logout') }}" method="POST" id="logout-form">
  @csrf
</form>
