

@extends('layouts.public')

@section('title', $product->name)

@php
    $galleryImages = $product->gallery_images;
    if ($galleryImages->isEmpty() && $product->image) {
        $galleryImages = collect([$product->image]);
    }

    $mainImagePath = $galleryImages->first();
    $mainImageUrl = $mainImagePath
        ? asset('storage/'.$mainImagePath)
        : 'https://placehold.co/600x400';
    $hasDiscount = $product->sale_percentage > 0;
    $averageScore = $averageRating ?? 0;
    $reviewTotal = $reviewCount ?? 0;
@endphp

@section('content')
<section class="section-block product-detail-wrapper">
    <div class="row g-3">
        <!-- Gallery -->
        <div class="col-md-4">
            <div class="product-gallery-main mb-2">
            <img
                id="productMainImage"
                src="{{ $mainImageUrl }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
            <div class="thumb-list">
            @forelse($galleryImages as $path)
                @php $url = asset('storage/'.$path); @endphp
                <div class="thumb-item {{ $loop->first ? 'active' : '' }}" data-image="{{ $url }}">
                    <img src="{{ $url }}" alt="Ảnh {{ $loop->iteration }}">
                </div>
            @empty
                <div class="thumb-item active" data-image="{{ $mainImageUrl }}">
                    <img src="{{ $mainImageUrl }}" alt="{{ $product->name }}">
                </div>
            @endforelse
            </div>
        </div>

        <!-- Product main info -->
        <div class="col-md-5">
            <h1 class="product-title">
            {{ $product->name }}
            </h1>

            <div class="product-meta">
            <div>
                Thương hiệu:
                <span class="fw-semibold">{{ $product->brand->name ?? 'Đang cập nhật' }}</span>
            </div>
            <div>
                Thể loại:
                <span class="fw-semibold">{{ $product->category->name ?? 'Không phân loại' }}</span>
            </div>
            </div>

            <div class="product-rating">
            <div class="text-warning">
                @for($i = 1; $i <= 5; $i++)
                    @php
                        $icon = 'bi-star';
                        if ($averageScore >= $i) {
                            $icon = 'bi-star-fill';
                        } elseif ($averageScore >= $i - 0.5) {
                            $icon = 'bi-star-half';
                        }
                    @endphp
                    <i class="bi {{ $icon }}"></i>
                @endfor
            </div>
            <span class="ms-2">{{ number_format($averageScore, 1) }} / 5</span>
            <span class="ms-2 text-muted">({{ $reviewTotal }} đánh giá)</span>
            </div>

            <div class="product-price-block">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="product-price-main">{{ number_format($product->sale_price, 0, ',', '.') }} đ</span>
                @if($hasDiscount)
                    <span class="product-price-old">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                    <span class="product-price-badge">-{{ $product->sale_percentage }}%</span>
                @endif
            </div>
            <div class="small text-muted">
                Giá đã bao gồm VAT.
            </div>
            </div>

            <div class="product-status">
            Tình trạng:
            @if($product->stock > 0)
                <span class="text-success">Còn {{ $product->stock }} sản phẩm</span>
            @else
                <span class="text-danger">Hết hàng</span>
            @endif
            ·
            <span>Giao nhanh toàn quốc</span>
            </div>

            <div class="product-actions mb-3">
                <form class="row g-3" method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf
                    <div class="col-4">
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1">
                    </div>
                    <div class="col-8 align-self-end">
                        <button class="btn btn-primary" @if($product->stock <= 0) disabled @endif>Thêm giỏ hàng</button>
                        @if($product->stock <= 0)
                            <small class="text-muted d-block">Sản phẩm sẽ được giao ngay khi có hàng.</small>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Right column: shipping / seller / more -->
        <div class="col-md-3">
            <div class="info-box">
                <div class="info-box-title">
                    <i class="bi bi-gift"></i> Chương trình khuyến mãi</div>
                <ul class="mb-0 small">
                    <li>
                        @if($product->sale_percentage > 0)
                            Giảm ngay {{ $product->sale_percentage }}% cho sản phẩm trong tháng này.
                        @else
                            Ưu đãi dành riêng cho thành viên thân thiết.
                        @endif
                    </li>
                    <li>Tặng mã freeship cho đơn từ 500.000 đ.</li>
                    <li>Khách hàng thân thiết nhận thêm điểm thưởng.</li>
                </ul>
            </div>
            <div class="info-box">
                <div class="info-box-title">Chính sách</div>
                <ul class="mb-0 small">
                    <li>Đổi trả trong 7 ngày.</li>
                    <li>Hỗ trợ xuất hóa đơn.</li>
                    <li>Hỗ trợ khách hàng 8h-22h.</li>
                </ul>
            </div>
        </div>
    </div>
</section>







<!-- Tabs: Mô tả / Thông tin chi tiết / Đánh giá -->
<section class="mb-4">

    <div class="product-tabs">
    <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button
            class="nav-link active"
            id="desc-tab"
            data-bs-toggle="tab"
            data-bs-target="#desc"
            type="button"
            role="tab"
            aria-controls="desc"
            aria-selected="true"
        >
            Mô tả
        </button>
        </li>

        <li class="nav-item" role="presentation">
        <button
            class="nav-link"
            id="review-tab"
            data-bs-toggle="tab"
            data-bs-target="#review"
            type="button"
            role="tab"
            aria-controls="review"
            aria-selected="false"
        >
            Đánh giá
        </button>
        </li>
    </ul>

    <div class="product-tab-content tab-content" id="productTabContent">
        <!-- Mô tả -->
        <div
        class="tab-pane fade show active"
        id="desc"
        role="tabpanel"
        aria-labelledby="desc-tab"
        >
        {!! $product->description !!}
        </div>

        <!-- Đánh giá -->
        <div
        class="tab-pane fade"
        id="review"
        role="tabpanel"
        aria-labelledby="review-tab"
        >
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row g-3 align-items-center mb-4">
            <div class="col-md-3 text-center">
                <div class="display-5 fw-bold mb-1">{{ number_format($averageScore, 1) }}</div>
                <div class="text-warning mb-1">
                    @for($i = 1; $i <= 5; $i++)
                        @php
                            $icon = 'bi-star';
                            if ($averageScore >= $i) {
                                $icon = 'bi-star-fill';
                            } elseif ($averageScore >= $i - 0.5) {
                                $icon = 'bi-star-half';
                            }
                        @endphp
                        <i class="bi {{ $icon }}"></i>
                    @endfor
                </div>
                <div class="small text-muted">{{ $reviewTotal }} lượt đánh giá</div>
            </div>
            <div class="col-md-9">
                <div class="d-flex flex-wrap gap-2">
                    <a
                        href="{{ route('products.show', ['product' => $product->id]) }}#review"
                        class="btn btn-sm {{ $ratingFilter ? 'btn-outline-secondary' : 'btn-dark' }}"
                    >
                        Tất cả ({{ $reviewTotal }})
                    </a>
                    @for($star = 5; $star >= 1; $star--)
                        @php $count = $ratingBreakdown[$star] ?? 0; @endphp
                        <a
                            href="{{ route('products.show', ['product' => $product->id, 'rating' => $star]) }}#review"
                            class="btn btn-sm {{ $ratingFilter === $star ? 'btn-primary' : 'btn-outline-secondary' }}"
                        >
                            {{ $star }} sao ({{ $count }})
                        </a>
                    @endfor
                </div>
            </div>
        </div>

        @if($ratingFilter)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Đang lọc các đánh giá {{ $ratingFilter }} sao.</span>
                <a class="btn btn-sm btn-link" href="{{ route('products.show', ['product' => $product->id]) }}#review">Bỏ lọc</a>
            </div>
        @endif

        <div class="review-list mb-4">
            @forelse($reviews as $review)
                <div class="review-item border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <div class="fw-semibold">{{ $review->user?->name ?? 'Khách hàng' }}</div>
                        </div>
                        <div class="small text-muted">{{ $review->created_at?->diffForHumans() }}</div>
                    </div>
                    @if($review->comment)
                        <p class="mb-0 mt-2">{{ $review->comment }}</p>
                    @endif
                </div>
            @empty
                <div class="empty-state">Chưa có đánh giá nào cho sản phẩm này.</div>
            @endforelse
        </div>

        {{ $reviews->onEachSide(1)->links() }}

        <div class="mt-4">
            <h5 class="mb-3">Viết đánh giá của bạn</h5>
            @guest
                <div class="alert alert-light border">
                    Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản phẩm.
                </div>
            @else
                @if($eligibleOrderItem)
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <input type="hidden" name="order_item_id" value="{{ $eligibleOrderItem->id }}">
                        @error('order_item_id')
                            <div class="alert alert-danger py-2">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Chọn số sao *</label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} sao</option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung đánh giá</label>
                            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="4" placeholder="Chia sẻ trải nghiệm của bạn">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Gửi đánh giá</button>
                    </form>
                @else
                    <div class="alert alert-light border">
                        Bạn chỉ có thể đánh giá sau khi hoàn tất đơn hàng và chưa gửi đánh giá trước đó.
                    </div>
                @endif
            @endguest
        </div>
        </div>
    </div>
    </div>
</section>


<x-public.comments :commentable="$product" type="product"></x-public.comments>

<!-- Sản phẩm liên quan -->
<section class="section-block">
  <div class="section-header">
    <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
      <span class="section-header-inner">
        <i class="bi bi-gift"></i>
        <div class="d-flex flex-column">
          <span class="section-header-title">Sản phẩm liên quan</span>
        </div>
      </span>
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
    </div>
  </div>

  <div class="row g-2 g-md-3">
    @forelse($related as $product)
    <div class="col-6 col-md-4 col-lg-3">
      <x-public.product-card :product="$product" />
    </div>
    @empty
    <div class="col-12">
      <div class="empty-state">Chưa có sản phẩm nổi bật.</div>
    </div>
    @endforelse
  </div>
</section>


@endsection

@push('styles')
<style>
    /* Product detail layout */
    .product-detail-wrapper {
    margin-top: 0.25rem;
    }

    /* Gallery */
    .product-gallery-main {
    border: 1px solid var(--color-border-soft);
    border-radius: 0.25rem;
    background-color: var(--color-bg-surface);
    padding: 0.5rem;
    text-align: center;
    }

    .product-gallery-main img {
    max-width: 100%;
    max-height: 420px;
    object-fit: contain;
    }

    .thumb-list {
    margin-top: 0.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem;
    }

    .thumb-item {
    border-radius: 0.25rem;
    border: 1px solid var(--color-border-soft);
    padding: 0.15rem;
    cursor: pointer;
    background-color: var(--color-bg-surface);
    }

    .thumb-item.active {
    border-color: var(--color-primary);
    }

    .thumb-item img {
    width: 70px;
    height: 90px;
    object-fit: cover;
    }

    /* Product info */
    .product-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    }

    .product-subtitle {
    font-size: 0.875rem;
    color: var(--color-text-muted);
    margin-bottom: 0.5rem;
    }

    .product-meta {
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    }

    .product-meta a {
    color: var(--color-primary);
    text-decoration: none;
    }

    .product-meta a:hover {
    text-decoration: underline;
    }

    .product-rating {
    font-size: 0.875rem;
    color: var(--color-text-muted);
    margin-bottom: 0.75rem;
    }

    .product-rating .star {
    color: var(--color-rating);
    }

    .product-price-block {
    padding: 0.75rem;
    border-radius: 0.25rem;
    background-color: var(--color-bg-muted);
    border: 1px solid var(--color-border-soft);
    margin-bottom: 0.75rem;
    }

    .product-price-main {
    font-size: 1.45rem;
    font-weight: 700;
    color: var(--color-sale);
    }

    .product-price-old {
    font-size: 0.875rem;
    text-decoration: line-through;
    color: var(--color-text-muted);
    }

    .product-price-badge {
    font-size: 0.75rem;
    border-radius: 999px;
    padding: 0.1rem 0.5rem;
    background-color: rgba(220, 38, 38, 0.1);
    color: var(--color-sale);
    }

    .product-status {
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
    }

    .product-status span {
    font-weight: 600;
    }

    .product-actions .btn-buy-now {
    background-color: var(--color-sale);
    border-color: var(--color-sale);
    color: var(--color-text-inverse);
    font-weight: 600;
    }

    .product-actions .btn-buy-now:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    }

    .product-actions .btn-add-cart {
    border-color: var(--color-primary);
    color: var(--color-primary);
    font-weight: 500;
    }

    .product-actions .btn-add-cart:hover {
    background-color: rgba(201, 33, 39, 0.08);
    }

    .product-promo-box {
    background-color: var(--color-bg-muted);
    border: 1px dashed var(--color-border-strong);
    border-radius: 0.25rem;
    padding: 0.75rem;
    font-size: 0.875rem;
    }

    .product-promo-title {
    font-weight: 600;
    margin-bottom: 0.35rem;
    }

    .product-promo-list {
    padding-left: 1rem;
    margin-bottom: 0;
    }

    .product-promo-list li {
    margin-bottom: 0.2rem;
    }

    /* Right side box (ship, seller, policies) */
    .info-box {
    border-radius: 0.25rem;
    border: 1px solid var(--color-border-soft);
    padding: 0.75rem;
    background-color: var(--color-bg-surface);
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
    }

    .info-box-title {
    font-weight: 600;
    margin-bottom: 0.35rem;
    }

    .info-box a {
    color: var(--color-primary);
    text-decoration: none;
    }

    .info-box a:hover {
    text-decoration: underline;
    }

    /* Tabs mô tả / chi tiết / đánh giá */
    .product-tabs .nav-link {
    font-size: 0.9rem;
    color: var(--color-text-muted);
    }

    .product-tabs .nav-link.active {
    color: var(--color-primary);
    border-color: var(--color-border-soft) var(--color-border-soft)
        var(--color-bg-surface);
    }

    .product-tab-content {
    border: 1px solid var(--color-border-soft);
    border-top: none;
    border-radius: 0 0 0.25rem 0.25rem;
    padding: 1rem;
    background-color: var(--color-bg-surface);
    font-size: 0.9rem;
    }

    .table-spec {
    font-size: 0.875rem;
    }

    .table-spec th {
    width: 30%;
    font-weight: 500;
    color: var(--color-text-muted);
    background-color: var(--color-bg-muted);
    }

    .table-spec th,
    .table-spec td {
    border-color: var(--color-border-soft);
    }

    /* Product cards (related) */
    .product-card {
    background-color: var(--color-bg-surface);
    border-radius: 0.25rem;
    border: 1px solid var(--color-border-soft);
    overflow: hidden;
    transition: transform 0.14s ease, box-shadow 0.14s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    }

    .product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .product-link {
    display: block;
    text-decoration: none;
    color: inherit;
    }

    .product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    }

    .product-card-body {
    padding: 0.6rem 0.7rem 0.75rem;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
    font-size: 0.875rem;
    }

    .product-name {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    }

    .product-price {
    color: var(--color-primary);
    font-weight: 700;
    }

    .product-old-price {
    text-decoration: line-through;
    font-size: 0.75rem;
    color: var(--color-text-muted);
    }

    .product-badge {
    font-size: 0.7rem;
    background-color: rgba(220, 38, 38, 0.08);
    color: var(--color-sale);
    padding: 0.1rem 0.35rem;
    border-radius: 0.25rem;
    }
</style>
@endpush
@push('scripts')
    <!-- JS: đổi ảnh gallery -->
    <script>
      var mainImage = document.getElementById("productMainImage");
      var thumbItems = document.querySelectorAll(".thumb-item");

      thumbItems.forEach(function (thumb) {
        thumb.addEventListener("click", function () {
          var imgUrl = this.getAttribute("data-image");
          if (!imgUrl || !mainImage) return;
          mainImage.src = imgUrl;

          thumbItems.forEach(function (t) {
            t.classList.remove("active");
          });
          this.classList.add("active");
        });
      });
    </script>
@endpush
