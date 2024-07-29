<?php

namespace App\Traits\Models\BelongsTo;

use App\Models\Member;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Ticket
{
  /**
   * Get the member that owns the Booking
   */
  public function member(): BelongsTo
  {
    return $this->belongsTo(Member::class);
  }
}
