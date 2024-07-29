@extends('layouts.app')

@push('css')
<style>
  .cursor-pointer {
    cursor: pointer;
  }

  .ticket-member {
    transition: 0.5s
  }

  .ticket-member:hover {
    background-color: rgba(0, 0, 0, 0.05);
  }

  .overflow-y-auto {
    overflow-y: auto;
  }

  .tickets-member-row .overflow-y-auto {
    max-height: calc(100vh - 200px);
  }

  .min-w-58px {
    min-width: 58px;
  }
</style>
@endpush

@section('content')
<div class="container-fluid" style="padding-top: 30px;padding-bottom: 30px">
  <div class="card h-100">
    <div class="card-body">
      <div class="row g-3 tickets-member-row">
        @if($members->isNotEmpty())
        <div class="col-md-4 overflow-y-auto mb-3 mb-md-0">
          @foreach ($members as $member)
          <a href="{{ route('tickets.index', ['member' => $member->id]) }}" data-member="{{ $member->id }}">
            <div @class([ 'd-flex' , 'rounded' , 'px-1' , 'ticket-member' , 'cursor-pointer' , 'align-items-center'
              , 'bg-info'=> $member->id == request('member')
              , 'mb-3'=>
              !$loop->last
              ])>
              <div>
                <img src="{{ $member->avatar?->getUrl() }}" width="40" class="rounded-circle" height="40"
                  data-fallback-image="{{ asset('assets/members/avatar.png') }}"
                  onerror="this.src=this.dataset.fallbackImage" alt="">
              </div>
              <h5 class="mb-0 mx-3">{{ $member->name }}</h5>
              <div class="ml-auto">
                <span
                  class="label <?php echo request()->get('member') == $member->id ? 'label-warning' : 'label-primary'; ?> min-w-58px d-flex align-items-center justify-content-between">
                  <span data-toggle="tooltip" title="Closed Tickets">{{ $member->number_of_closed_tickets > 9 ? '9+' :
                    $member->number_of_closed_tickets }}</span>
                  <span class="mx-1">|</span>
                  <span data-toggle="tooltip" title="Open Tickets">{{ $member->number_of_open_tickets > 9 ? '9+' :
                    $member->number_of_open_tickets }}</span>
                </span>
              </div>
            </div>
          </a>
          @endforeach
        </div>
        <div class="col-md-8 overflow-y-auto">
          {{ $slot }}
        </div>
        @else
        <div class="col-12">
          <div class="d-flex flex-column justify-content-center h-100">
            <h4 class="text-center mb-0">
              <img src="{{ asset('assets/tickets/no-member-selected.png') }}" class="img-fluid" width="200"
                alt="No Member Selected">
              <br />
              {{ __('Woho! There are no tickets created yet.') }}
            </h4>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
