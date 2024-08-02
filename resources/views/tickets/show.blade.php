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

    .min-w-126px {
      min-width: 126px;
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
  <hr />
  <form class="mb-3" action="{{ route('tickets.update', $ticket) }}" method="post">
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
    <div class="row justify-content-end px-3" style="gap: 5px">
      @if ($ticket->member)
      <a href="{{ route('members.show', $ticket->member) }}" class="btn btn-secondary min-w-126px">
        {{ __('User Details') }}
      </a>
      @endif
      <div class="col-auto px-0">
        <button type="button" class="btn min-w-126px btn-success refresh-chats d-flex gap-3 align-items-center">
          <div>{{ __('Refresh Chats') }}</div>
          <img src="{{ asset('assets/tickets/loading.gif') }}" alt="" style="display: none;width: 16px;">
        </button>
      </div>
      @if($ticket->status == \App\Enums\TicketStatusEnum::OPEN)
      <div class="col-auto px-0">
        <a href="{{ route('tickets.close', $ticket) }}" class="btn min-w-126px btn-secondary">{{ __('Close Ticket')
          }}</a>
      </div>
      @endif
      <div class="col-auto px-0">
        <button type="submit" class="btn min-w-126px btn-primary">{{ __('Submit') }}</button>
      </div>
    </div>
  </form>
  <div class="chats">
    <x-tickets.chats :ticket="$ticket" />
  </div>
  @push('js')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('.refresh-chats').addEventListener('click', function (e) {
        $('.refresh-chats').prop('disabled', true);
        $('.refresh-chats img').show();

        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          url: "{{ route('tickets.replies', $ticket) }}",
          data: {},
          success: function (data) {
            // console.log(data);
            $('.chats').html(data);
            $('.refresh-chats').prop('disabled', false);
            $('.refresh-chats img').hide();
          },
          error: function (data) {
            console.log(data);
            $('.refresh-chats').prop('disabled', false);
            $('.refresh-chats img').hide();
          }
        });
      });
    });
  </script>
  @endpush
</x-tickets.layout>