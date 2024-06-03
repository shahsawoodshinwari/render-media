@extends('layouts.app', ['title' => 'Members - Edit'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h4 class="card-title">{{ __('Edit Member Info') }}</h4>
                <a href="{{ route('members.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
              </div>
              <form action="{{ route('members.password.update', $member) }}" class="row g-3" method="post">
                @csrf
                @method('PUT')

                <div class="col-12">
                  <div class="form-group">
                    <label for="password" class="form-label required">{{ __('Password') }}</label>
                    <input type="password" class="form-control input-default bg-transparent text-white @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
                    <div class="form-text text-muted">
                      {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </div>
                    @error('password')
                    <span class="text-danger" role="alert">
                      {{ $message }}
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="password-confirm" class="form-label required">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control input-default bg-transparent text-white" name="password_confirmation" id="password-confirm" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" />
                  </div>
                </div>

                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection('content')