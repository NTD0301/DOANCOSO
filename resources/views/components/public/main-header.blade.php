<header class="main-header py-2">
  <div class="container">
    <div class="row g-3 align-items-center">

      <!-- Logo -->
      <div class="col-3 col-md-2 col-lg-3 d-flex align-items-center gap-2">
        <button 
          class="btn text-white p-0 fs-3"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebarMenu"
          aria-controls="sidebarMenu"
        >
          <i class="bi bi-list"></i>
        </button>
        <a
          href="{{ route('home') }}"
          class="d-flex align-items-center gap-2 text-decoration-none text-white"
        >
          <i class="bi bi-cake2 fs-2"></i>
          <div class="logo-text d-none d-lg-inline">{{ config('app.name') }}</div>
        </a>
      </div>

      <!-- Search -->
      <div class="col d-md-block col-md-8 col-lg-6">
        <form class="search-box d-flex" method="GET" action="{{ route('products.index') }}">
          <input
            name="q"
            type="text"
            class="form-control form-control-sm"
            placeholder="Nhập từ khóa..."
          />
          <button class="btn btn-sm px-3" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>

      <!-- Icons -->
      <div class="col-auto col-md-2 col-lg-3 d-flex justify-content-end align-items-center gap-3">

        <!-- ACCOUNT DROPDOWN -->
        <div class="dropdown header-account">
            <a 
                href="#" 
                class="header-icon d-flex align-items-center gap-1 dropdown-toggle" 
                id="accountDropdown" 
                data-bs-toggle="dropdown" 
                aria-expanded="false"
            >
                <i class="bi bi-person"></i>
                <span class="d-none d-lg-inline">Tài khoản</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="accountDropdown">
            @auth
                <div class="px-3 py-2 border-bottom">
                    <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
                <form method="POST" action="{{ url('logout') }}" class="mb-0">
                    @csrf
                    <button class="dropdown-item w-100 text-start">
                        <i class="bi bi-box-arrow-left"></i> Đăng xuất
                    </button>
                </form>
            @else
                <a href="{{ url('login') }}" class="dropdown-item">
                    <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                </a>
                <a href="{{ url('register') }}" class="dropdown-item">
                    <i class="bi bi-person-plus"></i> Đăng ký
                </a>
            @endauth
            </div>
        </div>

        <a
          href="{{ route('cart.index') }}"
          class="header-icon position-relative d-flex align-items-center gap-1"
        >
          <i class="bi bi-cart3"></i>
          <span class="d-none d-lg-inline">Giỏ hàng</span>
          @if($cartCount > 0)
              <span class="badge bg-warning text-dark rounded-pill cart-badge">{{ $cartCount }}</span>
          @endif
        </a>

      </div>
    </div>
  </div>
</header>
