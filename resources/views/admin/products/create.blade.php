@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Tambah Produk</h1>
    <div class="card max-w-2xl">
        <form action="{{ route('products.store') }}" method="post" class="space-y-4">
            @csrf
            <input name="name" class="border rounded p-3 w-full" placeholder="Nama Produk">
            <input name="slug" class="border rounded p-3 w-full" placeholder="slug-produk">
            <input name="price" class="border rounded p-3 w-full" placeholder="Harga">
            <input name="stock" class="border rounded p-3 w-full" placeholder="Stok">
            <textarea name="description" class="border rounded p-3 w-full" placeholder="Deskripsi"></textarea>
            <div class="flex gap-3">
                <button class="px-4 py-2 bg-caramel text-cream rounded">Simpan Produk</button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
