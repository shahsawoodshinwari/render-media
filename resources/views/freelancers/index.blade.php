@extends('layouts.app', ['title' => 'Freelancers - List'])

@push('css')
<link href="{{ theme('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
.sweet-alert.showSweetAlert.visible {
  filter: invert(0.8);
}
</style>
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
                <form action="{{ route('freelancers.status', $freelancer) }}" method="POST">
                  @csrf
                  <select style="width: 80%;" class="form-control input-default bg-transparent text-white" name="status" required aria-labelledby="status-cell" onchange="this.form.submit()">
                    <option value="">{{ __('Select Status') }}</option>
                    @foreach (\App\Enums\Freelancer\StatusEnum::values() as $status)
                    <option <?php echo $freelancer->status->value == $status ? 'selected' : ''; ?>>{{ $status }}</option>
                    @endforeach
                  </select>
                </form>
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