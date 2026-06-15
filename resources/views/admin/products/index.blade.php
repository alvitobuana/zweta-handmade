@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-serif">Kelola Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-[var(--caramel)] text-white rounded">+ Tambah Produk</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-6">
        @foreach($products as $p)
            <div class="card">
                {{-- Gambar produk atau placeholder --}}
                @if ($p->image)
                    <img src="{{ Storage::url($p->image) }}" alt="{{ $p->name }}"
                         class="h-36 w-full object-cover rounded mb-3">
                @else
                    <div class="h-36 bg-[var(--soft-beige)] rounded mb-3 flex items-center justify-center text-gray-400 text-xs">
                        Belum ada foto
                    </div>
                @endif
                <h3 class="font-medium">{{ $p->name }}</h3>
                <p class="text-sm text-gray-600">Stok: {{ $p->stock ?? '-' }} • Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                <span class="text-xs px-2 py-0.5 rounded-full mt-1 inline-block
                    @if($p->status == 'ready') bg-green-100 text-green-700
                    @elseif($p->status == 'pre-order') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-600 @endif">
                    {{ $p->status ?? 'ready' }}
                </span>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('admin.products.edit', $p->id) }}" class="px-3 py-1 border rounded text-sm">Edit</a>
                    <form action="{{ route('admin.products.destroy', $p->id) }}" method="post"
                          onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 border border-red-300 text-red-600 rounded text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @if ($products->hasPages())
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
@endsection
