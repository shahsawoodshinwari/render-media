@props(['reply'])
<div class="col-9 col-md-7 mr-auto text-start">
  <div style="position: relative;width: fit-content">
    <div class="sent mr-auto rounded-3 px-3 py-2">
      {{ $reply->content }}
    </div>
    <div class="ml-auto" style="width: fit-content;position: absolute;bottom: 0; right: 0">
      <small>
        <b>{{ __('You') }}</b>
        {{ $reply->created_at->format('g:i A') }}
      </small>
    </div>
    <div style="visibility: hidden">
      <small>
        <b>{{ __('You') }}</b>
        {{ $reply->created_at->format('g:i A') }}
      </small>
    </div>
  </div>
</div>