<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Freelancer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardChartsService
{
  public static function membersAndFreelancersThisDuration(string $duration): object
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

  public static function freelancersAndMembersChartData(string $duration): object
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
    } elseif ($duration == 'year') {
      $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      $members = array_fill(0, 12, 0);
      $freelancers = array_fill(0, 12, 0);

      // Fetch member counts from the database grouped by month
      $memberCounts = DB::table((new Member())->getTable())
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

      // Fetch freelancer counts from the database grouped by month
      $freelancerCounts = DB::table((new Freelancer())->getTable())
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

      // Update members and freelancers arrays with actual counts
      foreach ($memberCounts as $month => $count) {
        $members[$month - 1] = $count; // MONTH returns 1 for January, so we need $month - 1
      }

      foreach ($freelancerCounts as $month => $count) {
        $freelancers[$month - 1] = $count;
      }
    } else {
      // Assuming 'month' duration
      $daysInMonth = now()->daysInMonth;
      $labels = [];
      for ($i = 1; $i <= $daysInMonth; $i++) {
        $labels[] = $i . ' ' . now()->format('M');
      }
      $members = array_fill(0, $daysInMonth, 0);
      $freelancers = array_fill(0, $daysInMonth, 0);

      // Fetch member counts from the database grouped by day of the month
      $memberCounts = DB::table((new Member())->getTable())
        ->select(DB::raw('DAY(created_at) as day'), DB::raw('count(*) as count'))
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();

      // Fetch freelancer counts from the database grouped by day of the month
      $freelancerCounts = DB::table((new Freelancer())->getTable())
        ->select(DB::raw('DAY(created_at) as day'), DB::raw('count(*) as count'))
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();

      // Update members and freelancers arrays with actual counts
      foreach ($memberCounts as $day => $count) {
        $members[$day - 1] = $count; // DAY returns the day of the month, so we need $day - 1
      }

      foreach ($freelancerCounts as $day => $count) {
        $freelancers[$day - 1] = $count;
      }
    }

    return (object) [
      'labels' => $labels,
      'members' => $members,
      'freelancers' => $freelancers,
    ];
  }
}
