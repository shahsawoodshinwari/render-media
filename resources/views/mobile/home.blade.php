@extends('layouts.mobile.app')

@section('content')
  <div class="text-center">
    <h2>Are You Looking For ?</h2>
  </div>
  <div class="text-center fs-14px fw-400 mb-3">
    <p class="mb-0">Are you looking for the key to unlock your next opportunity?</p>
  </div>
  @php($categories = \App\Models\Category::whereNull('parent_id')->with(['cover'])->latest()->get())
  <div class="row g-3">
    @foreach($categories as $category)
    <div class="{{ $loop->last ? 'col-12' : 'col-6' }}">
      <div class="text-center">
        <div>
          <img src="{{ optional($category->cover)->getUrl() }}" class="img-fluid w-100 rounded-4 mb-1"
            alt="{{ $category->name }}" loading="lazy" />
        </div>
        <div class="fs-14px fw-400">{{ $category->name }}</div>
      </div>
    </div>
    @endforeach
  </div>
@endsection
