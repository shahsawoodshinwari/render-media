<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
  public function store(Request $request)
  {
    return redirect()->route('categories.index')->with('success', __('Category created successfully'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    $category->load(['children']);

    return view('categories.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    return redirect()->route('categories.index')->with('success', __('Category updated successfully'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    $category->delete();

    return redirect()->route('categories.index')->with('success', __('Category deleted successfully'));
  }
}
