<?php

namespace App\Traits\Models\Methods;

trait Member
{
  /**
   * Create a personal access token
   */
  public function createPersonalAccessToken(
    string $name = 'Personal Access Token',
    array $abilities = ['*']
  ) {
    return $this->createToken($name, $abilities);
  }

  /**
   * Mark email as not verified
   */
  public function markEmailAsNotVerified(): void
  {
    $this->forceFill([
      'email_verified_at' => null,
    ])->save();
  }
}
