<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::orderByDesc('published_at');

        if ($request->filled('category')) {
            $category = PostCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('post_category_id', $category->id);
            }
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = PostCategory::orderBy('name')->get();

        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Bài viết', 'url' => route('posts.index')],
        ];

        return view('public.posts.index', compact('posts', 'categories', 'breadcrumbLinks'));
    }

    public function show(Post $post)
    {
        $post->loadMissing([
            'category',
            'comments' => fn ($query) => $query->approved()
                ->latest('approved_at')
                ->with(['user', 'replies' => fn ($q) => $q->approved()->with('user')]),
        ]);

        $latest = Post::where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        $breadcrumbLinks = [
            ['label' => 'Trang chủ', 'url' => route('home')],
            ['label' => 'Bài viết', 'url' => route('posts.index')],
            ['label' => $post->category->name],
        ];

        return view('public.posts.show', compact('post', 'latest', 'breadcrumbLinks'));
    }
}
