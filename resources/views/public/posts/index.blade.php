@extends('layouts.public')

@section('title', 'Bài viết')

@section('content')
<section class="section-block">

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card mt-3 shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span class="fw-semibold">
                        <i class="bi bi-list-ul me-1"></i> Danh mục bài viết
                    </span>


                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#categoryTree" aria-expanded="true" aria-controls="categoryTree">
                        <i class="bi bi-chevron-up"></i>
                    </button>
                </div>


                <div class="collapse show" id="categoryTree">
                    <div class="card-body p-2">
                        <ul class="list-unstyled mb-1">
                            <li class="mb-1">
                                <a href="{{ route('posts.index') }}"
                                    class="d-block rounded px-2 py-1 text-decoration-none 
                                    {{ request('category') === null ? 'bg-primary text-white' : 'text-body' }}">
                                    <i class="bi bi-grid-fill small me-1"></i>
                                    <span class="small">Tất cả</span>
                                </a>
                            </li>
                        </ul>


                        <ul class="list-unstyled mb-0 ">
                            @foreach($categories as $category)
                            <li class="mb-1">
                                <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
                                    class="d-flex align-items-center justify-content-between rounded px-2 py-1 text-decoration-none
                                    {{ request('category') === $category->slug ? 'bg-primary text-white' : 'text-body' }}">
                                    <span class="d-inline-flex align-items-center gap-2">
                                        <i class="bi bi-folder small"></i>
                                        <span class="small">{{ $category->name}}
                                        </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($posts as $post)
                <div class="col-12 col-sm-6 col-md-3">
                    <x-public.post-card :post="$post" />
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">Chưa có bài viết.</div>
                </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>
@endsection