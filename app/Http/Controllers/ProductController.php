<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        if ($request->filled('category')) {
            $category = ProductCategory::where('slug', $request->category)->first();
            if ($category) {
                $category->load('children.children');
                $ids = $this->collectCategoryIds($category);
                $query->whereIn('product_category_id', $ids);
            }
        }

        $products = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

        $categories = ProductCategory::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Sản phẩm', 'url' => route('products.index')],
        ];

        return view('public.products.index', compact('products', 'categories', 'breadcrumbLinks'));
    }

    public function show(Request $request, Product $product)
    {
        $product->loadMissing([
            'category',
            'brand',
            'comments' => fn ($query) => $query->approved()
                ->latest('approved_at')
                ->with(['user', 'replies' => fn ($q) => $q->approved()->with('user')]),
        ]);

        $related = Product::where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $ratingFilter = $request->integer('rating');
        if ($ratingFilter < 1 || $ratingFilter > 5) {
            $ratingFilter = null;
        }

        $reviewsQuery = $product->reviews()->with('user')->latest();
        if ($ratingFilter) {
            $reviewsQuery->where('rating', $ratingFilter);
        }
        $reviews = $reviewsQuery->paginate(5)->withQueryString();

        $baseReviewQuery = $product->reviews();
        $averageRating = round((float) (clone $baseReviewQuery)->avg('rating'), 1);
        $reviewCount = (clone $baseReviewQuery)->count();
        $ratingBreakdown = (clone $baseReviewQuery)
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->all();

        $eligibleOrderItem = null;
        if (Auth::check()) {
            $eligibleOrderItem = OrderItem::where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id())->where('status', 'completed');
                })
                ->whereDoesntHave('review')
                ->latest()
                ->first();
        }

        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Sản phẩm', 'url' => route('products.index')],
            ['label' => $product->name],
        ];

        return view('public.products.show', compact(
            'product',
            'related',
            'breadcrumbLinks',
            'reviews',
            'averageRating',
            'reviewCount',
            'ratingBreakdown',
            'ratingFilter',
            'eligibleOrderItem'
        ));
    }

    private function collectCategoryIds(ProductCategory $category)
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->collectCategoryIds($child));
        }

        return $ids;
    }
}
