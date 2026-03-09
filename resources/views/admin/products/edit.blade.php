@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $product->name }}</h1>
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['product' => $product, 'categories' => $categories, 'brands' => $brands])
    </form>
@endsection

@push('scripts')
<script>
$(function(){
    $('.summernote').summernote({height:200});
});
</script>
@endpush
