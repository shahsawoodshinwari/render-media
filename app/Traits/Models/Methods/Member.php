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
}
