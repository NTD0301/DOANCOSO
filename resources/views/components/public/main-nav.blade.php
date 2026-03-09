@props(['categories' => collect()])

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <nav class="nav flex-column gap-2" id="sidebarCategoryAccordion">
      <a href="{{ route('home') }}" class="nav-link">
        <i class="bi bi-house"></i> Trang chủ
      </a>
      <a href="{{ route('products.index') }}" class="nav-link">
        <i class="bi bi-grid"></i> Sản phẩm
      </a>
      <a href="{{ route('posts.index') }}" class="nav-link">
        <i class="bi bi-newspaper"></i> Bài viết
      </a>
      
      
    @forelse($categories as $category)
        @php
            $hasChildren = $category->children && $category->children->count();
        @endphp

        <div class="nav-item mb-2">

            @if($hasChildren)
                {{-- Nút mở/đóng danh mục cha (accordion cấp 1) --}}
                <button
                    class="btn w-100 text-start d-flex justify-content-between align-items-center nav-link"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#cat{{ $category->id }}"
                    aria-expanded="false"
                    aria-controls="cat{{ $category->id }}"
                >
                    <span><i class="bi bi-folder"></i> {{ $category->name }}</span>
                    <i class="bi bi-chevron-down small"></i>
                </button>

                {{-- Danh mục con (cấp 2) --}}
                <div
                    id="cat{{ $category->id }}"
                    class="collapse ps-2 mt-1"
                    data-bs-parent="#sidebarCategoryAccordion"
                >
                    <div id="subAccordion{{ $category->id }}">
                        @foreach($category->children as $child)
                            @php
                                $hasGrandChildren = $child->children && $child->children->count();
                            @endphp

                            @if($hasGrandChildren)
                                {{-- Child có cháu: thêm dropdown cấp 2 --}}
                                <div class="mb-1">
                                    <button
                                        class="btn btn-sm w-100 text-start d-flex justify-content-between align-items-center nav-link"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#subcat{{ $child->id }}"
                                        aria-expanded="false"
                                        aria-controls="subcat{{ $child->id }}"
                                    >
                                        <span><i class="bi bi-folder2"></i> {{ $child->name }}</span>
                                        <i class="bi bi-chevron-down small"></i>
                                    </button>

                                    {{-- Cháu (cấp 3) --}}
                                    <div
                                        id="subcat{{ $child->id }}"
                                        class="collapse ps-3 mt-1"
                                        data-bs-parent="#subAccordion{{ $category->id }}"
                                    >
                                        @foreach($child->children as $grand)
                                            <a
                                                href="{{ route('products.index', ['category' => $grand->slug]) }}"
                                                class="nav-link py-1"
                                            >
                                                <i class="bi bi-caret-right"></i> {{ $grand->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                {{-- Child không có cháu: link thẳng --}}
                                <a
                                    href="{{ route('products.index', ['category' => $child->slug]) }}"
                                    class="nav-link py-1"
                                >
                                    <i class="bi bi-caret-right"></i> {{ $child->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Danh mục không có con: link thẳng --}}
                <a
                    href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="nav-link"
                >
                    <i class="bi bi-folder2-open"></i> {{ $category->name }}
                </a>
            @endif

        </div>
    @empty
        <p class="text-muted px-2 mb-0">Đang cập nhật danh mục...</p>
    @endforelse









    </nav>

  </div>
</div>

<nav class="main-nav py-2 shadow-sm">
    <div class="container d-flex align-items-center justify-content-between gap-4">
        <div class="d-flex flex-wrap gap-4 fw-semibold">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('products.index') }}">Sản phẩm</a>
            <a href="{{ route('posts.index') }}">Tin tức</a>
            @can('view-admin')
                <a href="{{ route('admin.dashboard') }}">Quản trị</a>
            @endcan
        </div>
    </div>
</nav>
