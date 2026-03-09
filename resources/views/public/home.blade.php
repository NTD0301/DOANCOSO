@extends('layouts.public') @section('title', 'Trang chủ - Bakery Laravel') 
@section('content')

<x-public.banner :banners="$banners" :banners_small="$banners_small"></x-public.banner>
<!-- service-strip -->
<section class="section-block">
  <div class="service-strip">
    <div class="row text-center text-md-start g-3">
      <div class="col-6 col-md-3">
        <div
          class="service-item justify-content-center justify-content-md-start"
        >
          <i class="bi bi-truck"></i>
          <div>Giao hàng toàn quốc</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div
          class="service-item justify-content-center justify-content-md-start"
        >
          <i class="bi bi-shield-check"></i>
          <div>Sản phẩm chính hãng</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div
          class="service-item justify-content-center justify-content-md-start"
        >
          <i class="bi bi-arrow-counterclockwise"></i>
          <div>Đổi trả linh hoạt</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div
          class="service-item justify-content-center justify-content-md-start"
        >
          <i class="bi bi-gift"></i>
          <div>Ưu đãi thành viên</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <x-public.countdownsale></x-public.countdownsale> --}}

<!-- Sản phẩm nổi bật -->
<section class="section-block">
  <div class="section-header">
    <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
      <span class="section-header-inner">
        <i class="bi bi-gift"></i>
        <div class="d-flex flex-column">
          <span class="section-header-title">Sản phẩm nổi bật</span>
        </div>
      </span>
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
    </div>
  </div>

  <div class="row g-2 g-md-3">
    @forelse($featuredProducts as $product)
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

<!-- Bài viết nổi bật -->
<section class="section-block">
  <div class="section-header">
    <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
      <span class="section-header-inner">
        <i class="bi bi-gift"></i>
        <div class="d-flex flex-column">
          <span class="section-header-title">Bài viết nổi bật</span>
        </div>
      </span>
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
    </div>
  </div>
  <div class="row g-4">
    @forelse($latestPosts as $post)
    <div class="col-12 col-sm-6 col-md-3">
      <x-public.post-card :post="$post" />
    </div>
    @empty
    <div class="col-12">
      <div class="empty-state">Chưa có bài viết.</div>
    </div>
    @endforelse
  </div>
</section>
@endsection
