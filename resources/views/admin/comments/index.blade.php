@extends('layouts.admin')

@section('title', 'Quản lý bình luận')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-0">Quản lý bình luận</h1>
            <small class="text-muted">Duyệt và phản hồi bình luận người dùng.</small>
        </div>
        <form class="d-flex" method="GET">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Tất cả trạng thái --</option>
                <option value="pending" @selected(request('status')==='pending')>Chờ duyệt</option>
                <option value="approved" @selected(request('status')==='approved')>Đã duyệt</option>
                <option value="rejected" @selected(request('status')==='rejected')>Từ chối</option>
            </select>
        </form>
    </div>
    <div class="bg-white shadow-sm rounded p-3">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Nội dung</th>
                        <th>Đối tượng</th>
                        <th>Ngày</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>
                                <strong>{{ optional($comment->user)->name ?? 'Người dùng' }}</strong><br>
                                <small class="text-muted">{{ optional($comment->user)->email ?? 'N/A' }}</small>
                            </td>
                            <td>
                                {{ $comment->content }}
                                @if($comment->replies->isNotEmpty())
                                    <div class="mt-2">
                                        @foreach($comment->replies as $reply)
                                            <div class="border-start ps-2 small text-muted">
                                                <strong>{{ optional($reply->user)->name ?? 'Admin' }}:</strong> {{ $reply->content }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $target = $comment->commentable;
                                @endphp
                                @if($target instanceof \App\Models\Product)
                                    Sản phẩm: <a href="{{ route('products.show', $target) }}" target="_blank">{{ $target->name }}</a>
                                @elseif($target instanceof \App\Models\Post)
                                    Bài viết: <a href="{{ route('posts.show', $target) }}" target="_blank">{{ $target->title }}</a>
                                @else
                                    <em>Đã xóa</em>
                                @endif
                            </td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $comment->status === 'approved' ? 'success' : ($comment->status === 'rejected' ? 'danger' : 'warning text-dark') }}">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.comments.update', $comment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button class="btn btn-sm btn-outline-success" @disabled($comment->status==='approved')>Duyệt</button>
                                </form>
                                <form action="{{ route('admin.comments.update', $comment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn btn-sm btn-outline-warning" @disabled($comment->status==='rejected')>Từ chối</button>
                                </form>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bình luận này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                                <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="collapse" data-bs-target="#reply-{{ $comment->id }}">Trả lời</button>
                                <div class="collapse mt-2" id="reply-{{ $comment->id }}">
                                    <form action="{{ route('admin.comments.reply', $comment) }}" method="POST">
                                        @csrf
                                        <textarea name="content" class="form-control mb-2" rows="2" placeholder="Nhập nội dung trả lời" required></textarea>
                                        <button class="btn btn-sm btn-success">Gửi</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có bình luận.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $comments->links() }}
    </div>
@endsection
