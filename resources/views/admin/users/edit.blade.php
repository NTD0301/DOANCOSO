@extends('layouts.admin')

@section('title', 'Chỉnh sửa tài khoản')

@section('content')
    <h1 class="h4 mb-3">Chỉnh sửa: {{ $user->name }}</h1>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form', ['user' => $user])
    </form>
@endsection
