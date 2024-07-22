@extends('layouts.app', ['title' => 'Categories - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ __('Categories') }}</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">{{ __('Add New Category') }}</a>
      </div>
      <div class="table-responsive no-padding">
        <table class="table table-striped table-bordered zero-configuration text-center">
          <thead>
            @include('categories.headers')
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
              <td data-cell="id">{{ $category->id }}</td>
              <td data-cell="cover">
                <img src="{{ $category->cover?->getUrl() }}" width="50px" class="" alt="{{ $category->name }}">
              </td>
              <td data-cell="category" class="text-nowrap">{{ $category->name }}</td>
              <td data-cell="slug">{{ $category->slug }}</td>
              <td data-cell="sub categories" class="text-nowrap">
                <a href="{{ route('categories.sub-categories.index', $category->slug) }}">{{ $category->number_of_sub_categories }}</a>
              </td>
              <td>
                @include('categories.actions')
              </td>
            </tr>
            @endforeach
          <tfoot>
            @include('categories.headers')
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