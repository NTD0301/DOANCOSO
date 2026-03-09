@extends('layouts.admin')

@section('title', 'Thêm banner')

@section('content')
    <h1 class="h4 mb-3">Thêm banner</h1>
    <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
        @include('admin.banners._form', ['banner' => null])
    </form>
@endsection
