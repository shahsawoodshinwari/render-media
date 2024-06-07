@props([
  'title',
  'count',
  'date',
  'icon',
  'gradient'
])

<div class="col-lg-3 col-sm-6">
  <div class="card {{ $gradient }}">
    <div class="card-body">
      <h3 class="card-title text-white">{{ __('Members') }}</h3>
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-inline-block">
          <h2 class="text-white">{{ $count }}</h2>
        </div>
        <div class="display-5 opacity-5"><i class="fa fa-shopping-cart"></i></div>
      </div>
      <p class="text-white mb-0">{{ $date }}</p>
    </div>
  </div>
</div>