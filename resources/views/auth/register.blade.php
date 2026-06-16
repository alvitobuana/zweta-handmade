@extends('layouts.app')

@section('title', 'Daftar Akun — Zweta Handmade')

@section('content')
    <div class="min-h-[60vh] flex items-center justify-center py-12">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                {{-- Header --}}
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-serif text-dark-brown mb-2">Buat Akun</h1>
                    <p class="text-gray-500">Bergabung dengan komunitas Zweta Handmade</p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('register.post') }}" method="post" class="space-y-5">
                    @csrf
                    @if(request('redirect'))
                        <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input name="name" type="text"
                               class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-caramel transition"
                               placeholder="Nama kamu"
                               value="{{ old('name') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email" type="email"
                               class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-caramel transition"
                               placeholder="email@kamu.com"
                               value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input name="password" type="password"
                               class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-caramel transition"
                               placeholder="Minimal 6 karakter">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input name="password_confirmation" type="password"
                               class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-caramel transition"
                               placeholder="Ulangi password">
                    </div>
                    <button type="submit"
                            class="w-full py-3 bg-caramel text-white rounded-xl font-semibold hover:bg-opacity-90 transition shadow-md">
                        Daftar Sekarang
                    </button>
                </form>

                {{-- Divider --}}
                <div class="my-6 flex items-center gap-4">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-sm text-gray-400">atau</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Login Link --}}
                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}{{ request('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}" class="text-caramel font-semibold hover:underline">Masuk di sini</a>
                </p>
            </div>

            {{-- Back to home --}}
            <p class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-caramel transition">← Kembali ke beranda</a>
            </p>
        </div>
    </div>
@endsection
