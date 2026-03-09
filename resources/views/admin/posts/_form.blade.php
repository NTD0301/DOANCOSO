@csrf
<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Danh mục bài viết</label>
    <select name="post_category_id" class="form-select">
        <option value="">-- Chọn danh mục --</option>
        @foreach(($categories ?? []) as $id => $name)
            <option value="{{ $id }}" @selected(old('post_category_id', $post->post_category_id ?? '')==$id)>{{ $name }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tác giả *</label>
        <input type="text" name="author" class="form-control" value="{{ old('author', $post->author ?? auth()->user()->name) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Ngày đăng</label>
        <input type="date" name="published_at" class="form-control" value="{{ old('published_at', optional($post->published_at ?? null)->format('Y-m-d')) }}">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Trích đoạn</label>
    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Nội dung *</label>
    <textarea name="content" class="form-control summernote" rows="6" required>{{ old('content', $post->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Ảnh đại diện</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($post->image))
        <img src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail mt-2" width="160">
    @endif
</div>
<button class="btn btn-primary">Lưu</button>
