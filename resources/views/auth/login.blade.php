@extends('layouts.auth')

@section('content')
<div class="login-form-bg h-100">
  <div class="container h-100">
    <div class="row justify-content-center h-100">
      <div class="col-xl-6">
        <div class="form-input-content">
          <div class="card login-form mb-0">
            <div class="card-body pt-5">
              <a class="text-center" href="{{ url('/') }}">
                <h4>{{ config('app.name') }}</h4>
              </a>

              <form class="mt-5 mb-5 login-input" method="POST">
                @csrf

                <!-- email -->
                <div class="form-group">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- password -->
                <div class="form-group">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                  @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- submit -->
                <button type="submit" class="btn login-form__btn submit w-100">{{ __('Login') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection('content')