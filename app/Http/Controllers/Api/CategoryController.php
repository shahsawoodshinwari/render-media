<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::latest()
      ->whereNull('parent_id')
      ->with(['children', 'cover']);

    $categories = $this->shouldPaginate ? $categories->paginate() : $categories->get();

    return response()->json(CategoryResource::collection($categories)->response()->getData(true));
  }
}
