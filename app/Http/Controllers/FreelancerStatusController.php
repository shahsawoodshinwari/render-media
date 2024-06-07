<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Enums\Freelancer\StatusEnum;

class FreelancerStatusController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request, Freelancer $freelancer)
  {
    // Validate request
    $request->validate([
      'status' => ['required', 'string', Rule::in(StatusEnum::values())],
    ]);

    // Update status
    $freelancer->updateStatus($request->status);

    // Redirect back to the same page
    return redirect()->back()->with('success', 'Freelancer status updated.');
  }
}
