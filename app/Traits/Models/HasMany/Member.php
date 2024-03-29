<?php

namespace App\Traits\Models\HasMany;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Member
{
  /**
   * Get all of the member's bookings.
   */
  public function bookings(): HasMany
  {
    return $this->hasMany(Booking::class);
  }
}
