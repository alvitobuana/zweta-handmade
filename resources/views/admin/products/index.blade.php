@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-serif">Kelola Produk</h1>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-caramel text-cream rounded">+ Tambah Produk</a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        @foreach($products as $p)
            <div class="card">
                <div class="h-28 bg-soft-beige rounded mb-3"></div>
                <h3 class="font-medium">{{ $p->name }}</h3>
                <p class="text-sm">Stok: {{ $p->stock }} • Rp {{ number_format($p->price,0,',','.') }}</p>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('products.edit', $p->id) }}" class="px-3 py-1 border rounded">Edit</a>
                    <form action="{{ route('products.destroy', $p->id) }}" method="post" onsubmit="return confirm('Hapus produk?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 border rounded">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
