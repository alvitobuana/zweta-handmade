@extends('layouts.app')

@section('title', 'Edit Profil - Zweta Handmade')

@section('content')

<div class="max-w-lg mx-auto">

    <!-- Page Title -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-serif font-bold text-dark-brown">Edit Profil</h1>
        <p class="text-gray-500 mt-2">Perbarui data diri dan alamat pengiriman pelanggan.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-soft-beige/40">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-dark-brown mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" required
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-dark-brown mb-1.5">Email</label>
                <input type="email" name="email" required
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300">
            </div>

            <!-- Nomor WhatsApp -->
            <div>
                <label class="block text-sm font-semibold text-dark-brown mb-1.5">Nomor WhatsApp</label>
                <input type="text" name="whatsapp"
                       value="{{ old('whatsapp', $user->whatsapp) }}"
                       placeholder="0812-xxxx-xxxx"
                       class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300">
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-semibold text-dark-brown mb-1.5">Alamat / Catatan</label>
                <textarea name="address" rows="3"
                          placeholder="Masukkan alamat lengkap untuk pengiriman pesanan..."
                          class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300 resize-none">{{ old('address', $user->address) }}</textarea>
            </div>

            <!-- Password (opsional) -->
            <div class="pt-2 border-t border-soft-beige/50">
                <p class="text-xs text-gray-400 mb-3 font-medium">Ganti Password (opsional — kosongkan jika tidak ingin mengubah)</p>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-dark-brown mb-1.5">Password Baru</label>
                        <input type="password" name="password"
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-dark-brown mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border-2 border-soft-beige rounded-xl focus:outline-none focus:border-caramel text-sm text-dark-brown transition placeholder-gray-300">
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-2">
                <a href="{{ route('profile') }}"
                   class="flex-1 py-3 text-center border-2 border-soft-beige text-dark-brown font-semibold rounded-xl hover:bg-soft-beige transition text-sm">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 py-3 bg-caramel text-white font-semibold rounded-xl hover:bg-opacity-90 transition shadow-md text-sm">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection