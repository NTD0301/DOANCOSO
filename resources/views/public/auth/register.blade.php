@extends('layouts.public')

@section('title', 'Đăng ký')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Tạo tài khoản</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register.perform') }}" id="register-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button class="btn btn-success w-100">Đăng ký</button>
                        <p class="text-center mt-3">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#register-form').validate({
        rules:{
            password:{ minlength:8 },
            password_confirmation:{ equalTo:'[name="password"]' }
        }
    });
});
</script>
@endpush
