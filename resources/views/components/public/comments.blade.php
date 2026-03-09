@props(['commentable', 'type'])

<section class="mt-5 section-block product-detail-wrapper">
    <h3 class="h5 mb-3">Bình luận ({{ $commentable->comments->count() }})</h3>
    <div class="mb-4">
        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="card card-body shadow-sm mb-4">
                @csrf
                <input type="hidden" name="commentable_type" value="{{ $type }}">
                <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
                <label class="form-label">Chia sẻ cảm nhận của bạn</label>
                <textarea name="content" class="form-control mb-3" rows="3" required placeholder="Nội dung bình luận..."></textarea>
                <button class="btn btn-primary">Gửi bình luận</button>
            </form>
        @else
            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
        @endauth
        <div class="list-group">
            @forelse($commentable->comments as $comment)
            <!-- Bình luận chính -->
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-5"></i>
                    <strong>{{ optional($comment->user)->name ?? 'Người dùng' }}</strong>
                </div>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-2">{{ $comment->content }}</p>

                @foreach($comment->replies as $reply)
                <!-- Trả lời bình luận -->
                <div class="ms-4 ps-3 border-start">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-6"></i>
                        <strong>{{ optional($reply->user)->name ?? 'Quản trị viên' }}</strong>
                        </div>
                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }} </small>
                    </div>
                        <p class="mb-1">{{ $reply->content }}</p>
                </div>
                @endforeach
            </div>
            @empty
            <p class="text-muted">Chưa có bình luận nào.</p>
            @endforelse
        </div>
    </div>
</section>
