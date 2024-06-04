@extends('layouts.app', ['title' => __('Freelancers - Add')])

@push('css')
<link rel="stylesheet" href="{{ theme('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ theme('css/select2-bootstrap4.min.css') }}">
<style>
  .select2-container--bootstrap4 .select2-selection {
    background-color: transparent !important;
    min-height: 45px;
  }

  .select2-dropdown {
    background-color: #27394F;
  }

  .select2-search--dropdown .select2-search__field {
    background-color: transparent !important;
    color: white !important;
  }

  .form-group:has([for="speciality"]) *:focus {
    box-shadow: none !important;
  }

  .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
    color: white !important;
    padding-block-start: 6px;
  }

  input[type="number"]::-webkit-outer-spin-button,
  input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Hide spinner buttons in Firefox */
  input[type="number"] {
    -moz-appearance: textfield;
  }


  /* Remove the white background color from the select options */
  select {
    background-color: transparent !important;
  }

  select option {
    background-color: transparent !important;
  }

  /* Ensure the text color remains visible */
  select {
    color: inherit !important;
  }

  select option {
    color: inherit !important;
  }
</style>
@endpush('css')

@push('js')
<script src="{{ theme('js/select2.min.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    $('.select2').select2({
      theme: 'bootstrap4',
    });

    document.querySelector('input[name="phone"]').addEventListener('blur', (event) => {
      var phoneInput = document.querySelector('input[name="phone"]');
      var phoneInputParent = document.querySelector('input[name="phone"]').parentElement;

      var phoneNumber = phoneInput.value.trim();
      var uaePhonePattern = /^(?:50|52|54|55|56|58|2|3|4|6|7|9)\d{7}$/;
      var errorShown = false;

      if (!uaePhonePattern.test(phoneNumber) && !errorShown && phoneNumber.length > 0) {
        const errorContainer = document.createElement('div');
        phoneInput.classList.add('is-invalid');
        errorContainer.classList.add('text-danger');
        errorContainer.textContent = "{{ __('Please enter a valid phone number. Example: 501234567') }}";
        phoneInputParent.appendChild(errorContainer);
        errorShown = true;
      } else {
        phoneInput.classList.remove('is-invalid');
        phoneInputParent.querySelector('.text-danger').remove();
        errorShown = false;
      }
    });
  });
</script>
@endpush('js')

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Add New Freelancer') }}</h4>
        <a href="{{ route('freelancers.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('freelancers.store') }}" method="post" autocomplete="off">
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

          <!-- Speciality -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="speciality" class="form-label required">{{ __('Speciality ') }}</label>
              <select class="form-control select2 input-default bg-transparent text-white @error('speciality') is-invalid @enderror" name="speciality" id="speciality">
                <option value="">{{ __('Select Speciality') }}</option>
                @foreach($specialities as $speciality)
                <option <?php echo old('speciality') == $speciality->id ? 'selected' : ''; ?>>{{ $speciality->name }}</option>
                @endforeach
              </select>
              @error('speciality')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Experience -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="experience" class="form-label required">{{ __('Experience') }}</label>
              <input type="number" inputmode="numeric" min="0.1" class="form-control input-default bg-transparent text-white @error('experience') is-invalid @enderror" name="experience" id="experience" value="{{ old('experience') }}" placeholder="{{ __('Experience') }}" />
              @error('experience')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Phone -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone" class="form-label required">{{ __('Phone') }}</label>
              <input type="text" inputmode="numeric" class="form-control input-default bg-transparent text-white @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('Phone') }}" />
              @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Portfolio -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="portfolio" class="form-label required">{{ __('Portfolio') }}</label>
              <input type="url" class="form-control input-default bg-transparent text-white @error('portfolio') is-invalid @enderror" name="portfolio" id="portfolio" placeholder="{{ __('Portfolio') }}" />
              @error('portfolio')
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