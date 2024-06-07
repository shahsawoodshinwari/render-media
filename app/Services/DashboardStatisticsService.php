<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Member;
use App\Models\Freelancer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    if ($fromDate->year == $toDate->year && $fromDate->month == $toDate->month && $fromDate->day == $toDate->day) {
      $fromDate->startOfDay();
      $toDate->endOfDay();
    }

    return (object) [
      'count' => Member::count(),
      'date' => $fromDate->format('M Y') . ' to ' . $toDate->format('M d, Y'),
    ];
  }

  public static function freelancers(): object
  {
    $freelancersCreatedFromTo = Freelancer::selectRaw('MIN(created_at) as min, MAX(created_at) as max')->first();
    $fromDate = Carbon::parse($freelancersCreatedFromTo->min)->startOfMonth();
    $toDate = Carbon::parse($freelancersCreatedFromTo->max)->endOfMonth();

    if ($fromDate->year == $toDate->year && $fromDate->month == $toDate->month && $fromDate->day == $toDate->day) {
      $fromDate->startOfDay();
      $toDate->endOfDay();
    }

    return (object) [
      'count' => Freelancer::count(),
      'date' => $fromDate->format('M Y') . ' to ' . $toDate->format('M d, Y'),
    ];
  }

  public static function bookings(): object
  {
    $bookingsCreatedFromTo = Booking::selectRaw('MIN(created_at) as min, MAX(created_at) as max')->first();
    $fromDate = Carbon::parse($bookingsCreatedFromTo->min)->startOfMonth();
    $toDate = Carbon::parse($bookingsCreatedFromTo->max)->endOfMonth();

    if ($fromDate->year == $toDate->year && $fromDate->month == $toDate->month && $fromDate->day == $toDate->day) {
      $fromDate->startOfDay();
      $toDate->endOfDay();
    }

    return (object) [
      'count' => Booking::count(),
      'date' => $fromDate->format('M Y') . ' to ' . $toDate->format('M d, Y'),
    ];
  }

  public static function membersAndFreelancersThisDuration($duration = 'month'): object
  {
    if ($duration == 'week') {
      $membersCount = Member::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      $freelancersCount = Freelancer::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    } elseif ($duration == 'month') {
      $membersCount = Member::whereMonth('created_at', Carbon::now()->month)->count();
      $freelancersCount = Freelancer::whereMonth('created_at', Carbon::now()->month)->count();
    } elseif ($duration == 'year') {
      $membersCount = Member::whereYear('created_at', Carbon::now()->year)->count();
      $freelancersCount = Freelancer::whereYear('created_at', Carbon::now()->year)->count();
    } else {
      $membersCount = Member::count();
      $freelancersCount = Freelancer::count();
    }

    if ($membersCount > $freelancersCount) {
      $membersCount = 100;
      $freelancersCount = round(($freelancersCount / $membersCount) * 100, 2);
    } elseif ($membersCount < $freelancersCount) {
      $membersCount = round(($membersCount / $freelancersCount) * 100, 2);
      $freelancersCount = 100;
    }

    return (object) [
      'members' => $membersCount . '%',
      'freelancers' => $freelancersCount . '%',
    ];
  }

  public static function freelancersAndMembersChartData($duration = 'month'): object
  {
    if ($duration == 'week') {
      $labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
      $members = array_fill(0, 7, 0);
      $freelancers = array_fill(0, 7, 0);

      // Fetch member counts from the database grouped by day of the week
      $memberCounts = DB::table((new Member())->getTable())
        ->select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('count(*) as count'))
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();

      // Fetch freelancer counts from the database grouped by day of the week
      $freelancerCounts = DB::table((new Freelancer())->getTable())
        ->select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('count(*) as count'))
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();

      // Update members and freelancers arrays with actual counts
      foreach ($memberCounts as $day => $count) {
        $members[$day - 1] = $count; // DAYOFWEEK returns 1 for Sunday, so we need $day - 1
      }

      foreach ($freelancerCounts as $day => $count) {
        $freelancers[$day - 1] = $count;
      }

      // Re-index arrays
      $labels = array_values($labels);
      $members = array_values($members);
      $freelancers = array_values($freelancers);
    } elseif ($duration == 'month') {
      $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      $members = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      $freelancers = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }

    return (object) [
      'labels' => $labels,
      'members' => $members,
      'freelancers' => $freelancers,
    ];
  }
}
