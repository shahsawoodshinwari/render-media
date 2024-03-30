<?php

namespace App\Http\Controllers\Api\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\TermsAndConditions;
use App\Http\Resources\CMS\TermsAndConditionsResource;

class TermsAndConditionsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $termsAndConditions = TermsAndConditions::latest();

    $termsAndConditions = $this->shouldPaginate ? $termsAndConditions->paginate() : $termsAndConditions->get();

    return response()->json(
      TermsAndConditionsResource::collection($termsAndConditions)
        ->response()
        ->getData(true)
    );
  }
}
