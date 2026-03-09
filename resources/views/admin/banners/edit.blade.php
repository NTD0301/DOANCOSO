@extends('layouts.admin')

@section('title', 'Chỉnh sửa banner')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa banner</h1>
    <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.banners._form', ['banner' => $banner])
    </form>
@endsection
