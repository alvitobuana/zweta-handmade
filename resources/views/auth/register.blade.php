@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg p-6">
        <h1 class="text-2xl font-serif mb-4">Register User</h1>
        <form action="{{ route('register.post') }}" method="post" class="space-y-4">
            @csrf
            <input name="name" class="border rounded p-3 w-full" placeholder="Nama Lengkap" value="{{ old('name') }}">
            <input name="email" class="border rounded p-3 w-full" placeholder="Email" value="{{ old('email') }}">
            <input name="password" class="border rounded p-3 w-full" placeholder="Password" type="password">
            <input name="password_confirmation" class="border rounded p-3 w-full" placeholder="Konfirmasi Password" type="password">
            <button class="w-full px-4 py-2 bg-[--caramel] text-white rounded">Daftar</button>
        </form>
    </div>
@endsection
