<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\CMS\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\FAQResource;

class FAQController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $faqs = FAQ::latest();
    $faqs = $this->shouldPaginate ? $faqs->paginate() : $faqs->get();

    return response()->json(
      FAQResource::collection($faqs)
        ->response()
        ->getData(true)
    );
  }
}
