@csrf
<div class="mb-3">
    <label class="form-label">Họ tên *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Vai trò *</label>
    <select name="role" class="form-select" required>
        <option value="user" @selected(old('role', $user->role ?? 'user')==='user')>Khách hàng</option>
        <option value="admin" @selected(old('role', $user->role ?? 'user')==='admin')>Quản trị</option>
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Mật khẩu {{ empty($user) ? '*' : '' }}</label>
    <input type="password" name="password" class="form-control" @if(empty($user)) required @endif>
    @if(!empty($user))
        <small class="text-muted">Để trống nếu không thay đổi.</small>
    @endif
</div>
<div class="mb-3">
    <label class="form-label">Xác nhận mật khẩu {{ empty($user) ? '*' : '' }}</label>
    <input type="password" name="password_confirmation" class="form-control" @if(empty($user)) required @endif>
</div>
<button class="btn btn-primary">Lưu</button>
