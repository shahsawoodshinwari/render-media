<?php

namespace App\Observers\CMS;

use App\Models\CMS\Page;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class PageObserver implements ShouldHandleEventsAfterCommit
{
  /**
   * Handle the Page "created" event.
   */
  public function created(Page $page): void
  {
    if ($page->published) {
      Page::whereName($page->name)->published()->update(['published' => false]);
    }
  }

  /**
   * Handle the Page "updated" event.
   */
  public function updated(Page $page): void
  {
    if ($page->published) {
      Page::whereName($page->name)->published()->update(['published' => false]);
    }
  }

  /**
   * Handle the Page "deleting" event.
   */
  public function deleting(Page $page): void
  {
    if ($page->published) {
      Page::whereName($page->name)->limit(1)
        ->inRandomOrder()
        ->update(['published' => false]);
    }
  }

  /**
   * Handle the Page "restored" event.
   */
  public function restored(Page $page): void
  {
    if ($page->published) {
      Page::whereName($page->name)->published()->update(['published' => false]);
    }
  }

  /**
   * Handle the Page "force deleting" event.
   */
  public function forceDeleting(Page $page): void
  {
    if ($page->published) {
      Page::whereName($page->name)->limit(1)
        ->inRandomOrder()
        ->update(['published' => false]);
    }
  }
}
