<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $comments = Comment::with(['user', 'commentable', 'parent', 'replies.user'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->only('status'));

        return view('admin.comments.index', compact('comments', 'status'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $comment->update([
            'status' => $data['status'],
            'approved_at' => $data['status'] === 'approved' ? now() : null,
        ]);

        return back()->with('success', 'Cập nhật trạng thái bình luận thành công.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }

    public function reply(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:3'],
        ]);

        $comment->replies()->create([
            'user_id' => $request->user()->id,
            'commentable_id' => $comment->commentable_id,
            'commentable_type' => $comment->commentable_type,
            'content' => $data['content'],
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Đã trả lời bình luận.');
    }
}
