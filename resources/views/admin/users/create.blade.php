@extends('layouts.admin')

@section('title', 'Thêm tài khoản')

@section('content')
    <h1 class="h4 mb-3">Thêm tài khoản</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @include('admin.users._form', ['user' => null])
    </form>
@endsection
