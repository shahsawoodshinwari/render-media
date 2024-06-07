@extends('layouts.app', ['title' => 'Dashboard'])

@push('css')
<!-- Pignose Calender -->
<link href="{{ theme('plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">

<!-- Chartist -->
<link rel="stylesheet" href="{{ theme('plugins/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ theme('plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
@endpush

@section('content')
<div class="container-fluid mt-3">
  <div class="row">
    <!-- Members -->
    <x-dashboard.main-card title="Members" gradient="gradient-1" icon="fa fa-users" count="{{ $statistics->members->count }}" date="{{ $statistics->members->date }}" />

    <!-- Net Profit -->
    <x-dashboard.main-card title="Net Profit" gradient="gradient-2" icon="fa fa-money" count="$ 8541" date="Jan - March 2019" />

    <!-- Freelancers -->
    <x-dashboard.main-card title="Freelancers" gradient="gradient-3" icon="fa fa-users" count="{{ $statistics->freelancers->count }}" date="{{ $statistics->freelancers->date }}" />

    <!-- Customer Satisfaction -->
    <x-dashboard.main-card title="Customer Satisfaction" gradient="gradient-4" icon="fa fa-heart" count="99%" date="Jan - March 2019" />
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body pb-0 d-flex justify-content-between">
              <div>
                <h4 class="mb-1">{{ __('Members / Freelancers') }}</h4>
                <p>{{ __('This chart shows the number of members and freelancers.') }}</p>
              </div>
              <div>
                <ul>
                  <li class="d-inline-block mr-3 <?php echo request()->duration == 'week' ? 'text-decoration-underline' : '' ?>">
                    <a class="text-dark" href="?duration=week">{{ __('Week') }}</a>
                  </li>
                  <li class="d-inline-block mr-3 <?php echo request()->duration == 'month' || !isset(request()->duration) ? 'text-decoration-underline' : '' ?>">
                    <a class="text-dark" href="?duration=month">{{ __('Month') }}</a>
                  </li>
                  <li class="d-inline-block <?php echo request()->duration == 'year' ? 'text-decoration-underline' : '' ?>">
                    <a class="text-dark" href="?duration=year">{{ __('Year') }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="chart-wrapper">
              <canvas id="chart_widget_2" data-chart-data="{{ json_encode($statistics->chart) }}"></canvas>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div class="w-100 mr-2">
                  <h6>{{ __('Members') }}</h6>
                  <div class="progress" style="height: 6px">
                    <div class="progress-bar bg-danger" style="width: <?php echo $statistics->progressBars->members ?>"></div>
                  </div>
                </div>
                <div class="ml-2 w-100">
                  <h6>{{ __('Freelancers') }}</h6>
                  <div class="progress" style="height: 6px">
                    <div class="progress-bar bg-primary" style="width: <?php echo $statistics->progressBars->freelancers ?>"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Order Summary</h4>
          <div id="morris-bar-chart"></div>
        </div>
      </div>

    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card-widget">
        <div class="card-body">
          <h5 class="text-muted">Order Overview </h5>
          <h2 class="mt-4">5680</h2>
          <span>Total Revenue</span>
          <div class="mt-4">
            <h4>30</h4>
            <h6>Online Order <span class="pull-right">30%</span></h6>
            <div class="progress mb-3" style="height: 7px">
              <div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <h4>50</h4>
            <h6 class="m-t-10 text-muted">Offline Order <span class="pull-right">50%</span></h6>
            <div class="progress mb-3" style="height: 7px">
              <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"><span class="sr-only">50% Order</span>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <h4>20</h4>
            <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
            <div class="progress mb-3" style="height: 7px">
              <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body px-0">
          <h4 class="card-title px-4 mb-3">Todo</h4>
          <div class="todo-list">
            <div class="tdl-holder">
              <div class="tdl-content">
                <ul id="todo_list">
                  <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                  <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                  <li><label><input type="checkbox"><i></i><span>Don't give up the fight.</span><a href='#' class="ti-trash"></a></label></li>
                  <li><label><input type="checkbox" checked><i></i><span>Do something else</span><a href='#' class="ti-trash"></a></label></li>
                </ul>
              </div>
              <div class="px-4">
                <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    @foreach($latestFourMembers as $member)
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ $member->avatar?->getUrl() ?? asset('assets/members/avatar.png') }}" class="rounded-circle" alt="">
            <h5 class="mt-3 mb-1">{{ $member->name }}</h5>
            <p class="text-truncated">{{ $member->email }}</p>
            <a href="javascript:void()" class="btn btn-sm btn-warning">{{ __('Bookings') }}</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="active-member">
            <div class="table-responsive">
              <table class="table table-xs mb-0">
                <thead>
                  <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Experience') }}</th>
                    <th>{{ __('Speciality') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Portfolio') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($latestSevenFreelancers as $freelancer)
                  <tr>
                    <td>{{ $freelancer->name }}</td>
                    <td>{{ $freelancer->experience }}</td>
                    <td>{{ $freelancer->speciality }}</td>
                    <td>{{ $freelancer->phone }}</td>
                    <td>{{ $freelancer->status }}</td>
                    <td>
                      <a href="{{  $freelancer->portfolio }}" class="btn btn-sm btn-primary">{{ __('View Portfolio') }}</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">

      <div class="card">
        <div class="chart-wrapper mb-4">
          <div class="px-4 pt-4 d-flex justify-content-between">
            <div>
              <h4>Sales Activities</h4>
              <p>Last 6 Month</p>
            </div>
            <div>
              <span><i class="fa fa-caret-up text-success"></i></span>
              <h4 class="d-inline-block text-success">720</h4>
              <p class=" text-danger">+120.5(5.0%)</p>
            </div>
          </div>
          <div>
            <canvas id="chart_widget_3"></canvas>
          </div>
        </div>
        <div class="card-body border-top pt-4">
          <div class="row">
            <div class="col-sm-6">
              <ul>
                <li>5% Negative Feedback</li>
                <li>95% Positive Feedback</li>
              </ul>
              <div>
                <h5>Customer Feedback</h5>
                <h3>385749</h3>
              </div>
            </div>
            <div class="col-sm-6">
              <div id="chart_widget_3_1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Activity</h4>
          <div id="activity">
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/1.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>Received New Order</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>iPhone develered</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>3 Order Pending</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>Join new Manager</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>Branch open 5 min Late</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media border-bottom-1 pt-3 pb-3">
              <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>New support ticket received</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
            <div class="media pt-3 pb-3">
              <img width="35" src="./images/avatar/3.jpg" class="mr-3 rounded-circle">
              <div class="media-body">
                <h5>Facebook Post 30 Comments</h5>
                <p class="mb-0">I shared this on my fb wall a few months back,</p>
              </div><span class="text-muted ">April 24, 2018</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-lg-12 col-sm-12 col-xxl-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-0">Store Location</h4>
          <div id="world-map" style="height: 470px;"></div>
        </div>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="social-graph-wrapper widget-facebook">
          <span class="s-icon"><i class="fa fa-facebook"></i></span>
        </div>
        <div class="row">
          <div class="col-6 border-right">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">89k</h4>
              <p class="m-0">Friends</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">Followers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="social-graph-wrapper widget-linkedin">
          <span class="s-icon"><i class="fa fa-linkedin"></i></span>
        </div>
        <div class="row">
          <div class="col-6 border-right">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">89k</h4>
              <p class="m-0">Friends</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">Followers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="social-graph-wrapper widget-googleplus">
          <span class="s-icon"><i class="fa fa-google-plus"></i></span>
        </div>
        <div class="row">
          <div class="col-6 border-right">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">89k</h4>
              <p class="m-0">Friends</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">Followers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="social-graph-wrapper widget-twitter">
          <span class="s-icon"><i class="fa fa-twitter"></i></span>
        </div>
        <div class="row">
          <div class="col-6 border-right">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">89k</h4>
              <p class="m-0">Friends</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">Followers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection('content')

@push('js')

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
@endpush('js')