@extends('layouts.app', ['title' => $title])

@push('css')
<link href="{{ theme('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush('css')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="row">
    <div class="col-12">
      <form class="card" action="{{ route('cms.pages.update', $page->name) }}" method="POST">
        @csrf
        @method('PUT')
        <h4 class="card-header pt-4">{{ $title }}</h4>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <textarea name="contents" placeholder="{{ __('Enter content here...') }}" class="summernote">
            {!! old('contents', $page->contents) !!}
          </textarea>

          <button class="btn btn-primary mt-3" type="submit">{{ __('Save') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection('content')

@push('js')
<script src="{{ theme('plugins/summernote/dist/summernote.min.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    $(".summernote").summernote({
      height: 350,
      minHeight: null,
      maxHeight: null,
      focus: !1
    });
  });
</script>
@endpush('js')