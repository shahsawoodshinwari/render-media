<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\CMS\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\AboutUsResource;

class AboutUsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $aboutUs = AboutUs::latest()->published()->first();

    return response()->json(
      AboutUsResource::make($aboutUs)
        ->response()
        ->getData(true)
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(AboutUs $aboutUs)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, AboutUs $aboutUs)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(AboutUs $aboutUs)
  {
    //
  }
}
