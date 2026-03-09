@csrf
<div class="mb-3">
    <label class="form-label">Tên thương hiệu *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug ?? '') }}">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Website</label>
        <input type="url" name="website" class="form-control" value="{{ old('website', $brand->website ?? '') }}" placeholder="https://...">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control">
        @if(!empty($brand->logo))
            <img src="{{ asset('storage/'.$brand->logo) }}" class="img-thumbnail mt-2" width="120">
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $brand->description ?? '') }}</textarea>
</div>
<button class="btn btn-primary">Lưu</button>
