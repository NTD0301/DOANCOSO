@extends('layouts.public')

@section('title', 'Đăng nhập')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Đăng nhập</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.perform') }}" id="login-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <button class="btn btn-primary w-100">Đăng nhập</button>
                        <p class="text-center mt-3">Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#login-form').validate();
});
</script>
@endpush
