@extends("layouts.app", ["title" => _("FAQs - Edit")])

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title">{{ __('Edit FAQ') }}</h4>
        <a href="{{ route('cms.faqs.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
      </div>
      <form action="{{ route('cms.faqs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="row g-3">
          <!-- Question -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="question" class="form-label required">{{ __('Question') }}</label>
              <textarea class="form-control input-default bg-transparent @error('question') is-invalid @enderror" name="question" id="question" placeholder="{{ __('Question') }}">{{ old('question', $faq->question) }}</textarea>
              @error('question')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Answer -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="answer" class="form-label required">{{ __('Answer') }}</label>
              <textarea class="form-control input-default bg-transparent @error('answer') is-invalid @enderror" name="answer" id="answer" placeholder="{{ __('Answer') }}">{{ old('answer', $faq->answer) }}</textarea>
              @error('answer')
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