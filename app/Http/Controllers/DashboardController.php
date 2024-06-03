<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;
use App\Services\DashboardStatisticsService;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    // Get the latest 7 freelancers
    $freelancers = Freelancer::latest()->limit(7)->get();

    $statistics = (object) [
      'members' => DashboardStatisticsService::members(),
    ];

    return response()->view('dashboard', compact('freelancers', 'statistics'));
  }
}
