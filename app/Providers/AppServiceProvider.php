<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('layouts.public', function ($view) {
            $cart = collect(session('cart', []));
            $cartCount = $cart->sum(fn ($item) => $item['quantity'] ?? 0);

            $categories = ProductCategory::with(['children' => function ($query) {
                $query->orderBy('name');
            }])
                ->whereNull('parent_id')
                ->orderBy('name')
                ->get();

            $view->with([
                'cartCount' => $cartCount,
                'navCategories' => $categories,
            ]);
        });
    }
}
