@extends('layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
    <h1 class="h4 mb-3">Thêm thương hiệu / Nhà cung cấp</h1>
    <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
        @include('admin.brands._form', ['brand' => null])
    </form>
@endsection
