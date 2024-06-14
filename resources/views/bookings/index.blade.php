@extends("layouts.app", ["title" => _("Bookings - List")])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
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
            @foreach ($bookings as $booking)
            <tr>
              <td data-cell="booking id">{{ $booking->booking_id }}</td>
              <td data-cell="Member">{{ $booking->member_first_name }} {{ $booking->member_last_name }}</td>
              <td data-cell="Category">{{ $booking->category->name }}</td>
              <td data-cell="Sub Category">{{ $booking->subCategory->name }}</td>
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
                {{ $booking->payment_status }}
              </td>
              <td data-cell="Status">
                {{ $booking->request_status }}
              </td>
              <td data-cell="Additional Details">
                {{ $booking->additional_details }}
              </td>
              <td>
                @include('bookings.actions')
              </td>
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
@endsection('content')

@push('js')
<script src="{{ theme('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@endpush('js')