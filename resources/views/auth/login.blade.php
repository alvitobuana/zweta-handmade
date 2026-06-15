@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg p-6">
        <h1 class="text-2xl font-serif mb-4">Login Calon Pembeli</h1>
        <form action="{{ route('login.post') }}" method="post" class="space-y-4">
            @csrf
            <input name="email" class="border rounded p-3 w-full" placeholder="Email" value="{{ old('email') }}">
            <input name="password" class="border rounded p-3 w-full" placeholder="Password" type="password">
            <button class="w-full px-4 py-2 bg-[--caramel] text-white rounded">Login</button>
        </form>
    </div>
@endsection
