@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-dark-brown to-caramel text-white rounded-3xl px-8 lg:px-12 py-12 mb-12">
        <h1 class="text-4xl lg:text-5xl font-serif mb-2">Katalog Lengkap</h1>
        <p class="text-lg text-gray-100">Jelajahi koleksi tas handmade eksklusif kami</p>
    </div>

    <!-- Filter & Search Section -->
    <form action="{{ route('katalog') }}" method="GET" class="mb-10 flex flex-col sm:flex-row gap-4 items-center justify-between w-full">
        <div class="flex-1 w-full relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tas..." class="w-full px-5 py-3 pr-12 border-2 border-caramel rounded-full focus:outline-none focus:border-dark-brown text-dark-brown placeholder-gray-400 bg-white">
            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-caramel hover:text-dark-brown transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </div>
        <div class="flex flex-wrap gap-3 w-full sm:w-auto">
            <select name="category" onchange="this.form.submit()" class="px-4 py-3 border-2 border-caramel rounded-full focus:outline-none text-dark-brown bg-white cursor-pointer font-medium hover:border-dark-brown transition">
                <option value="">Semua Kategori</option>
                <option value="Sling Bag" @selected(request('category') == 'Sling Bag')>Sling Bag</option>
                <option value="Backpack" @selected(request('category') == 'Backpack')>Backpack</option>
                <option value="Totebag" @selected(request('category') == 'Totebag')>Tote Bag</option>
            </select>
            <select name="status" onchange="this.form.submit()" class="px-4 py-3 border-2 border-caramel rounded-full focus:outline-none text-dark-brown bg-white cursor-pointer font-medium hover:border-dark-brown transition">
                <option value="">Semua Status</option>
                <option value="ready" @selected(request('status') == 'ready')>Ready</option>
                <option value="pre-order" @selected(request('status') == 'pre-order')>Pre-Order</option>
                <option value="custom" @selected(request('status') == 'custom')>Custom</option>
            </select>
            <select name="sort" onchange="this.form.submit()" class="px-4 py-3 border-2 border-caramel rounded-full focus:outline-none text-dark-brown bg-white cursor-pointer font-medium hover:border-dark-brown transition">
                <option value="">Urutkan</option>
                <option value="newest" @selected(request('sort') == 'newest')>Terbaru</option>
                <option value="price-low" @selected(request('sort') == 'price-low')>Harga Termurah</option>
                <option value="price-high" @selected(request('sort') == 'price-high')>Harga Termahal</option>
            </select>
        </div>
    </form>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        @forelse($products as $p)
            <x-card :title="$p->name" :price="'Rp '.number_format($p->price,0,',','.')" :href="route('product.show', $p->slug)" :status="$p->status" :image="$p->image" :stock="$p->stock" />
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-xl text-gray-600">Tidak ada produk tersedia</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-12">
        {{ $products->links('partials.pagination') }}
    </div>
@endsection
