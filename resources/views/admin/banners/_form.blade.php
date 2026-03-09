@csrf
<div class="mb-3">
    <label class="form-label">Tiêu đề</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Liên kết</label>
    <input type="url" name="url" class="form-control" value="{{ old('url', $banner->url ?? '') }}">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Thứ tự</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="is_active" class="form-select">
            <option value="1" @selected(old('is_active', $banner->is_active ?? true))>Hiển thị</option>
            <option value="0" @selected(!old('is_active', $banner->is_active ?? true))>Ẩn</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Banner Small</label>
        <select name="is_small" class="form-select">
            <option value="0" @selected(!old('is_small', $banner->is_small ?? true))>Banner</option>
            <option value="1" @selected(old('is_small', $banner->is_small ?? true))>Banner Small</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Ảnh banner *</label>
    <input type="file" name="image" class="form-control" @if(empty($banner)) required @endif>
    @if(!empty($banner->image))
        <img src="{{ asset('storage/'.$banner->image) }}" class="img-thumbnail mt-2" width="240">
    @endif
</div>
<button class="btn btn-primary">Lưu</button>
