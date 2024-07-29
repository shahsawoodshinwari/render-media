@extends('layouts.app', ['title' => 'Contact Us - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ __('Contact Us') }}</h4>
      </div>
      <div class="table-responsive no-padding">
        <table class="table table-striped table-bordered zero-configuration text-center">
          <thead>
            @include('contact-us.headers')
          </thead>
          <tbody>
            @foreach ($requests as $request)
            <tr>
              <td data-cell="ID">RM#{{ str_pad($request->id, 3, '0', STR_PAD_LEFT) }}</td>
              <td data-cell="Name">{{ $request->first_name . ' ' . $request->last_name }}</td>
              <td data-cell="Email">{{ $request->email }}</td>
              <td data-cell="Phone">{{ $request->phone }}</td>
              <td data-cell="Reason">{{ $request->reason }}</td>
              <td data-cell="Date Submitted">{{ $request->created_at->format('d M, Y') }}</td>
            </tr>
            @endforeach
          <tfoot>
            @include('contact-us.headers')
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
