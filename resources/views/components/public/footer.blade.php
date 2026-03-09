<footer class="site-footer text-white mt-auto">
    <div class="container pt-5 pb-3">
        <div class="row g-4">
            <div class="col-md-3">
                <h5 class="fw-bold mb-3">{{ config('app.name') }}</h5>
                <p class="mb-1"><i class="bi bi-geo-alt"></i> 18A/1 Cộng Hòa, Phường Tân Sơn Nhất, Thành phố Hồ Chí Minh</p>
                <p class="mb-1"><i class="bi bi-telephone"></i> 02838449242</p>
                <p class="mb-0"><i class="bi bi-envelope"></i> hocvienhangkhong@gmail.com</p>
            </div>
            <div class="col-6 col-md-3">
                <h6 class="text-uppercase fw-bold mb-3">Sản phẩm</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('posts.index') }}">Bài viết</a></li>
                    <li><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <h6 class="text-uppercase fw-bold mb-3">Hỗ trợ</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Giao hàng & thanh toán</a></li>
                    <li><a href="#">Bảo mật thông tin</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center">
            <small>© {{ now()->year }}  Laravel. All rights reserved.</small>
        </div>
    </div>
</footer>
