@extends("layouts.app", ["title" => _("Bookings - List")])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
@media(max-width: 576px) {
.filters .form-control {
width: 100% !important;
}
}
</style>
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <form action="" class="d-flex align-items-center filters" style="flex-wrap: wrap;gap: 1rem">
        <h4 class="card-title">{{ __('Bookings List') }}</h4>
               <select class="form-control rounded ml-auto" name="payment_status" style="width: 10.9rem;" onchange="this.form.submit();">
                  <option value="">Filter payment status</option>
                  @foreach(\App\Enums\Booking\PaymentStatusEnum::values() as $option)
                  <option <?php echo request()->query('payment_status') == $option ? 'selected' : '' ?>>{{ $option }}</option>
                  @endforeach
               </select>
               <select class="form-control rounded" name="booking_status" style="width: 10.9rem;" onchange="this.form.submit();">
                  <option value="">Filter booking status</option>
                  @foreach(\App\Enums\Booking\RequestStatusEnum::values() as $option)
                  <option <?php echo request()->query('booking_status') == $option ? 'selected' : '' ?>>{{ $option }}</option>
                  @endforeach
               </select>
      </form>
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
                <select name="payment_status" class="form-control w-75 py-0" form="{{ $booking->booking_id }}" onchange="this.form.submit();">
                  @foreach(\App\Enums\Booking\PaymentStatusEnum::values() as $option)
                  <option <?php echo $booking->payment_status?->value == $option ? 'selected' : '' ?>>{{ $option }}</option>
                  @endforeach
                </select>
              </td>
              <td data-cell="Status">
                <select name="request_status" class="form-control w-75 py-0" form="{{ $booking->booking_id }}" onchange="this.form.submit();">
                  @foreach(\App\Enums\Booking\RequestStatusEnum::values() as $option)
                  <option <?php echo $booking->request_status?->value == $option ? 'selected' : '' ?>>{{ $option }}</option>
                  @endforeach
                </select>
              </td>
              <td data-cell="Additional Details">
                {{ $booking->additional_details }}
              </td>
              <form class="d-none" id="{{ $booking->booking_id }}" action="{{ route('bookings.update', $booking->id) }}" method="post">
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
@endsection('content')

@push('js')
<script src="{{ theme('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ theme('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@endpush('js')
