@extends('layouts.public')

@section('title', 'Thanh toán')

@section('content')
<section class="section-block">
    <h1 class="h3 mb-4">Thông tin thanh toán</h1>
    <div class="row">
        <div class="col-lg-7">
            <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Họ tên *</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', auth()->user()->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ giao hàng *</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã giao dịch (nếu đã chuyển khoản)</label>
                    <input type="text" name="payment_reference" class="form-control" value="{{ old('payment_reference') }}">
                </div>
                <button class="btn btn-primary">Gửi đơn hàng</button>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">Tóm tắt đơn hàng</div>
                <ul class="list-group list-group-flush">
                    @foreach($items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item['product']->name ?? 'Sản phẩm không tồn tại' }} x {{ $item['quantity'] }}</span>
                            <div class="text-end">
                                <strong>{{ number_format($item['subtotal'], 0, ',', '.') }} đ</strong>
                                @if($item['product'] && $item['product']->sale_percentage > 0)
                                    <div class="small text-muted text-decoration-line-through">
                                        {{ number_format($item['product']->price * $item['quantity'], 0, ',', '.') }} đ
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        <span>Tổng cộng</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </li>
                </ul>
                <div class="card-body">
                    <h6>Thanh toán qua QR</h6>
                    <p>Quét mã QR để thanh toán nhanh. Sau khi thanh toán, nhập mã giao dịch vào ô bên trái.</p>
                    <img src="https://img.vietqr.io/image/VBA-7200205430570-compact.png?amount={{ $total }}">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(function(){
    $('#checkout-form').validate();
});
</script>
@endpush
