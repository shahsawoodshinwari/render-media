<?php

namespace App\Traits\Models\Methods;

trait Category
{
  /**
   * Upload cover image to the media collection.
   */
  public function uploadCover(): void
  {
    $this->addMedia(storage_path('data/categories/cover.png'))
      ->preservingOriginal()
      ->toMediaCollection(self::COVER);
  }
}
