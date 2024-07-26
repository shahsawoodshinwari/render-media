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
    <x-dashboard.main-card title="{{ __('Members') }}" url="{{ route('members.index') }}" gradient="gradient-1" icon="fa fa-users" count="{{ $statistics->members->count }}" date="{{ $statistics->members->date }}" />

    <!-- Freelancers -->
    <x-dashboard.main-card title="{{ __('Freelancers') }}" url="{{ route('freelancers.index') }}" gradient="gradient-3" icon="fa fa-briefcase" count="{{ $statistics->freelancers->count }}" date="{{ $statistics->freelancers->date }}" />

    <!-- Bookings -->
    <x-dashboard.main-card title="{{ __('Bookings') }}" url="{{ route('bookings.index') }}" gradient="gradient-2" icon="fa fa-shopping-cart" count="{{ $statistics->bookings->count }}" date="{{ $statistics->bookings->date }}" />

    <!-- Customer Satisfaction -->
    {{--<x-dashboard.main-card title="Customer Satisfaction" gradient="gradient-4" icon="fa fa-heart" count="99%" date="Jan - March 2019" />--}}
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
              <canvas id="members_freelancers_chart" data-chart-data="{{ json_encode($statistics->chart) }}"></canvas>
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
    @foreach($latestFourMembers as $member)
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ $member->avatar?->getUrl() ?? asset('assets/members/avatar.png') }}" width="45" height="45" class="rounded-circle" alt="">
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
                  @forelse ($latestSevenFreelancers as $freelancer)
                  <tr>
                    <td>
                      <a href="{{ route('freelancers.edit', $freelancer->id) }}" class="text-decoration-underline">{{ $freelancer->name }}</a>
                    </td>
                    <td>{{ $freelancer->experience }}</td>
                    <td>{{ $freelancer->speciality }}</td>
                    <td>{{ $freelancer->phone }}</td>
                    <td>
                      <button class="btn btn-sm btn-<?php echo match ($freelancer->status->value) {
                        'Active' => 'success',
                        'Inactive' => 'warning',
                        'Suspended' => 'danger',
                        'Pending' => 'info',
                        default => 'secondary'
                      }; ?>">
                        {{ $freelancer->status }}
                      </button>
                    </td>
                    <td>
                      <a href="{{  $freelancer->portfolio }}" class="btn btn-sm btn-primary">{{ __('View Portfolio') }}</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">{{ __('No freelancers added in the system.') }}</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row d-none">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="social-graph-wrapper widget-facebook">
          <span class="s-icon"><i class="fa fa-facebook"></i></span>
        </div>
        <div class="row">
          <div class="col-6 border-right">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">89k</h4>
              <p class="m-0">{{ __('Friends') }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">{{ __('Followers') }}</p>
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
              <p class="m-0">{{ __('Friends') }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">{{ __('Connections') }}</p>
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
              <p class="m-0">{{ __('Followers') }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">{{ __('Connections') }}</p>
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
              <p class="m-0">{{ __('Friends') }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
              <h4 class="m-1">119k</h4>
              <p class="m-0">{{ __('Followers') }}</p>
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