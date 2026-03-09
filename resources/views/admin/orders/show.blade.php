@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #'.$order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Thông tin khách hàng</div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->full_name }}</p>
                    <p><strong>Điện thoại:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Thanh toán</div>
                <div class="card-body">
                    <p><strong>Hình thức:</strong> {{ strtoupper($order->payment_method) }}</p>
                    <p><strong>Mã giao dịch:</strong> {{ $order->payment_reference ?? 'N/A' }}</p>
                    <p><strong>Trạng thái:</strong> <span class="badge text-bg-info">{{ $order->status }}</span></p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} đ</p>
                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="mt-3">
                        @csrf
                        @method('PATCH')
                        <label class="form-label">Cập nhật trạng thái</label>
                        <div class="input-group">
                            <select name="status" class="form-select">
                                @foreach(['pending','paid','processing','completed','cancelled'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Sản phẩm</div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
