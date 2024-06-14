@extends('layouts.app', ['title' => 'Sub Categories - Add'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Add New Sub Category') }}</h4>
        <a href="{{ route('categories.sub-categories.index', $category->slug) }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('categories.sub-categories.store', $category->slug) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center g-3">
          <!-- Category Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="form-label required">{{ __('Sub Category Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Category Name') }}" />
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Slug -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="slug" class="form-label required">{{ __('Slug') }}</label>
              <input type="text" readonly class="form-control readonly input-default bg-transparent @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" placeholder="{{ __('Slug') }}" />
              @error('slug')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text text-muted">{{ __('The “slug” is the URL-friendly version of the name. It can only contain lowercase letters, numbers, and hyphens. This will be automatically generated based on the name.') }}</div>
            </div>
          </div>

          <!-- Submit -->
          <div class="col-12">
            <div class="text-center">
              <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
              <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').addEventListener('input', function() {
      const slugInput = document.getElementById('slug');

      fetch('/generate-slug' + '?text=' + encodeURIComponent(this.value), {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json'
          },
        })
        .then(response => response.json())
        .then(data => {
          slugInput.value = data.slug;
        });
    });
  });
</script>
@endpush('js')