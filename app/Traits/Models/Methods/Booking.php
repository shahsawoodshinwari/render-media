<?php

namespace App\Traits\Models\Methods;

trait Booking
{
  /**
   * Indicates if the booking is upcoming.
   */
  public function upcoming(): bool
  {
    return $this->date->format('Y-m-d') === now()->addDay()->format('Y-m-d');
  }

  /**
   * Indicates if the booking is ongoing.
   */
  public function ongoing(): bool
  {
    return $this->date->format('Y-m-d') === now()->format('Y-m-d');
  }

  /**
   * Indicates if the booking is completed.
   */
  public function completed(): bool
  {
    return $this->date->format('Y-m-d') < now()->format('Y-m-d');
  }
}
