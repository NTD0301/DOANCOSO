<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with('parent')
            ->orderBy('depth')
            ->orderBy('name')
            ->get();

        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->categoryOptions();

        return view('admin.product_categories.create', compact('parents'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $data = $this->buildData($request);

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Thêm danh mục thành công.');
    }

    public function edit(ProductCategory $productCategory)
    {
        $parents = $this->categoryOptions($productCategory->id);

        return view('admin.product_categories.edit', compact('productCategory', 'parents'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $data = $this->buildData($request);

        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->children()->exists()) {
            return back()->with('error', 'Vui lòng xóa danh mục con trước.');
        }

        if ($productCategory->products()->exists()) {
            return back()->with('error', 'Danh mục đang chứa sản phẩm.');
        }

        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Đã xóa danh mục.');
    }

    private function categoryOptions(?int $ignoreId = null): array
    {
        $categories = ProductCategory::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $options = [];
        $this->flattenCategories($categories, $options, '', $ignoreId);

        return $options;
    }

    private function flattenCategories($categories, array &$options, string $prefix = '', ?int $ignoreId = null): void
    {
        foreach ($categories as $category) {
            if ($category->id === $ignoreId) {
                continue;
            }

            $options[$category->id] = $prefix.$category->name;

            if ($category->children->isNotEmpty()) {
                $this->flattenCategories($category->children, $options, $prefix.'— ', $ignoreId);
            }
        }
    }

    private function buildData(ProductCategoryRequest $request): array
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if (! empty($data['parent_id'])) {
            $parent = ProductCategory::find($data['parent_id']);
            $data['depth'] = ($parent->depth ?? 0) + 1;
        } else {
            $data['parent_id'] = null;
            $data['depth'] = 1;
        }

        return $data;
    }
}
