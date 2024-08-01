<x-tickets.layout>
  <style>
    .rounded-3 {
      border-radius: 0.75rem !important;
    }

    .sent {
      border-bottom-left-radius: 0 !important;
      background-color: var(--secondary);
      width: fit-content;
      color: white;
    }

    .received {
      border-bottom-right-radius: 0 !important;
      background-color: var(--darkreader-neutral-text);
      width: fit-content;
    }
  </style>
  <div class="bg-white">
    <div class="d-flex justify-content-between align-items-center gap-3">
      <h4>{{ __('Ticket Details') }}</h4>
      <div class="label label-{{ $ticket->status == \App\Enums\TicketStatusEnum::OPEN ? 'primary' : 'warning' }}">
        {{ $ticket->status }}
      </div>
    </div>
    <hr />
  </div>
  <h5>{{ $ticket->title }}</h5>
  <p class="text-muted">{{ $ticket->description }}</p>
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
    <span>
      <b>Created: </b>{{ $ticket->created_at->format('F j, Y, g:i A') }}
    </span>
    @if($ticket->status == \App\Enums\TicketStatusEnum::CLOSED && $ticket->closed_at)
    <span>
      <b>Closed: </b>{{ $ticket->closed_at->format('F j, Y, g:i A') }}
    </span>
    @endif
  </div>
  @if($ticket->status == \App\Enums\TicketStatusEnum::OPEN)
  <hr />
  <form action="{{ route('tickets.update', $ticket) }}" method="post">
    @csrf
    @method('put')
    <p class="rounded border px-3 py-2 bg-light">
      <b>Note: </b>
      {{ __('Submitting this form will close the ticket.') }}
    </p>
    <div class="form-group">
      <label for="message" class="form-label">{{ __('Message') }}</label>
      <textarea class="form-control input-default bg-transparent @error('message') is-invalid @enderror" name="message"
        id="message" rows="3" required placeholder="{{ __('Your feedback goes here') }}">{{ old('message') }}</textarea>
    </div>
    <div class="text-right">
      <button type="submit" class="btn btn-danger">{{ __('Submit') }}</button>
    </div>
  </form>
  @endif
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
</x-tickets.layout>