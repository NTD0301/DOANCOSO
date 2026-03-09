@extends('layouts.admin')

@section('title', 'Thêm bài viết')

@section('content')
    <h1 class="h4 mb-3">Thêm bài viết</h1>
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @include('admin.posts._form', ['post' => null, 'categories' => $categories])
    </form>
@endsection

@push('scripts')
<script>
$(function(){
    $('.summernote').summernote({height:250});
});
</script>
@endpush
