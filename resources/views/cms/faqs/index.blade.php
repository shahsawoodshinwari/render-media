@extends("layouts.app", ["title" => _("FAQs - List")])

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
        <h4 class="card-title">{{ __('FAQs') }}</h4>
        <a href="{{ route('cms.faqs.create') }}" class="btn btn-primary">{{ __('Add New FAQ') }}</a>
      </div>
      <div class="table-responsive no-padding">
        <table class="table table-striped table-bordered zero-configuration text-center">
          <thead>
            @include('cms.faqs.headers')
          </thead>
          <tbody>
            @foreach ($faqs as $faq)
            <tr>
              <td>
                {{ $faq->id }}
              </td>
              <td>
                {{ $faq->question }}
              </td>
              <td>{{ $faq->answer }}</td>
              <td>
                @include('cms.faqs.actions')
              </td>
            </tr>
            @endforeach
          <tfoot>
            @include('cms.faqs.headers')
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