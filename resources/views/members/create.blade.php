@extends('layouts.app', ['title' => 'Members - Add'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Add New Member') }}</h4>
        <a href="{{ route('members.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('members.store') }}" method="post">
        @csrf
        <div class="row g-3">
          <!-- First Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name" class="form-label required">{{ __('First Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent text-white @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}" />
              @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <!-- Last Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name" class="form-label required">{{ __('Last Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent text-white @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}" />
              @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection