@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-serif text-dark-brown font-bold mb-2">Kelola Produk</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Actions -->
    <div class="mb-8">
        <p class="text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Search Produk</p>
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
            <input type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="Cari nama produk..." class="w-full max-w-sm px-4 py-2.5 text-xs bg-white border border-soft-beige rounded-xl focus:outline-none focus:border-caramel placeholder-gray-400">
            <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm text-center">
                + Tambah Produk
            </a>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $p)
            <div class="relative group bg-white border border-gray-100 rounded-3xl p-5 shadow-[0_4px_20px_rgba(28,20,16,0.015)] flex flex-col justify-between">
                <div>
                    <!-- Product Image Box -->
                    <div class="w-full h-40 bg-[#FAF0E6] rounded-2xl flex flex-col items-center justify-center overflow-hidden mb-4 relative">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                        @else
                            <!-- Minimalist SVG Bag Illustration -->
                            <svg class="w-14 h-14 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                                <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                                <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                            </svg>
                            <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-2">Foto</span>
                        @endif

                        <!-- Hover Delete Form -->
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="post" 
                              onsubmit="return confirm('Hapus produk {{ $p->name }}?')" 
                              class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center shadow-sm text-xs" title="Hapus Produk">
                                🗑️
                            </button>
                        </form>
                    </div>

                    <!-- Product Details -->
                    <h3 class="font-bold text-dark-brown text-base mb-1">{{ $p->name }}</h3>
                    <p class="text-xs text-gray-400 mb-5">
                        Stok: {{ $p->stock ?? '0' }} • Rp {{ number_format($p->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Actions row -->
                <div class="flex justify-between items-center mt-auto">
                    <!-- Status Badge -->
                    @if($p->status == 'ready' || !$p->status)
                        <span class="bg-[#E2F0D9] text-[#385723] px-3.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            Ready
                        </span>
                    @elseif($p->status == 'pre-order')
                        <span class="bg-[#FFF2CC] text-[#7F6000] px-3.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            Pre-Order
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-500 px-3.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            Custom
                        </span>
                    @endif

                    <!-- Edit Button -->
                    <a href="{{ route('admin.products.edit', $p->id) }}" class="px-5 py-1.5 border border-caramel/40 text-caramel rounded-xl text-xs font-semibold hover:bg-caramel hover:text-white transition">
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-gray-100">
                <p class="text-gray-400 text-sm">Tidak ada produk ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif
@endsection
