@extends('layouts.app', ['title' => 'Sub Categories - Edit'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Edit Sub Category') }}</h4>
        <a href="{{ route('categories.sub-categories.index', $subCategory->slug) }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('sub-categories.update', $subCategory->slug) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row justify-content-center g-3">
          <!-- Category Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="form-label required">{{ __('Category Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $subCategory->name) }}" autofocus placeholder="{{ __('Category Name') }}" />
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
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
