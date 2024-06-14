<?php

namespace App\Http\Controllers\CMS;

use App\Models\CMS\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\FaqRequest;

class FAQController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $faqs = FAQ::latest()->get();

    return view('cms.faqs.index', compact('faqs'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('cms.faqs.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(FaqRequest $request)
  {
    FAQ::create($request->validated());

    return redirect()->route('cms.faqs.index')->with('success', __('FAQ created successfully'));
  }

  /**
   * Display the specified resource.
   */
  public function show(FAQ $faq)
  {
    return view('cms.faqs.show', compact('faq'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(FAQ $faq)
  {
    return view('cms.faqs.edit', compact('faq'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(FaqRequest $request, FAQ $faq)
  {
    $faq->update($request->validated());
    
    return redirect()->route('cms.faqs.index')->with('success', __('FAQ updated successfully'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(FAQ $faq)
  {
    $faq->delete();

    return redirect()->route('cms.faqs.index')->with('success', __('FAQ deleted successfully'));
  }
}
