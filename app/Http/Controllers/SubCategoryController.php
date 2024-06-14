<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Category $category)
  {
    $subCategories = $category->children()->latest()->get();

    return view('categories.sub-categories.index', compact('subCategories', 'category'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Category $category)
  {
    return view('categories.sub-categories.create', compact('category'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreSubCategoryRequest $request, Category $category)
  {
    $category->children()->create($request->validated());

    return redirect()->route('categories.sub-categories.index', $category->slug)->with('success', __('Sub Category created successfully'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $subCategory)
  {
    return view('categories.sub-categories.edit', compact('subCategory'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateSubCategoryRequest $request, Category $subCategory)
  {
    $subCategory->update($request->validated());

    return redirect()->route(
      'categories.sub-categories.index',
      $subCategory->parent->slug
    )->with('success', __('Sub Category updated successfully'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $subCategory)
  {
    $subCategory->delete();

    return redirect()->back()->with('success', __('Sub Category deleted successfully'));
  }
}
