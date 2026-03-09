@extends('layouts.admin')

@section('title', 'Quản lý banner')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Banner</h1>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Thêm banner</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->sort_order }}</td>
                        <td>{!! $banner->is_active ? '<span class="badge text-bg-success">Hiển thị</span>' : '<span class="badge text-bg-secondary">Ẩn</span>' !!}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.banners.edit', $banner) }}">Sửa</a>
                            <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="d-inline" onsubmit="return confirm('Xóa banner này?')">
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
