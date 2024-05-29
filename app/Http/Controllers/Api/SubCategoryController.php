<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class SubCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::latest()
      ->whereNotNull('parent_id');

    $categories = $this->shouldPaginate ? $categories->paginate() : $categories->get();

    return response()->json(CategoryResource::collection($categories)->response()->getData(true));
  }
}
