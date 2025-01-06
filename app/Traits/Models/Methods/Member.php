<?php

namespace App\Traits\Models\Methods;

use Illuminate\Support\Str;

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

  /**
   * Upload Random Avatar
   */
  public function uploadRandomAvatar(): bool
  {
    try {
      $imageId = fake()->numberBetween(1, 78);
      return $this->addMediaFromUrl(
        'https://xsgames.co/randomusers/assets/avatars/' . Str::of($this->gender)->lower() . "/$imageId.jpg"
      )->toMediaCollection($this::AVATAR) ? true : false;
    } catch (\Exception $e) {
      return false;
    }
  }
}
