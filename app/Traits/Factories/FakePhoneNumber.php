<?php

namespace App\Traits\Factories;

trait FakePhoneNumber
{
  /**
   * Generate a fake phone number for UAE.
   */
  public function phoneNumber(): string
  {
    return fake()->numerify('50#######');
  }
}
