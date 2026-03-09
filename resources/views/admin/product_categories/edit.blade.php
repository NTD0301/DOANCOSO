@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục sản phẩm')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $productCategory->name }}</h1>
    <form method="POST" action="{{ route('admin.product-categories.update', $productCategory) }}">
        @method('PUT')
        @include('admin.product_categories._form', ['category' => $productCategory, 'parents' => $parents])
    </form>
@endsection
