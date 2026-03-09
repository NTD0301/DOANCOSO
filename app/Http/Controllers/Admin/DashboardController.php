<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'products' => Product::count(),
            'posts' => Post::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'revenue' => Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total_amount'),
        ];

        $chartData = $this->buildChartData();

        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'latestOrders'));
    }

    private function buildChartData(): array
    {
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse()->values();

        $data = $months->map(function ($month) {
            [$year, $m] = explode('-', $month);

            $total = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->whereIn('status', ['paid', 'processing', 'completed'])
                ->sum('total_amount');

            return [
                'month' => $month,
                'total' => (float) $total,
            ];
        });

        return [
            'labels' => $data->pluck('month'),
            'values' => $data->pluck('total'),
        ];
    }
}
