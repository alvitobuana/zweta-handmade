@extends('layouts.app')

@section('title', 'Hubungi Kami - Zweta Handmade')

@section('content')

<!-- Page Title -->
<div class="mb-10">
    <h1 class="text-4xl font-serif font-bold text-dark-brown">Hubungi Kami</h1>
    <p class="text-gray-500 mt-2">Hubungi Zweta Handmade untuk konsultasi pesanan custom, katalog produk, dan informasi pembayaran.</p>
</div>

<!-- Main Grid -->
<div class="grid lg:grid-cols-2 gap-8 mb-8">

    <!-- LEFT: Contact Info -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-soft-beige/40 space-y-6">

        <!-- WhatsApp -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600 text-lg shrink-0">📱</div>
            <div>
                <h4 class="font-bold text-dark-brown mb-0.5">WhatsApp</h4>
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="text-gray-600 text-sm hover:text-caramel transition">
                    0812-3456-7890
                </a>
            </div>
        </div>

        <div class="border-t border-soft-beige/50"></div>

        <!-- Email -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-lg shrink-0">✉️</div>
            <div>
                <h4 class="font-bold text-dark-brown mb-0.5">Email</h4>
                <a href="mailto:zwetahandmade@gmail.com"
                   class="text-gray-600 text-sm hover:text-caramel transition">
                    zwetahandmade@gmail.com
                </a>
            </div>
        </div>

        <div class="border-t border-soft-beige/50"></div>

        <!-- Instagram -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-pink-100 flex items-center justify-center text-pink-600 text-lg shrink-0">📸</div>
            <div>
                <h4 class="font-bold text-dark-brown mb-0.5">Instagram</h4>
                <a href="https://instagram.com/zwetahandmade" target="_blank"
                   class="text-gray-600 text-sm hover:text-caramel transition">
                    @zwetahandmade
                </a>
            </div>
        </div>

        <div class="border-t border-soft-beige/50"></div>

        <!-- Alamat -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 text-lg shrink-0">📍</div>
            <div>
                <h4 class="font-bold text-dark-brown mb-0.5">Alamat Workshop</h4>
                <p class="text-gray-600 text-sm">Bekasi, Jawa Barat</p>
            </div>
        </div>
    </div>

    <!-- RIGHT: Map Placeholder -->
    <div class="bg-soft-beige/60 rounded-3xl border border-soft-beige flex flex-col items-center justify-center min-h-64 p-10 text-center">
        <div class="text-5xl mb-4">🗺️</div>
        <p class="font-semibold text-caramel text-sm">Google Maps / Lokasi Workshop</p>
        <p class="text-gray-400 text-xs mt-2">Area ini bisa diganti embed maps saat implementasi web.</p>
    </div>
</div>

<!-- Note Card -->
<div class="bg-white rounded-2xl border border-soft-beige/40 shadow-sm p-6">
    <div class="flex items-start gap-3">
        <span class="text-xl">💡</span>
        <div>
            <h3 class="font-semibold text-dark-brown mb-1">Catatan</h3>
            <p class="text-gray-500 text-sm">Untuk pesanan custom, pelanggan dapat mengirim referensi warna/model melalui halaman <a href="{{ route('custom') }}" class="text-caramel hover:underline font-medium">Custom Order</a>.</p>
        </div>
    </div>
</div>

@endsection