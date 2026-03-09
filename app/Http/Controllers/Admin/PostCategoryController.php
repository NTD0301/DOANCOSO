<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategoryRequest;
use App\Models\PostCategory;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::orderBy('name')->get();

        return view('admin.post_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.post_categories.create');
    }

    public function store(PostCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        PostCategory::create($data);

        return redirect()->route('admin.post-categories.index')->with('success', 'Thêm danh mục bài viết thành công.');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.post_categories.edit', compact('postCategory'));
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $postCategory->update($data);

        return redirect()->route('admin.post-categories.index')->with('success', 'Cập nhật danh mục bài viết thành công.');
    }

    public function destroy(PostCategory $postCategory)
    {
        if ($postCategory->posts()->exists()) {
            return back()->with('error', 'Danh mục đang có bài viết.');
        }

        $postCategory->delete();

        return redirect()->route('admin.post-categories.index')->with('success', 'Đã xóa danh mục.');
    }
}
