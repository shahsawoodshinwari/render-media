<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFreelancerRequest;

class FreelancerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $freelancers = Freelancer::latest('id')->get();

    return view('freelancers.index', compact('freelancers'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $specialities = Category::whereNotNull('parent_id')->get();
    return view('freelancers.create', compact('specialities'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreFreelancerRequest $request)
  {
    Freelancer::create($request->validated());

    return redirect()->route('freelancers.index')->with('success', 'Freelancer created.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Freelancer $freelancer)
  {
    return view('freelancers.show', compact('freelancer'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Freelancer $freelancer)
  {
    return view('freelancers.edit', compact('freelancer'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Freelancer $freelancer)
  {
    return redirect()->route('freelancers.index')->with('success', 'Freelancer updated.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Freelancer $freelancer)
  {
    return redirect()->route('freelancers.index')->with('success', 'Freelancer deleted.');
  }
}
