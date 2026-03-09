@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h1 class="h4 mb-3">Thêm sản phẩm</h1>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @include('admin.products._form', ['product' => null, 'categories' => $categories, 'brands' => $brands])
    </form>
@endsection

@push('scripts')
<script>
$(function(){
    $('.summernote').summernote({height:200});
});
</script>
@endpush
