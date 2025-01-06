<?php

namespace App\Http\Controllers\Api;

use App\Models\Freelancer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BecomeFreelancer;

class FreelanerController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(BecomeFreelancer $request)
  {
    Freelancer::create($request->validated());

    return response()->json([
      'message' => 'Thanks for your interest. Our team will get in touch with you shortly.',
    ]);
  }
}
