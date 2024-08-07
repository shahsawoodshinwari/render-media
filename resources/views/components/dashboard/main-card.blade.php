@props([
  'title',
  'count',
  'date',
  'icon',
  'gradient',
  'url' => '#'
])

<div class="col-lg-4 col-md-6">
  <a class="card {{ $gradient }}" href="{{ $url }}">
    <div class="card-body">
      <h3 class="card-title text-white">{{ $title }}</h3>
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-inline-block">
          <h2 class="text-white">{{ $count }}</h2>
        </div>
        <div class="display-5 opacity-5"><i class="{{ $icon }}"></i></div>
      </div>
      <p class="text-white mb-0">{{ $date }}</p>
    </div>
  </a>
</div>