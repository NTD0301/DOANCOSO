<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = collect($cart)->map(function ($item) {
            $product = Product::find($item['product_id']);
            $unitPrice = $product?->sale_price ?? 0;

            return [
                'product' => $product,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $unitPrice,
                'subtotal' => $unitPrice * $item['quantity'],
            ];
        });

        $total = $items->sum('subtotal');
        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Giỏ hàng'],
        ];

        return view('public.cart.index', compact('items', 'total', 'breadcrumbLinks'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);

        $quantity = (int) ($request->input('quantity', 1));

        $cart = session()->get('cart', []);
        $key = (string) $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function update(Request $request, int $productId)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $cart = session()->get('cart', []);
        $key = (string) $productId;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $data['quantity'];
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    public function destroy(int $productId)
    {
        $cart = session()->get('cart', []);
        $key = (string) $productId;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Đã làm trống giỏ hàng.');
    }
}
