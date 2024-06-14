@extends('layouts.app', ['title' => 'Categories - Edit'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Edit Category') }}</h4>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('categories.update', $category->slug) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row justify-content-center g-3">
          <!-- Category Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="form-label required">{{ __('Category Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $category->name) }}" autofocus placeholder="{{ __('Category Name') }}" />
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Cover -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="cover" class="form-label required">{{ __('Cover') }}</label>
              <input type="file" class="form-control input-default bg-transparent @error('cover') is-invalid @enderror" accept="image/*" name="cover" id="cover" />
              @error('cover')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Cover Preview -->
          <div class="col-md-6">
             <div class="text-center mb-3">
               <img src="{{ $category->cover?->getUrl() }}" id="cover-preview" height="100px" class="img-fluid" alt="Cover Preview">
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
    document.getElementById('cover').addEventListener('change', function() {
      const file = this.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('cover-preview').src = e.target.result;
        document.getElementById('cover-preview').classList.remove('d-none');
      };
      reader.readAsDataURL(file);
    });
  });
</script>
@endpush('js')