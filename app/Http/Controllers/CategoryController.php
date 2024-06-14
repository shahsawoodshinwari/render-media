<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::whereNull('parent_id')
      ->latest()
      ->with(['cover'])
      ->withCount('children as number_of_sub_categories')
      ->get();

    return view('categories.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('categories.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
    DB::transaction(function () use ($request) {
      $category = Category::create($request->validated());

      if ($request->file('cover')) {
        $category->addMediaFromRequest('cover')->toMediaCollection($category::COVER);
      }
    });

    return redirect()->route('categories.index')->with('success', __('Category created successfully'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    $category->load(['cover']);

    return view('categories.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, Category $category)
  {
    DB::transaction(function () use ($request, $category) {
      $category->update($request->validated());

      if ($request->file('cover')) {
        $category->addMediaFromRequest('cover')->toMediaCollection($category::COVER);
      }
    });

    return redirect()->route('categories.index')->with('success', __('Category updated successfully'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    DB::transaction(function () use ($category) {
      $category->children()->forceDelete();
      $category->forceDelete();
    });

    return redirect()->route('categories.index')->with('success', __('Category deleted successfully'));
  }
}
