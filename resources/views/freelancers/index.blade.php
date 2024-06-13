@extends('layouts.app', ['title' => 'Freelancers - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ __('Freelancers') }}</h4>
        <a href="{{ route('freelancers.create') }}" class="btn btn-primary">{{ __('Add New Freelancer') }}</a>
      </div>
      <div class="table-responsive no-padding">
        <table class="table table-striped table-bordered zero-configuration text-center">
          <thead>
            @include('freelancers.headers')
          </thead>
          <tbody>
            @foreach ($freelancers as $freelancer)
            <tr>
              <td data-cell="id">{{ $freelancer->id }}</td>
              <td data-cell="name">{{ $freelancer->name }}</td>
              <td data-cell="speciality" class="text-nowrap">{{ $freelancer->speciality }}</td>
              <td data-cell="experience" class="text-nowrap">{{ $freelancer->experience }}</td>
              <td data-cell="phone">{{ $freelancer->phone }}</td>
              <td data-cell="status">
                <div class="dropdown">
                  <button class="btn btn-sm btn-<?php echo match ($freelancer->status->value) {
                    'Active' => 'success',
                    'Inactive' => 'warning',
                    'Suspended' => 'danger',
                    'Pending' => 'info',
                    default => 'secondary'
                  }; ?>" data-toggle="dropdown" aria-expanded="false">
                    <option value="">{{ $freelancer->status }}</option>
                  </button>
                  <form action="{{ route('freelancers.status', $freelancer) }}" method="post" class="dropdown-menu">
                    @csrf
                    @foreach (\App\Enums\Freelancer\StatusEnum::values() as $status)
                    @if ($freelancer->status->value != $status)
                    <input type="submit" class="dropdown-item" name="status" value="{{ $status }}">
                    @endif
                    @endforeach
                  </form>
                </div>
              </td>
              <td data-cell="portfolio">
                <a href="{{ $freelancer->portfolio }}" class="btn btn-sm btn-primary" target="_blank">{{ __('View Portfolio') }}</a>
              </td>
              <td>
                @include('freelancers.actions')
              </td>
            </tr>
            @endforeach
          <tfoot>
            @include('freelancers.headers')
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