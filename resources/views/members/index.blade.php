@extends('layouts.app', ['title' => 'Members - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
  #DataTables_Table_0_filter input {
    border: 1px solid rgba(120, 130, 140, 0.13) !important;
    border-radius: 0.25rem !important;
  }
</style>
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ __('Members') }}</h4>
        <a href="{{ route('members.create') }}" class="btn btn-primary">{{ __('Add New Member') }}</a>
      </div>
      <div class="table-responsive no-padding">
        <table class="table table-striped table-bordered zero-configuration text-center">
          <thead>
            @include('members.headers')
          </thead>
          <tbody>
            @foreach ($members as $member)
            <tr>
              <td>
                <img src="{{ $member->avatar?->getUrl() ?? asset('assets/members/avatar.png') }}" class="rounded-circle" width="30" alt="{{ $member->name }} {{ __('Profile Picture') }}">
              </td>
              <td>
                <span>
                  {{ $member->name }}
                </span>
              </td>
              <td class="text-nowrap">{{ $member->email }}</td>
              <td class="text-nowrap">{{ $member->phone }}</td>
              <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __($member->deleted_at ? 'Deleted' : 'Active') }}">
                <i class="fa fa-<?php echo $member->deleted_at ? 'times-circle text-danger' : 'check-circle text-success'; ?>"></i>
              </td>
              <td>
                <i class="fa fa-<?php echo $member->hasVerifiedEmail() ? 'check-circle text-success' : 'times-circle text-danger'; ?>"></i>
              </td>
              <td>
                @include('members.actions')
              </td>
            </tr>
            @endforeach
          <tfoot>
            @include('members.headers')
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