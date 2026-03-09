@extends('layouts.admin')

@section('title', 'Thư viện ảnh')

@section('content')
    <h1 class="h4 mb-3">Thư viện ảnh</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-auto">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Tải lên</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row g-3">
        @forelse($files as $file)
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="{{ $file['url'] }}" class="card-img-top" alt="media">
                    <div class="card-body">
                        <p class="small text-muted">{{ $file['path'] }}</p>
                        <form method="POST" action="{{ route('admin.media.destroy') }}" onsubmit="return confirm('Xóa ảnh này?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="path" value="{{ $file['path'] }}">
                            <button class="btn btn-sm btn-outline-danger w-100">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Chưa có tập tin nào.</p>
        @endforelse
    </div>
@endsection
