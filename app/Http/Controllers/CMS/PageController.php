<?php

namespace App\Http\Controllers\CMS;

use App\Models\CMS\Page;
use App\Enums\CMS\PageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Str;

class PageController extends Controller
{
  public function show(PageEnum $page)
  {
    $pageEnum = $page;
    Page::whereName($pageEnum->value)->update(['published' => 1]);

    $page = Page::firstOrNew(['name' => $pageEnum->value], [
      'contents' => '',
    ]);

    $title = Str::of($page->name)->title()->replace('-', ' ');

    return response()->view('cms.pages.show', compact('page', 'title'));
  }

  public function update(UpdatePageRequest $request, PageEnum $page)
  {
    $page = Page::updateOrCreate(['name' => $page->value], ['contents' => $request->contents]);

    return redirect()->back()->with('success', 'Page updated.');
  }
}
