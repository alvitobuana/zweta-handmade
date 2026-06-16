@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm flex items-center gap-3">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm shadow-sm flex items-center gap-3">
            <span>⚠️</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid lg:grid-cols-2 gap-12 mb-16">
        <!-- Image Section -->
        <div>
            <div class="bg-gradient-to-br from-soft-beige to-cream rounded-2xl h-96 flex items-center justify-center mb-6 shadow-lg overflow-hidden">
                @if ($product->image)
                    <img src="{{ str_starts_with($product->image, 'uploads/') ? asset($product->image) : Storage::url($product->image) }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                @else
                    <svg class="w-24 h-24 text-caramel opacity-30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4a3 3 0 016 0v12a3 3 0 11-6 0V4z"/>
                    </svg>
                @endif
            </div>
            <div class="flex gap-3">
                @for ($i=0;$i<4;$i++)
                    <div class="w-20 h-20 bg-soft-beige rounded-xl border-2 border-transparent hover:border-caramel cursor-pointer transition"></div>
                @endfor
            </div>
        </div>

        <!-- Product Info Section -->
        <div>
            <!-- Breadcrumb -->
            <div class="text-sm text-gray-600 mb-4">
                <a href="{{ route('home') }}" class="hover:text-caramel">Home</a> / 
                <a href="{{ route('katalog') }}" class="hover:text-caramel">Katalog</a> / 
                <span class="text-dark-brown">{{ $product->name ?? 'Product' }}</span>
            </div>

            <h1 class="text-4xl lg:text-5xl font-serif text-dark-brown mb-4">{{ $product->name ?? 'Product' }}</h1>
            
            <!-- Price & Status -->
            <div class="flex items-center gap-6 mb-6 pb-6 border-b-2 border-soft-beige">
                <span class="text-3xl font-semibold text-caramel">Rp {{ number_format($product->price ?? 0,0,',','.') }}</span>
                <x-badge :type="($product->status ?? 'ready')">{{ ucfirst($product->status ?? 'ready') }}</x-badge>
            </div>

            <!-- Description -->
            <p class="text-gray-700 text-lg leading-relaxed mb-8">{{ $product->description ?? 'Produk berkualitas tinggi dibuat dengan penuh perhatian terhadap detail.' }}</p>

            <!-- Product Details -->
            <div class="bg-soft-beige rounded-xl p-6 mb-8">
                <h3 class="font-semibold text-dark-brown mb-4">Spesifikasi Produk</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stok Tersedia</span>
                        @if(($product->stock ?? 0) <= 0)
                            <span class="font-bold text-red-600">Habis Terjual</span>
                        @else
                            <span class="font-semibold text-dark-brown">{{ $product->stock }} pcs</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="font-semibold text-caramel">
                            @if(($product->stock ?? 0) <= 0)
                                Out of Stock
                            @else
                                {{ ucfirst($product->status ?? 'ready') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Waktu Produksi</span>
                        <span class="font-semibold text-dark-brown">3-7 hari kerja</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                @if(($product->stock ?? 0) <= 0)
                    <button disabled class="flex-1 px-6 py-3 bg-gray-200 text-gray-400 border border-gray-300 rounded-full font-semibold cursor-not-allowed shadow-none text-center flex items-center justify-center gap-2">
                        ❌ Stok Habis
                    </button>
                @else
                    @guest
                        <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" class="flex-1 px-6 py-3 bg-caramel text-white rounded-full font-semibold hover:bg-opacity-90 transition shadow-lg text-center flex items-center justify-center">
                            🛒 Pesan Sekarang
                        </a>
                    @else
                        <form action="{{ route('product.order', $product->slug) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-6 py-3 bg-caramel text-white rounded-full font-semibold hover:bg-opacity-90 transition shadow-lg">
                                🛒 Pesan Sekarang
                            </button>
                        </form>
                    @endguest
                @endif
                <a href="{{ route('custom') }}" class="flex-1 px-6 py-3 border-2 border-caramel text-caramel rounded-full font-semibold hover:bg-caramel hover:text-white transition text-center flex items-center justify-center">
                    🎨 Ajukan Custom
                </a>
            </div>

            <!-- Share & Wishlist -->
            <div class="flex gap-4">
                <button id="wishlist-btn" onclick="toggleWishlist()" class="flex-1 py-2.5 border border-gray-300 rounded-full hover:border-caramel hover:text-caramel transition flex items-center justify-center gap-2 font-medium bg-white text-dark-brown">
                    <svg id="wishlist-icon" class="w-5 h-5 text-gray-400 fill-none transition duration-300" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span id="wishlist-text">Wishlist</span>
                </button>
                <button onclick="shareProduct()" class="flex-1 py-2.5 border border-gray-300 rounded-full hover:border-caramel hover:text-caramel transition flex items-center justify-center gap-2 font-medium bg-white text-dark-brown">
                    <svg class="w-5 h-5 text-gray-500 transition duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 10.742l4.628-2.645m0 3.806l-4.628-2.645M19.5 12a3 3 0 11-6 0 3 3 0 016 0zm-7-5a3 3 0 11-6 0 3 3 0 016 0zm0 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Bagikan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Timeline Section -->
    <div class="bg-gradient-to-r from-soft-beige to-cream rounded-2xl px-8 lg:px-12 py-12 mb-16">
        <h2 class="text-2xl font-serif text-dark-brown mb-8">Tahapan Produksi</h2>
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
                    <p class="font-semibold text-dark-brown">{{ $event['title'] }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $event['date'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="mb-16">
        <h2 class="text-2xl font-serif text-dark-brown mb-6">Ulasan Pelanggan</h2>
        <div class="grid md:grid-cols-2 gap-6">
            @for ($i = 0; $i < 2; $i++)
                <div class="bg-white border-2 border-soft-beige rounded-xl p-6 hover:border-caramel transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-caramel flex items-center justify-center text-white font-semibold">
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

@push('scripts')
<script>
    const productId = '{{ $product->id }}';
    const productName = '{{ addslashes($product->name) }}';

    document.addEventListener('DOMContentLoaded', () => {
        const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
        if (wishlist.includes(productId)) {
            setWishlistedState(true);
        }
    });

    function toggleWishlist() {
        let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
        const index = wishlist.indexOf(productId);
        let status = false;

        if (index === -1) {
            wishlist.push(productId);
            status = true;
            showToast('❤️ ' + productName + ' ditambahkan ke Wishlist!');
        } else {
            wishlist.splice(index, 1);
            showToast('💔 ' + productName + ' dihapus dari Wishlist');
        }

        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        setWishlistedState(status);
    }

    function setWishlistedState(active) {
        const btn = document.getElementById('wishlist-btn');
        const icon = document.getElementById('wishlist-icon');
        const text = document.getElementById('wishlist-text');

        if (active) {
            icon.classList.remove('text-gray-400', 'fill-none');
            icon.classList.add('text-red-500', 'fill-current');
            text.innerText = 'Wishlisted';
            btn.classList.add('border-red-200', 'text-red-600');
        } else {
            icon.classList.remove('text-red-500', 'fill-current');
            icon.classList.add('text-gray-400', 'fill-none');
            text.innerText = 'Wishlist';
            btn.classList.remove('border-red-200', 'text-red-600');
        }
    }

    function shareProduct() {
        const url = window.location.href;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(() => {
                showToast('📤 Link produk berhasil disalin!');
            }).catch(err => {
                showToast('❌ Gagal menyalin link');
            });
        } else {
            // fallback
            const input = document.createElement('input');
            input.value = url;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showToast('📤 Link produk berhasil disalin!');
        }
    }

    function showToast(message) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-5 right-5 bg-dark-brown text-white px-6 py-3.5 rounded-2xl shadow-2xl flex items-center gap-3 z-50 transform translate-y-10 opacity-0 transition duration-300 ease-out border border-soft-beige/20 text-sm font-medium';
        toast.innerHTML = message;
        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
        }, 10);

        // Animate out and remove
        setTimeout(() => {
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
</script>
@endpush
