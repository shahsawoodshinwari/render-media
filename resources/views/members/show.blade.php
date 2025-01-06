@extends('layouts.app', ['title' => 'Members - Details'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
  .table-striped thead th,
  .table-striped tbody td,
  .table-striped tfoot td,
  .table-striped tfoot th {
    text-wrap: nowrap !important;
  }
</style>
@endpush('css')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-xxl-3">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center mb-4">
            <label class="mr-3" for="avatar">
              <img class="cursor-pointer rounded-circle" src="{{ $member->avatar?->getUrl() }}"
                data-fallback-image="{{ asset('assets/members/avatar.png') }}"
                onerror="this.src=this.dataset.fallbackImage" width="80" height="80" alt="">
            </label>
            <div class="media-body">
              <h4 class="mb-0">{{ $member->name }}</h4>
            </div>
          </div>

          <form action="{{ route('members.profile-picture.update', $member) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="avatar" onchange="this.form.submit();" id="avatar" accept="image/*" class="d-none">
          </form>

          <h4 class="text-center text-uppercase text-muted">{{ __('About Me') }}</h4>
          <ul class="card-profile__info">
            <li class=""><strong class="text-dark mr-4">{{ __('Phone') }}:</strong></li>
            <li class="text-right mb-1"><span>{{ $member->phone }}</span></li>
            <li><strong class="text-dark mr-4">{{ __('Email') }}:</strong></li>
            <li class="text-right"><span>{{ $member->email }}</span></li>
          </ul>
          <a href="#" class="btn btn-danger w-100">
            <i class="fa fa-pencil"></i> {{ __('Edit') }}
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-xxl-9">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('Bookings List') }}</h4>
          </div>
          <div class="table-responsive no-padding">
            <table class="table table-striped table-bordered zero-configuration text-center">
              <thead>
                @include('bookings.headers')
              </thead>
              <tbody>
                @foreach ($member->bookings as $booking)
                <tr>
                  <td data-cell="booking id">{{ $booking->booking_id }}</td>
                  <td data-cell="Member">{{ $booking->member_first_name }} {{ $booking->member_last_name }}</td>
                  <td data-cell="Category">{{ $booking->category?->name }}</td>
                  <td data-cell="Sub Category">{{ $booking->subCategory?->name }}</td>
                  <td data-cell="Email">{{ $booking->member_email }}</td>
                  <td data-cell="Phone">{{ $booking->member_phone }}</td>
                  <td data-cell="Date & Time" class="text-nowrap">
                    {{ $booking->date?->format('d M, Y') }} {{ $booking->time?->format('h:i a') }}
                  </td>
                  <td data-cell="Shooting Type">
                    {{ $booking->shooting_type }}
                  </td>
                  <td data-cell="Location from lat & lng">
                    <a href="https://www.google.com/maps/place/{{ $booking->lat }},{{ $booking->lng }}" target="_blank">
                      <i class="icon-map"></i> {{ __('Show on map') }}
                    </a>
                  </td>
                  <td data-cell="Payment Status">
                    <select name="payment_status" class="form-control w-75 py-0" form="{{ $booking->booking_id }}"
                      onchange="this.form.submit();">
                      @foreach(\App\Enums\Booking\PaymentStatusEnum::values() as $option)
                      <option <?php echo $booking->payment_status?->value == $option ? 'selected' : '' ?>>{{ $option }}
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td data-cell="Status">
                    <select name="request_status" class="form-control w-75 py-0" form="{{ $booking->booking_id }}"
                      onchange="this.form.submit();">
                      @foreach(\App\Enums\Booking\RequestStatusEnum::values() as $option)
                      <option <?php echo $booking->request_status?->value == $option ? 'selected' : '' ?>>{{ $option }}
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td data-cell="Additional Details">
                    {{ $booking->additional_details }}
                  </td>
                  <form class="d-none" id="{{ $booking->booking_id }}"
                    action="{{ route('bookings.update', $booking->id) }}" method="post">
                    @csrf
                    @method('PUT')
                  </form>
                </tr>
                @endforeach
              <tfoot>
                @include('bookings.headers')
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ theme('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@endpush('js')