<?php

namespace App\Http\Controllers\Api\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $termsAndConditions = TermsAndConditions::latest()->get();
  }
}
