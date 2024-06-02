<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Carbon;

class DashboardStatisticsService
{
  /**
   * Get the statistics for members
   */
  public static function members(): object
  {
    $membersCreatedFromTo = Member::selectRaw('MIN(created_at) as min, MAX(created_at) as max')->first();
    $fromDate = Carbon::parse($membersCreatedFromTo->min)->startOfMonth();
    $toDate = Carbon::parse($membersCreatedFromTo->max)->endOfMonth();

    if ($fromDate->year == $toDate->year && $fromDate->month == $toDate->month) {
      $fromDate->startOfDay();
      $toDate->endOfDay();
    }

    return (object) [
      'count' => Member::count(),
      'date' => $fromDate->format('M Y') . ' to ' . $toDate->format('M d, Y'),
    ];
  }
}
