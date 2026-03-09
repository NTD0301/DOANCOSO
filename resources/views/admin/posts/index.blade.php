@extends('layouts.admin')

@section('title', 'Quản lý bài viết')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Bài viết</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm bài viết</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="posts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Ngày đăng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name ?? '-' }}</td>
                        <td>{{ $post->author }}</td>
                        <td>{{ optional($post->published_at)->format('d/m/Y') }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.show', $post) }}" target="_blank">Xem</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.posts.edit', $post) }}">Sửa</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="d-inline" onsubmit="return confirm('Xóa bài viết này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#posts-table').DataTable();
});
</script>
@endpush
