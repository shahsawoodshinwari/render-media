<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
    $latestSevenFreelancers = Freelancer::latest()->limit(7)->get();

    // Get the latest 4 members who have any bookings
    $latestFourMembers = Member::whereHas('bookings')->latest()->limit(4)->get();

    $statistics = (object) [
      'members' => DashboardStatisticsService::members(),
      'freelancers' => DashboardStatisticsService::freelancers(),
      'progressBars' => DashboardStatisticsService::membersAndFreelancersThisDuration($request->get('duration')),
      'chart' => DashboardStatisticsService::freelancersAndMembersChartData($request->get('duration')),
      'bookings' => DashboardStatisticsService::bookings(),
    ];

    return response()->view('dashboard', compact('latestSevenFreelancers', 'latestFourMembers', 'statistics'));
  }
}
