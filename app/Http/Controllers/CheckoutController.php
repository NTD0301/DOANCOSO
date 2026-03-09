<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $items = collect($cart)->map(function ($item) {
            $product = Product::find($item['product_id']);
            $unitPrice = $product?->sale_price ?? 0;

            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'unit_price' => $unitPrice,
                'subtotal' => $unitPrice * $item['quantity'],
            ];
        });

        $total = $items->sum('subtotal');
        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Thanh toán'],
        ];

        return view('public.checkout.index', compact('items', 'total', 'breadcrumbLinks'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        DB::beginTransaction();

        try {
            $items = collect();
            $total = 0;

            foreach ($cart as $cartItem) {
                $product = Product::whereKey($cartItem['product_id'])
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Một sản phẩm trong giỏ hàng không còn tồn tại.',
                    ]);
                }

                $quantity = max(1, (int) $cartItem['quantity']);

                if ($product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'cart' => "Sản phẩm {$product->name} không đủ số lượng. Hiện còn {$product->stock} sản phẩm.",
                    ]);
                }

                $unitPrice = $product->sale_price;
                $items->push([
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $unitPrice * $quantity,
                ]);

                $total += $unitPrice * $quantity;
            }

            if ($items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Giỏ hàng không hợp lệ.',
                ]);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => 'qr_code',
                'payment_reference' => $request->payment_reference,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['unit_price'],
                ]);

                $item['product']->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('home')->with('success', 'Đặt hàng thành công. Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất.');
        } catch (ValidationException $exception) {
            DB::rollBack();

            $message = collect($exception->errors())->flatten()->first();

            return back()
                ->withInput()
                ->withErrors($exception->errors())
                ->with('error', $message ?? 'Có lỗi xảy ra, vui lòng thử lại.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }
}
