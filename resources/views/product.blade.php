@extends('layouts.app')

@section('content')
    <div class="grid lg:grid-cols-2 gap-12 mb-16">
        <!-- Image Section -->
        <div>
            <div class="bg-gradient-to-br from-[--soft-beige] to-[--cream] rounded-2xl h-96 flex items-center justify-center mb-6 shadow-lg">
                <svg class="w-24 h-24 text-[--caramel] opacity-30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 4a3 3 0 016 0v12a3 3 0 11-6 0V4z"/>
                </svg>
            </div>
            <div class="flex gap-3">
                @for ($i=0;$i<4;$i++)
                    <div class="w-20 h-20 bg-[--soft-beige] rounded-xl border-2 border-transparent hover:border-[--caramel] cursor-pointer transition"></div>
                @endfor
            </div>
        </div>

        <!-- Product Info Section -->
        <div>
            <!-- Breadcrumb -->
            <div class="text-sm text-gray-600 mb-4">
                <a href="{{ route('home') }}" class="hover:text-[--caramel]">Home</a> / 
                <a href="{{ route('katalog') }}" class="hover:text-[--caramel]">Katalog</a> / 
                <span class="text-[--dark-brown]">{{ $product->name ?? 'Product' }}</span>
            </div>

            <h1 class="text-4xl lg:text-5xl font-serif text-[--dark-brown] mb-4">{{ $product->name ?? 'Product' }}</h1>
            
            <!-- Price & Status -->
            <div class="flex items-center gap-6 mb-6 pb-6 border-b-2 border-[--soft-beige]">
                <span class="text-3xl font-semibold text-[--caramel]">Rp {{ number_format($product->price ?? 0,0,',','.') }}</span>
                <x-badge :type="($product->status ?? 'ready')">{{ ucfirst($product->status ?? 'ready') }}</x-badge>
            </div>

            <!-- Description -->
            <p class="text-gray-700 text-lg leading-relaxed mb-8">{{ $product->description ?? 'Produk berkualitas tinggi dibuat dengan penuh perhatian terhadap detail.' }}</p>

            <!-- Product Details -->
            <div class="bg-[--soft-beige] rounded-xl p-6 mb-8">
                <h3 class="font-semibold text-[--dark-brown] mb-4">Spesifikasi Produk</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stok Tersedia</span>
                        <span class="font-semibold text-[--dark-brown]">{{ $product->stock ?? 0 }} pcs</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="font-semibold text-[--caramel]">{{ ucfirst($product->status ?? 'ready') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Waktu Produksi</span>
                        <span class="font-semibold text-[--dark-brown]">3-7 hari kerja</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <button class="flex-1 px-6 py-3 bg-[--caramel] text-white rounded-full font-semibold hover:bg-opacity-90 transition shadow-lg">
                    🛒 Pesan Sekarang
                </button>
                <a href="{{ route('custom') }}" class="flex-1 px-6 py-3 border-2 border-[--caramel] text-[--caramel] rounded-full font-semibold hover:bg-[--caramel] hover:text-white transition text-center">
                    🎨 Ajukan Custom
                </a>
            </div>

            <!-- Share & Wishlist -->
            <div class="flex gap-4">
                <button class="flex-1 py-2 border border-gray-300 rounded-full hover:border-[--caramel] transition flex items-center justify-center gap-2">
                    ❤️ Wishlist
                </button>
                <button class="flex-1 py-2 border border-gray-300 rounded-full hover:border-[--caramel] transition flex items-center justify-center gap-2">
                    📤 Bagikan
                </button>
            </div>
        </div>
    </div>

    <!-- Timeline Section -->
    <div class="bg-gradient-to-r from-[--soft-beige] to-[--cream] rounded-2xl px-8 lg:px-12 py-12 mb-16">
        <h2 class="text-2xl font-serif text-[--dark-brown] mb-8">Tahapan Produksi</h2>
        @php
            $events = [
                ['title'=>'Pesanan Diterima','date'=>'Hari 1','icon'=>'📋'],
                ['title'=>'Pembayaran Terverifikasi','date'=>'Hari 1','icon'=>'✅'],
                ['title'=>'Mulai Produksi','date'=>'Hari 2','icon'=>'🔨'],
                ['title'=>'Proses Finishing','date'=>'Hari 4','icon'=>'🎨'],
                ['title'=>'Siap Dikirim','date'=>'Hari 7','icon'=>'📦'],
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($events as $event)
                <div class="text-center">
                    <div class="text-4xl mb-3">{{ $event['icon'] }}</div>
                    <p class="font-semibold text-[--dark-brown]">{{ $event['title'] }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $event['date'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="mb-16">
        <h2 class="text-2xl font-serif text-[--dark-brown] mb-6">Ulasan Pelanggan</h2>
        <div class="grid md:grid-cols-2 gap-6">
            @for ($i = 0; $i < 2; $i++)
                <div class="bg-white border-2 border-[--soft-beige] rounded-xl p-6 hover:border-[--caramel] transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-[--caramel] flex items-center justify-center text-white font-semibold">
                            {{ substr('Pelanggan', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold">Pelanggan Puas</p>
                            <p class="text-sm text-yellow-500">⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"Kualitas tas sangat bagus, pengiriman cepat, dan pelayanan memuaskan. Akan pesan lagi!"</p>
                </div>
            @endfor
        </div>
    </section>

@endsection
