<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\CommentRequest;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $mapping = [
            'product' => Product::class,
            'post' => Post::class,
        ];

        $data = $request->validated();
        $type = $data['commentable_type'];
        $modelClass = Arr::get($mapping, $type);

        abort_unless($modelClass, 404);

        $model = $modelClass::findOrFail($data['commentable_id']);

        $model->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $data['content'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi và đang chờ duyệt.');
    }
}
