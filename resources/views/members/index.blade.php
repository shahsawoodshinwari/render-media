@extends('layouts.app', ['title' => 'Members - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Verified</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $member)
            <tr>
              <td>
                <img src="{{ $member->avatar?->getUrl() ?? asset('assets/members/avatar.png') }}" class="rounded-circle mr-3" width="30" alt="{{ $member->name }} {{ __('Profile Picture') }}">
                {{ $member->name }}
              </td>
              <td>{{ $member->email }}</td>
              <td>{{ $member->phone }}</td>
              <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $member->deleted_at ? 'Deleted' : 'Active' }}">
                <i class="fa fa-<?php echo $member->deleted_at ? 'times-circle text-danger' : 'check-circle text-success'; ?>"></i>
              </td>
              <td>
                <i class="fa fa-<?php echo $member->email_verified_at ? 'check-circle text-success' : 'times-circle text-danger'; ?>"></i>
              </td>
              <td>---</td>
            </tr>
            @endforeach
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Verified</th>
              <th>Actions</th>
            </tr>
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