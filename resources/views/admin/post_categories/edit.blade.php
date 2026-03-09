@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục bài viết')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $postCategory->name }}</h1>
    <form method="POST" action="{{ route('admin.post-categories.update', $postCategory) }}">
        @method('PUT')
        @include('admin.post_categories._form', ['category' => $postCategory])
    </form>
@endsection
