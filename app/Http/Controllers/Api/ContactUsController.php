<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;

class ContactUsController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(ContactUsRequest $request)
  {
    $request->user()->contactForms()->create($request->validated());

    return response()->json([
      'message' => 'Thanks for your feedback. We will get in touch with you shortly.',
    ], 201);
  }
}
