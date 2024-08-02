<x-tickets.layout>
  @if($member)
  <ul class="nav nav-pills mb-3 align-items-center">
    <li class="nav-item mr-auto">
      <h4 class="mb-0">{{ __('Tickets') }}</h4>
    </li>
    <li class="nav-item text-center">
      <a href="{{ route('tickets.index', ['member' => $member->id, 'tab' => 'all']) }}" @class(['nav-link', 'active'=>
        in_array(request()->get('tab'), ['all', null])])>
        {{ __('All') }}
      </a>
    </li>
    <li class="nav-item text-center">
      <a href="{{ route('tickets.index', ['member' => $member->id, 'tab' => 'open']) }}" @class(['nav-link', 'active'=>
        request()->get('tab') == 'open'])>
        {{ __('Open') }}
      </a>
    </li>
    <li class="nav-item text-center">
      <a href="{{ route('tickets.index', ['member' => $member->id, 'tab' => 'closed']) }}"
        @class(['nav-link', 'active'=> request()->get('tab') == 'closed'])>
        {{ __('Closed') }}
      </a>
    </li>
  </ul>
  @forelse ($member->tickets as $item)
  <div @class(['alert', $item->status == \App\Enums\TicketStatusEnum::OPEN ? 'alert-primary' : 'alert-success'])
    role="alert">
    <h4 class="alert-heading">{{ $item->title }}</h4>
    <p>{{ $item->description }}</p>
    <hr>
    <div class="d-flex align-items-center gap-3">
      <div class="mr-auto">
        <b>Created: </b>{{ $item->created_at->format('F j, Y, g:i A') }}
      </div>
      @if ($item->status == \App\Enums\TicketStatusEnum::CLOSED && $item->closed_at)
      <div>
        <b>Closed: </b>{{ $item->closed_at->format('F j, Y, g:i A') }}
      </div>
      @endif
      <a href="{{ route('tickets.show', $item) }}" class="btn btn-sm btn-primary">
        {{ __('View') }}
      </a>
      @if ($item->status == \App\Enums\TicketStatusEnum::OPEN)
      <a href="{{ route('tickets.close', $item) }}" class="btn btn-sm btn-danger">
        {{ __('Close') }}
      </a>
      @endif
    </div>
  </div>
  @empty
  <x-tickets.empty />
  @endforelse
  @else
  <x-tickets.no-user-selected />
  @endif
</x-tickets.layout>