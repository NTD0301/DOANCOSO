@csrf
<div class="mb-3">
    <label class="form-label">Tên sản phẩm *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Danh mục</label>
        <select name="product_category_id" class="form-select">
            <option value="">-- Chọn danh mục --</option>
            @foreach(($categories ?? []) as $id => $label)
                <option value="{{ $id }}" @selected(old('product_category_id', $product->product_category_id ?? '')==$id)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Thương hiệu / Nhà cung cấp</label>
        <select name="brand_id" class="form-select">
            <option value="">-- Chọn thương hiệu --</option>
            @foreach(($brands ?? []) as $id => $label)
                <option value="{{ $id }}" @selected(old('brand_id', $product->brand_id ?? '')==$id)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Mô tả *</label>
    <textarea name="description" class="form-control summernote" rows="5" required>{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Giá *</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Giảm giá (%)</label>
        <input type="number" name="sale_percentage" class="form-control" value="{{ old('sale_percentage', $product->sale_percentage ?? 0) }}" min="0" max="99">
        <small class="text-muted">Nhập từ 0 - 99 (%).</small>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Tồn kho</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Nổi bật</label>
        <select name="is_featured" class="form-select">
            <option value="0" @selected(old('is_featured', $product->is_featured ?? false)==false)>Không</option>
            <option value="1" @selected(old('is_featured', $product->is_featured ?? false)==true)>Có</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label d-block">Thư viện ảnh (tối đa 4 ảnh)</label>
    <div class="row g-3">
        @foreach(range(1,4) as $index)
            @php $field = 'image_'.$index; @endphp
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small">Ảnh {{ $index }}</label>
                <input type="file" name="{{ $field }}" class="form-control" accept="image/*">
                @if(!empty($product->$field))
                    <img src="{{ asset('storage/'.$product->$field) }}" class="img-thumbnail mt-2" width="160" alt="Ảnh {{ $index }}">
                @endif
            </div>
        @endforeach
    </div>
</div>
<button class="btn btn-primary">Lưu</button>
