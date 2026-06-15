@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Edit Produk</h1>
    <div class="card max-w-2xl">
        <form action="{{ route('products.update', $product->id) }}" method="post" class="space-y-4">
            @csrf
            @method('PUT')
            <input name="name" class="border rounded p-3 w-full" value="{{ $product->name }}">
            <input name="slug" class="border rounded p-3 w-full" value="{{ $product->slug }}">
            <input name="price" class="border rounded p-3 w-full" value="{{ $product->price }}">
            <input name="stock" class="border rounded p-3 w-full" value="{{ $product->stock }}">
            <textarea name="description" class="border rounded p-3 w-full">{{ $product->description }}</textarea>
            <div class="flex gap-3">
                <button class="px-4 py-2 bg-caramel text-cream rounded">Simpan Produk</button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
