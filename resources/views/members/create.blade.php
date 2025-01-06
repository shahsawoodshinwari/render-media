@extends('layouts.app', ['title' => 'Members - Add'])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Add New Member') }}</h4>
        <a href="{{ route('members.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('members.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="row g-3">
          <!-- First Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name" class="form-label required">{{ __('First Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}" />
              @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Last Name -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name" class="form-label required">{{ __('Last Name') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}" />
              @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="email" class="form-label required">{{ __('Email ') }}</label>
              <input type="email" class="form-control input-default bg-transparent @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" />
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Phone -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone" class="form-label required">{{ __('Phone') }}</label>
              <input type="text" class="form-control input-default bg-transparent @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('Phone') }}" />
              @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Gender -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="gender" class="form-label required">{{ __('Gender') }}</label>
              <select class="form-control input-default bg-transparent @error('gender') is-invalid @enderror" name="gender" id="gender">
                <option value="">{{ __('Select Gender') }}</option>
                @foreach(\App\Enums\GenderEnum::cases() as $gender)
                <option <?php echo old('gender') == $gender->value ? 'selected' : ''; ?> value="{{ $gender->value }}">{{ $gender->value }}</option>
                @endforeach
              </select>
              @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Date of Birth -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="dob" class="form-label required">{{ __('Date of Birth') }}</label>
              <input type="date" class="form-control input-default bg-transparent @error('dob') is-invalid @enderror" name="dob" id="dob" value="{{ old('dob') }}" />
              @error('dob')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Password -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="password" class="form-label required">{{ __('Password') }}</label>
              <div class="position-relative">
                <input type="password" class="form-control input-default bg-transparent @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('Password') }}" />
                <i class="icon-eye position-absolute top-50 end-0 translate-middle-y text-white pr-3" id="togglePassword"></i>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="password_confirmation" class="form-label required">{{ __('Confirm Password') }}</label>
              <input type="password" class="form-control input-default bg-transparent" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Password Confirmation') }}" />
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