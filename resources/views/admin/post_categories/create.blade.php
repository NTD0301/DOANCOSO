@extends('layouts.admin')

@section('title', 'Thêm danh mục bài viết')

@section('content')
    <h1 class="h4 mb-3">Thêm danh mục bài viết</h1>
    <form method="POST" action="{{ route('admin.post-categories.store') }}">
        @include('admin.post_categories._form', ['category' => null])
    </form>
@endsection
