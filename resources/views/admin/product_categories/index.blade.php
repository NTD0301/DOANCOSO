@extends('layouts.admin')

@section('title', 'Danh mục sản phẩm')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Danh mục sản phẩm</h1>
        <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
    </div>
    <div class="table-responsive bg-white p-3 shadow-sm rounded">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th>Thuộc</th>
                    <th>Cập nhật</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ str_repeat('— ', max($category->depth-1, 0)) }}{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->parent?->name ?? 'Gốc' }}</td>
                        <td>{{ optional($category->updated_at)->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Sửa</a>
                            <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có danh mục.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
