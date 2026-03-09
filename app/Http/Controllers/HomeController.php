<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Post;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $latestPosts = Post::orderByDesc('published_at')
            ->take(4)
            ->get();

        $banners = Banner::where('is_active', true)
            ->where('is_small', false)
            ->orderBy('sort_order')
            ->get();
        $banners_small = Banner::where('is_active', true)
            ->where('is_small', true)
            ->orderBy('sort_order')
            ->get();
        return view('public.home', compact('featuredProducts', 'latestPosts', 'banners', 'banners_small'));
    }
}
