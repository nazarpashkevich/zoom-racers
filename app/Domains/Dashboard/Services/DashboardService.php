<?php

namespace App\Domains\Dashboard\Services;

use App\Domains\Order\Models\Order;
use App\Domains\User\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardService
{
  public function newUsers(): Collection
  {
    $stat = User::query()
      ->where('created_at', '>', Carbon::now()->subMonths(12))
      ->groupBy('month')
      ->select([DB::raw('DATE_FORMAT(created_at, \'%c\') as month'), DB::raw('COUNT(*) as count')])
      ->pluck('count', 'month');

    return (new Collection(range(1, 12)))->map(fn (int $month) => [
      'key'   => Carbon::create()->month($month)->format('M'),
      'value' => $stat->get($month, 0),
    ]);
  }

  public function totalUsers(): Collection
  {
    $start = Carbon::now()->subDays(config('dashboard.count_days_active_users'))->startOfDay();

    $initialCount = User::query()
      ->where('created_at', '<=', $start)
      ->count();

    $stat = User::query()
      ->where('created_at', '>', $start)
      ->select([
        DB::raw('DATE(created_at) as date'),
        DB::raw('COUNT(*) as count'),
      ])
      ->groupBy(DB::raw('DATE(created_at)'))
      ->orderBy('date')
      ->pluck('count', 'date');

    return collect(Carbon::parse($start)->toPeriod(Carbon::now()))
      ->map(function (CarbonInterface $day) use (&$initialCount, $stat) {
        return [
          'key'   => $day->format('d M'),
          'value' => $initialCount += $stat->get($day->toDateString(), 0),
        ];
      });
  }

  public function revenue(): Collection
  {
    $start = Carbon::now()->subDays(config('dashboard.count_days_revenue'));

    $stat = Order::query()
      ->where('created_at', '>=', $start)
      ->groupBy('day')
      ->select([
        DB::raw('DATE_FORMAT(created_at, \'%d\') as day'),
        DB::raw('SUM(total) as total'),
      ])
      ->pluck('total', 'day');

    // @todo currency ?)

    return (new Collection($start->toPeriod(Carbon::now())->toArray()))->map(fn (CarbonInterface $day) => [
      'key'   => $day->format('d M'),
      'value' => $stat->get($day->day)?->getValue() ?? 0,
    ]);
  }

  public function orders(): Collection
  {
    $start = Carbon::now()->subDays(config('dashboard.count_days_orders'));

    $stat = Order::query()
      ->where('created_at', '>=', $start)
      ->groupBy('day')
      ->select([
        DB::raw('DATE_FORMAT(created_at, \'%d\') as day'),
        DB::raw('COUNT(*) as count'),
      ])
      ->pluck('count', 'day');

    return (new Collection($start->toPeriod(Carbon::now())->toArray()))->map(fn (CarbonInterface $day) => [
      'key'   => $day->format('d M'),
      'value' => $stat->get($day->day, 0),
    ]);
  }
}
