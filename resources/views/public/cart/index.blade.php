@extends('layouts.public')

@section('title', 'Giỏ hàng')

@section('content')
@if($items->isEmpty())
    <div class="border rounded-2 p-4 text-center">
        <p class="mb-2">Giỏ hàng của bạn đang trống.</p>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">
            Tiếp tục mua sắm
        </a>
    </div>
@else
    @php
        // Tạm tính từ các item
        $subtotal = $items->sum('subtotal');
        // Tạm cho giảm giá & phí ship = 0 (tuỳ bạn xử lý ở controller sau này)
        $discount = 0;
        $shippingFee = 0;
        $grandTotal = $total; // hoặc = $subtotal - $discount + $shippingFee
    @endphp

    <div class="container px-0">
        <div class="row g-3">
            <!-- Cột trái: danh sách sản phẩm -->
            <div class="col-lg-8">
                <section class="section-block">
                    <!-- Header giỏ hàng -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="checkAllCart"
                            />
                            <label class="form-check-label small" for="checkAllCart">
                                Chọn tất cả ({{ $items->count() }} sản phẩm)
                            </label>
                        </div>
                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            @method('DELETE')
                            <button class="small text-decoration-none text-muted border-0 bg-transparent p-0">
                                Xoá toàn bộ
                            </button>
                        </form>
                    </div>

                    @foreach($items as $item)
                        <div class="border rounded-2 p-2 p-md-3 mb-2">
                            <div class="row g-2 g-md-3 align-items-center">
                                <div class="col-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <input
                                            class="form-check-input mt-0 cart-item-checkbox"
                                            type="checkbox"
                                            value="{{ $item['product_id'] }}"
                                        />
                                        <a href="{{ $item['product'] ? route('products.show', $item['product_id']) : '#' }}">
                                            <img
                                                src="{{ $item['product']->primary_image  ? asset('storage/'.$item['product']->primary_image) : 'https://placehold.co/80x100/E5E7EB/111827?text=Img' }}"
                                                alt="{{ $item['product']->name ?? 'Đã xóa' }}"
                                                class="img-fluid rounded-1"
                                            />
                                        </a>
                                    </div>
                                </div>

                                <div class="col-9 col-md">
                                    <a href="{{ $item['product'] ? route('products.show', $item['product_id']) : '#' }}"
                                       class="text-decoration-none text-body">
                                        <div class="small fw-semibold">
                                            {{ $item['product']->name ?? 'Sản phẩm đã bị xoá' }}
                                        </div>
                                    </a>

                                    @if($item['product'])
                                        @if($item['product']->sale_percentage > 0)
                                            <div class="small text-muted mt-1">
                                                Giảm {{ $item['product']->sale_percentage }}%
                                            </div>
                                        @endif
                                    @else
                                        <div class="small text-muted mt-1">
                                            Sản phẩm không còn khả dụng.
                                        </div>
                                    @endif
                                </div>

                                <div class="col-6 col-md-3 col-lg-2">
                                    <div class="small text-muted mb-1">Số lượng</div>

                                    @if($item['product'])
                                        <form method="POST"
                                              action="{{ route('cart.update', $item['product_id']) }}"
                                              class="input-group input-group-sm">
                                            @csrf
                                            @method('PUT')

                                            <input
                                                type="number"
                                                name="quantity"
                                                class="form-control text-center"
                                                min="1"
                                                value="{{ $item['quantity'] }}"
                                            />
                                            <button class="btn btn-outline-secondary" type="submit">
                                                Cập nhật
                                            </button>
                                        </form>
                                    @else
                                        <span class="small text-muted">Không khả dụng</span>
                                    @endif
                                </div>

                                <div class="col-6 col-md-3 col-lg-2 text-end">
                                    <div class="small text-muted">Đơn giá</div>

                                    @if($item['product'])
                                        <div class="fw-bold text-danger">
                                            {{ number_format($item['unit_price'], 0, ',', '.') }} đ
                                        </div>

                                        @if($item['product']->sale_percentage > 0)
                                            <div class="small text-muted text-decoration-line-through">
                                                {{ number_format($item['product']->price, 0, ',', '.') }} đ
                                            </div>
                                            @php
                                                $saved = $item['product']->price - $item['unit_price'];
                                            @endphp
                                            @if($saved > 0)
                                                <div class="small text-danger">
                                                    Tiết kiệm {{ number_format($saved, 0, ',', '.') }} đ
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <span class="small text-muted">Không khả dụng</span>
                                    @endif

                                    <div class="small mt-1">
                                        Tạm tính: {{ number_format($item['subtotal'], 0, ',', '.') }} đ
                                    </div>

                                    <form method="POST"
                                          action="{{ route('cart.destroy', $item['product_id']) }}"
                                          class="mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="small text-decoration-none text-muted d-inline-flex align-items-center gap-1 border-0 bg-transparent p-0"
                                        >
                                            <i class="bi bi-trash"></i> Xoá
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Ghi chú/CTA tiếp tục mua -->
                    <div
                        class="d-flex flex-wrap justify-content-between align-items-center mt-3 small"
                    >
                        <div class="text-muted">
                            Lưu ý về điều kiện giao hàng / khuyến mãi.
                        </div>
                        <a
                            href="{{ route('products.index') }}"
                            class="text-decoration-none d-inline-flex align-items-center gap-1"
                        >
                            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </section>
            </div>

            <!-- Cột phải: tóm tắt đơn hàng -->
            <div class="col-lg-4">
                <section class="section-block">
                    <h2 class="h6 fw-semibold mb-3">Tóm tắt đơn hàng</h2>

                    <!-- Mã giảm giá (placeholder) -->
                    <div class="mb-3">
                        <label class="form-label small">
                            Mã giảm giá / phiếu quà tặng
                        </label>
                        <div class="input-group input-group-sm">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nhập mã"
                            />
                            <button class="btn btn-outline-secondary" type="button">
                                Áp dụng
                            </button>
                        </div>
                        <div class="small text-muted mt-1">
                            Hướng dẫn lấy và nhập mã khuyến mãi <a href="#">tại đây</a>.
                        </div>
                    </div>

                    <hr class="my-2" />

                    <!-- Tính tiền -->
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Tạm tính</span>
                        <span>{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Giảm giá</span>
                        <span class="text-danger">
                            -{{ number_format($discount, 0, ',', '.') }} đ
                        </span>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Phí vận chuyển (ước tính)</span>
                        <span>{{ number_format($shippingFee, 0, ',', '.') }} đ</span>
                    </div>

                    <hr class="my-2" />

                    <div class="d-flex justify-content-between align-items-baseline mb-1">
                        <span class="small fw-semibold">Thành tiền</span>
                        <span class="fw-bold fs-6">
                            {{ number_format($grandTotal, 0, ',', '.') }} đ
                        </span>
                    </div>
                    <div class="small text-muted mb-3">
                        Đã bao gồm VAT (nếu có).
                    </div>

                    <!-- Nút đặt hàng -->
                    <div class="d-grid gap-2 mb-3">
                        @auth
                            <a
                                href="{{ route('checkout.index') }}"
                                class="btn btn-danger btn-sm fw-semibold d-flex justify-content-center align-items-center gap-1"
                            >
                                <i class="bi bi-shield-check"></i>
                                Tiến hành đặt hàng
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="btn btn-primary btn-sm fw-semibold d-flex justify-content-center align-items-center gap-1"
                            >
                                Đăng nhập để thanh toán
                            </a>
                        @endauth
                    </div>

                    <div class="small text-muted">
                        Bằng cách đặt hàng, bạn đồng ý với
                        <a href="#" class="text-decoration-none">Điều khoản sử dụng</a>
                        và
                        <a href="#" class="text-decoration-none">Chính sách bảo mật</a>.
                    </div>
                </section>

            </div>
        </div>
    </div>
@endif

@endsection
