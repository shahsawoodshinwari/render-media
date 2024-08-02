@if($ticket->replies->isNotEmpty())
<div class="row g-3 mt-3 py-3 rounded" style="background-color: beige;gap: 5px;">
  @foreach($ticket->replies as $reply)
  @if($reply->author->is(auth()->user()))
  <x-tickets.message-sent :reply="$reply" />
  @else
  <x-tickets.message-received :reply="$reply" />
  @endif
  @endforeach
</div>
@endif