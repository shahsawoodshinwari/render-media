<?php

namespace App\Traits\Models\HasMany;

use App\Models\Ticket;
use App\Models\Booking;
use App\Models\ContactUs;
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

  /**
   * Get all of the member's contact form submissions.
   */
  public function contactForms(): HasMany
  {
    return $this->hasMany(ContactUs::class);
  }

  /**
   * Get all of the member's tickets.
   */
  public function tickets(): HasMany
  {
    return $this->hasMany(Ticket::class);
  }
}
