@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Kelola Produk</h1>
    <div class="grid grid-cols-3 gap-6">
        @foreach(
            App\Models\Product::all() as $p)
            <div class="card">
                <div class="h-28 bg-soft-beige rounded mb-3"></div>
                <h3 class="font-medium">{{ $p->name }}</h3>
                <p class="text-sm">Stok: {{ $p->stock }} • Rp {{ number_format($p->price,0,',','.') }}</p>
                <div class="mt-3"><a href="#" class="px-3 py-1 border rounded">Edit</a></div>
            </div>
        @endforeach
    </div>
@endsection
