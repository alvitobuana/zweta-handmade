@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-[--dark-brown] to-[--caramel] text-white rounded-3xl px-8 lg:px-12 py-12 mb-12">
        <h1 class="text-4xl lg:text-5xl font-serif mb-2">Katalog Lengkap</h1>
        <p class="text-lg text-gray-100">Jelajahi koleksi tas handmade eksklusif kami</p>
    </div>

    <!-- Filter & Search Section -->
    <div class="mb-10 flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div class="flex-1 w-full">
            <input type="text" placeholder="Cari tas..." class="w-full px-4 py-3 border-2 border-[--caramel] rounded-full focus:outline-none focus:border-[--dark-brown]">
        </div>
        <div class="flex gap-2">
            <select class="px-4 py-3 border-2 border-[--caramel] rounded-full focus:outline-none">
                <option value="">Semua Status</option>
                <option value="ready">Ready</option>
                <option value="pre-order">Pre-Order</option>
                <option value="custom">Custom</option>
            </select>
            <select class="px-4 py-3 border-2 border-[--caramel] rounded-full focus:outline-none">
                <option value="">Urutkan</option>
                <option value="newest">Terbaru</option>
                <option value="price-low">Harga Termurah</option>
                <option value="price-high">Harga Termahal</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        @forelse($products as $p)
            <x-card :title="$p->name" :price="'Rp '.number_format($p->price,0,',','.')" :href="route('product.show', $p->slug)" :status="$p->status" :image="$p->image" />
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-xl text-gray-600">Tidak ada produk tersedia</p>
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    <div class="text-center">
        <button class="px-8 py-3 border-2 border-[--caramel] text-[--caramel] rounded-full font-semibold hover:bg-[--caramel] hover:text-white transition">
            Muat Lebih Banyak
        </button>
    </div>

@endsection
