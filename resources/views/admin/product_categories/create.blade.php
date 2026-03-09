@extends('layouts.admin')

@section('title', 'Thêm danh mục sản phẩm')

@section('content')
    <h1 class="h4 mb-3">Thêm danh mục sản phẩm</h1>
    <form method="POST" action="{{ route('admin.product-categories.store') }}">
        @include('admin.product_categories._form', ['category' => null, 'parents' => $parents])
    </form>
@endsection
