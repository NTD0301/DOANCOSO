@extends('layouts.admin')

@section('title', 'Chỉnh sửa thương hiệu')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $brand->name }}</h1>
    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.brands._form', ['brand' => $brand])
    </form>
@endsection
