<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryOptions();
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['sale_percentage'] = $data['sale_percentage'] ?? 0;
        $data = $this->handleGalleryUploads($request, $data);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryOptions();
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['sale_percentage'] = $data['sale_percentage'] ?? 0;
        $data = $this->handleGalleryUploads($request, $data, $product);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(Product $product)
    {
        $this->deleteGalleryImages($product);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }

    private function handleGalleryUploads(ProductRequest $request, array $data, ?Product $product = null): array
    {
        foreach (range(1, 4) as $index) {
            $field = 'image_'.$index;

            if ($request->hasFile($field)) {
                if ($product && $product->$field) {
                    Storage::disk('public')->delete($product->$field);
                }

                $data[$field] = $request->file($field)->store('products', 'public');
            }
        }

        return $data;
    }

    private function deleteGalleryImages(Product $product): void
    {
        foreach (range(1, 4) as $index) {
            $field = 'image_'.$index;
            if ($product->$field) {
                Storage::disk('public')->delete($product->$field);
            }
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
    }

    private function categoryOptions(): array
    {
        $categories = ProductCategory::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $options = [];
        $this->flattenCategories($categories, $options);

        return $options;
    }

    private function flattenCategories($categories, array &$options, string $prefix = ''): void
    {
        foreach ($categories as $category) {
            $options[$category->id] = $prefix.$category->name;
            if ($category->children->isNotEmpty()) {
                $this->flattenCategories($category->children, $options, $prefix.'— ');
            }
        }
    }
}
