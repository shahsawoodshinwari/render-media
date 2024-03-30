<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\CMS\Page;
use App\Enums\CMS\PageEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\PageResource;

class PageController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(PageEnum $page)
  {
    $page = Page::whereName($page->value)->latest()->published()->first();

    return response()->json(
      $page ? PageResource::make($page)->response()->getData(true) : ['data' => null]
    );
  }
}
