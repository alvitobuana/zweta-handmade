@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[--soft-beige] to-[--cream] rounded-3xl px-8 lg:px-16 py-16 lg:py-24 mb-16">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-[--caramel] tracking-widest mb-3">✨ HANDMADE WITH LOVE</p>
                <h1 class="text-5xl lg:text-6xl font-serif text-[--dark-brown] mb-6 leading-tight">Tas Handmade Custom dengan Sentuhan Personal</h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">Setiap tas dibuat dengan detail dan penuh ketelitian untuk menemani momen berharga Anda.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('katalog') }}" class="px-8 py-3 bg-[--caramel] text-white rounded-full font-semibold hover:bg-opacity-90 transition shadow-lg">Lihat Katalog</a>
                    <a href="{{ route('custom') }}" class="px-8 py-3 border-2 border-[--caramel] text-[--caramel] rounded-full font-semibold hover:bg-[--caramel] hover:text-white transition">Buat Custom</a>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <div class="relative w-full max-w-md h-80 bg-gradient-to-br from-[--caramel] to-[--dusty-pink] rounded-3xl shadow-2xl flex items-center justify-center">
                    <svg class="w-32 h-32 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4a3 3 0 016 0v12a3 3 0 11-6 0V4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="mb-20">
        <div class="mb-10">
            <p class="text-[--caramel] font-semibold mb-2">KOLEKSI TERBAIK</p>
            <h2 class="text-4xl lg:text-5xl font-serif text-[--dark-brown]">Produk Unggulan</h2>
            <p class="text-gray-600 mt-3">Pilihan tas terpopuler dengan kualitas terbaik</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($featured) && $featured->count())
                @foreach($featured as $p)
                    <x-card :title="$p->name" :price="'Rp '.number_format($p->price,0,',','.')" :href="route('product.show', $p->slug)" :status="$p->status" :image="$p->image" />
                @endforeach
            @else
                @for ($i = 0; $i < 4; $i++)
                    <x-card title="Tote Terra" price="Rp 125.000" href="{{ route('product.show', 'tote-terra') }}" />
                @endfor
            @endif
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="bg-[--dark-brown] text-white rounded-3xl px-8 lg:px-16 py-16 mb-16">
        <h2 class="text-3xl lg:text-4xl font-serif mb-12 text-center">Mengapa Memilih Kami?</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="text-center">
                <div class="text-5xl mb-4">🎯</div>
                <h3 class="text-xl font-semibold mb-3">Kualitas Premium</h3>
                <p class="text-gray-300">Menggunakan bahan berkualitas tinggi dan proses produksi yang teliti</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold mb-3">Pengiriman Cepat</h3>
                <p class="text-gray-300">Pesanan diproses dan dikirim dengan cepat ke seluruh Indonesia</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">🎨</div>
                <h3 class="text-xl font-semibold mb-3">Customizable</h3>
                <p class="text-gray-300">Buat desain tas impian Anda dengan pilihan warna dan model</p>
            </div>
        </div>
    </section>

@endsection
