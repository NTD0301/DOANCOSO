<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\ProductReviewRequest;
use App\Models\OrderItem;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function store(ProductReviewRequest $request): RedirectResponse
    {
        $orderItem = OrderItem::with(['order', 'product', 'review'])->findOrFail($request->integer('order_item_id'));

        if ($orderItem->order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($orderItem->review) {
            return back()->with('error', 'Bạn đã đánh giá cho lần mua hàng này.');
        }

        if ($orderItem->order->status !== 'completed') {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sau khi đơn hàng đã hoàn tất.');
        }

        ProductReview::create([
            'order_id' => $orderItem->order_id,
            'order_item_id' => $orderItem->id,
            'product_id' => $orderItem->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->integer('rating'),
            'comment' => $request->input('comment'),
        ]);

        $redirectUrl = route('products.show', $orderItem->product).'#review';

        return redirect()->to($redirectUrl)->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm.');
    }
}
