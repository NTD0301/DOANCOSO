@props(['post'])

<article class="card h-100 d-flex flex-column">
    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark h-100 d-flex flex-column">
        {{-- Hình ảnh --}}
        <img 
            src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/600x360?text=Post' }}" 
            alt="{{ $post->title }}" 
            class="card-img-top img-fluid"
        >

        {{-- Nội dung --}}
        <div class="card-body d-flex flex-column flex-grow-1">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-light text-dark">
                    {{ $post->category->name ?? 'Tin tức' }}
                </span>
                <small class="text-muted">
                    {{ optional($post->published_at)->format('d/m/Y') }}
                </small>
            </div>

            <div class="card-title">{{ Str::limit($post->title, 100) }}</div>
            {{-- <p class="card-text text-muted flex-grow-1">
                {{ Str::limit($post->excerpt, 50) }}
            </p> --}}

            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary mt-auto">Đọc tiếp</a>
        </div>
    </a>
</article>
