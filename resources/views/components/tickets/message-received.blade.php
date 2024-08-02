@props(['reply'])
<div class="col-12 col-md-7 ml-auto text-right">
  <div class="received ml-auto rounded-3 px-3 py-2">
    {{ $reply->content }}
  </div>
  <div class="text-right">
    <small>
      <b>{{ $reply->author->name }}</b>
      {{ $reply->created_at->format('g:i A') }}
    </small>
  </div>
</div>