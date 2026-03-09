@extends('layouts.admin')

@section('title', 'Thương hiệu / Nhà cung cấp')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Thương hiệu / Nhà cung cấp</h1>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm thương hiệu</a>
    </div>
    <div class="table-responsive bg-white p-3 shadow-sm rounded">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Website</th>
                    <th>Mô tả</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if($brand->website)
                                <a href="{{ $brand->website }}" target="_blank">{{ $brand->website }}</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $brand->description }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-secondary">Sửa</a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa thương hiệu này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Chưa có thương hiệu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
