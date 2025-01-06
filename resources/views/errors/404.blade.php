@extends('layouts.auth')

@push('css')
<style>
  .footer {
    padding-left: unset !important;
  }
</style>
@endpush('css')

@section('content')
<div class="login-form-bg h-100">
  <div class="container h-100">
    <div class="row justify-content-center h-100">
      <div class="col-xl-6">
        <div class="error-content">
          <div class="card mb-0">
            <div class="card-body text-center pt-5">
              <h1 class="error-text text-primary">404</h1>
              <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> {{ __('Bad Request') }}</h4>
              <p>{{ __('Your Request resulted in an error.') }}</p>
              <form class="mt-5 mb-5">
                <div class="text-center mb-4 mt-4">
                  <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Go to Homepage') }}</a>
                </div>
              </form>
              <div class="text-center">
                <x-footer />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection('content')