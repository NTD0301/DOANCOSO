@extends('layouts.public')

@section('title', $post->title)

@section('content')
<section class="section-block">
    <div class="row">
        <div class="col-lg-12">
            <article class="mb-4">
                <h1 class="h2">{{ $post->title }}</h1>
                <p class="text-muted">
                    <span class="badge bg-light text-dark">{{ $post->category->name ?? 'Tin tức' }}</span>
                    {{ $post->author }} - {{ optional($post->published_at)->format('d/m/Y') }}
                </p>
                <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/900x400' }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                <div class="article-content">
                    {!! $post->content !!}
                </div>
            </article>
        </div>
    </div>
</section>

<x-public.comments :commentable="$post" type="post"></x-public.comments>


<!-- Bài viết -->
<section class="section-block">
  <div class="section-header">
    <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
      <span class="section-header-inner">
        <i class="bi bi-gift"></i>
        <div class="d-flex flex-column">
          <span class="section-header-title">Bài viết mới</span>
        </div>
      </span>
      <span class="border-top flex-grow-1" style="max-width: 100px"></span>
    </div>
  </div>
  <div class="row g-4">
    @forelse($latest as $post)
    <div class="col-12 col-sm-6 col-md-3">
      <x-public.post-card :post="$post" />
    </div>
    @empty
    <div class="col-12">
      <div class="empty-state">Chưa có bài viết.</div>
    </div>
    @endforelse
  </div>
</section>
@endsection
