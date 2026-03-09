@php
    $hasDiscount = $product->sale_percentage > 0;
    $imageUrl = $product->primary_image
        ? asset('storage/'.$product->primary_image)
        : 'https://placehold.co/400x400?text=Product';
@endphp
<div class="product-card">
  <a href="{{ route('products.show', $product) }}" class="product-link">
    <img
      src="{{ $imageUrl }}"
      alt="{{ $product->name }}"
    />
  </a>
  <div class="product-card-body">
    <a href="{{ route('products.show', $product) }}" class="product-link">
      <div class="product-name">{{ $product->name }}</div>
    </a>
    <div class="d-flex align-items-center gap-1">
      <span class="product-price">
        {{ number_format($product->sale_price, 0, ',', '.') }} đ
      </span>
      @if($hasDiscount)
        <span class="product-old-price">
          {{ number_format($product->price, 0, ',', '.') }} đ
        </span>
      @endif
    </div>
    <div class="d-flex justify-content-between align-items-center">
      @if($hasDiscount)
        <span class="product-badge">-{{ $product->sale_percentage }}%</span>
      @else
        <span class="text-muted small">Giá chuẩn</span>
      @endif
      @if($product->is_featured)
      <small class="text-muted">Bán chạy</small>
      @endif
    </div>
    <div class="mt-auto py-2">
      <form
        method="POST"
        action="{{ route('cart.store', $product) }}"
        class="d-grid"
      >
        @csrf
        <button class="btn btn-outline-primary"><i class="bi bi-cart-plus"></i> <small>Thêm vào giỏ</small></button>
      </form>
    </div>
  </div>
</div>
