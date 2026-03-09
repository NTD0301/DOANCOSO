<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - '.config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-light">

{{-- HEADER TRÊN CÙNG --}}
<header class="bg-dark text-white py-2 px-3 d-flex align-items-center justify-content-between sticky-top" style="z-index:1030;">
    <div class="d-flex align-items-center gap-2">
        {{-- Nút mở sidebar trên mobile --}}
        <button class="btn btn-sm btn-outline-light d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="bi bi-list"></i>
        </button>

        {{-- Logo --}}
        <a href="{{ route('admin.dashboard') }}" class="text-white fw-semibold text-decoration-none">
            Admin Panel
        </a>
    </div>

    {{-- User --}}
    <div class="d-flex align-items-center gap-2">
        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
    </div>
</header>


<div class="d-flex min-vh-100">

    {{-- SIDEBAR TRÁI - Offcanvas trên mobile, cố định trên desktop --}}
    <nav id="sidebar"
         class="offcanvas-lg offcanvas-start bg-dark text-white flex-shrink-0"
         style="width:240px;">

        <div class="offcanvas-header d-lg-none">
            <h5 class="offcanvas-title text-white">Menu quản trị</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column h-100 p-lg-0">

            {{-- Brand desktop --}}
            <div class="p-3 border-bottom border-secondary d-none d-lg-block">
                <span class="navbar-brand text-white fw-semibold">
                    <i class="bi bi-speedometer2 me-2"></i>Quản trị
                </span>
            </div>

            {{-- MENU --}}
            <ul class="nav nav-pills flex-column mb-auto mt-2">
                <li><a class="nav-link text-white" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam me-2"></i>Sản phẩm</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.product-categories.index') }}"><i class="bi bi-card-list me-2"></i>Danh mục SP</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.brands.index') }}"><i class="bi bi-tags me-2"></i>Thương hiệu</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.posts.index') }}"><i class="bi bi-journal-text me-2"></i>Bài viết</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.post-categories.index') }}"><i class="bi bi-list-ul me-2"></i>Danh mục bài viết</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.comments.index') }}"><i class="bi bi-chat-dots me-2"></i>Bình luận</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.banners.index') }}"><i class="bi bi-image me-2"></i>Banner</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.orders.index') }}"><i class="bi bi-bag-check me-2"></i>Đơn hàng</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i>Tài khoản</a></li>
                <li><a class="nav-link text-white" href="{{ route('admin.media.index') }}"><i class="bi bi-collection-play me-2"></i>Media</a></li>
                <li><a class="nav-link text-white" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right me-2"></i>Xem website</a></li>
            </ul>

            {{-- Logout --}}
            <div class="mt-auto px-3 pb-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-light w-100">
                        <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- MAIN CONTENT (được đẩy xuống dưới header) --}}
    <main class="flex-grow-1 w-100 overflow-hidden">
        <div class="container-fluid py-4">
            <div class="bg-white p-4 rounded shadow-sm">
                @include('partials.alerts')
                @yield('content')
            </div>
        </div>
    </main>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stack('scripts')
</body>
</html>
