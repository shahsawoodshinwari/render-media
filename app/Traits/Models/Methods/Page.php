<?php

namespace App\Traits\Models\Methods;

use App\Enums\CMS\PageEnum;

trait Page
{
  /**
   * Fix the published pages
   */
  public static function fix(string|PageEnum $page): bool
  {
    if ($page instanceof PageEnum) {
      $page = $page->value;
    }

    if (static::wherename($page)->published()->count() === 0) {
      return static::wherename($page)
        ->inRandomOrder()
        ->limit(1)
        ->update(['published' => true]);
    }

    return false;
  }
}
