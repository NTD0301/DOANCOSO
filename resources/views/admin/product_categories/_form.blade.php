@csrf
<div class="mb-3">
    <label class="form-label">Tên danh mục *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug ?? '') }}" placeholder="tên-khong-dau">
</div>
<div class="mb-3">
    <label class="form-label">Danh mục cha</label>
    <select name="parent_id" class="form-select">
        <option value="">-- Không có --</option>
        @foreach(($parents ?? []) as $id => $label)
            <option value="{{ $id }}" @selected(old('parent_id', $category->parent_id ?? '')==$id)>{{ $label }}</option>
        @endforeach
    </select>
    <small class="text-muted">Hỗ trợ tối đa 3 cấp danh mục.</small>
</div>
<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<button class="btn btn-primary">Lưu</button>
