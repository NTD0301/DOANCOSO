@extends('layouts.admin')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $post->title }}</h1>
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.posts._form', ['post' => $post, 'categories' => $categories])
    </form>
@endsection

@push('scripts')
<script>
$(function(){
    $('.summernote').summernote({height:250});
});
</script>
@endpush
