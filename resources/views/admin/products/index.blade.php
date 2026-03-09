@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Sản phẩm</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Giá bán</th>
                    <th>Kho</th>
                    <th>Nổi bật</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>
                            <div class="fw-semibold text-danger">{{ number_format($product->sale_price, 0, ',', '.') }} đ</div>
                            @if($product->sale_percentage > 0)
                                <small class="text-muted text-decoration-line-through">{{ number_format($product->price, 0, ',', '.') }} đ</small>
                                <span class="badge text-bg-danger ms-1">-{{ $product->sale_percentage }}%</span>
                            @endif
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>{!! $product->is_featured ? '<span class="badge text-bg-success">Có</span>' : '<span class="badge text-bg-secondary">Không</span>' !!}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.show', $product) }}" target="_blank">Xem</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.products.edit', $product) }}">Sửa</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?')">
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
    $('#products-table').DataTable();
});
</script>
@endpush
