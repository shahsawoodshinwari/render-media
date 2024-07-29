<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait Ticket
{
  public function scopeFilterByTab($builder, mixed $tab = null): Builder
  {
    if (in_array(strtolower($tab), [null, 'all'])) {
      return $builder;
    } elseif (strtolower($tab) == 'open') {
      return $builder->where('status', \App\Enums\TicketStatusEnum::OPEN->value);
    } else {
      return $builder->where('status', \App\Enums\TicketStatusEnum::CLOSED->value);
    }
  }
}
