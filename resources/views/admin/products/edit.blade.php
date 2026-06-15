@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Edit Produk</h1>
    <div class="card max-w-2xl">
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1">Nama Produk</label>
                <input name="name" class="border rounded p-3 w-full" value="{{ old('name', $product->name) }}">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Slug (URL)</label>
                <input name="slug" class="border rounded p-3 w-full" value="{{ old('slug', $product->slug) }}">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Harga (Rp)</label>
                    <input name="price" type="number" min="0" class="border rounded p-3 w-full" value="{{ old('price', $product->price) }}">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Stok</label>
                    <input name="stock" type="number" min="0" class="border rounded p-3 w-full" value="{{ old('stock', $product->stock) }}">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="border rounded p-3 w-full">
                    <option value="ready"      {{ old('status', $product->status) == 'ready'      ? 'selected' : '' }}>Ready Stock</option>
                    <option value="pre-order"  {{ old('status', $product->status) == 'pre-order'  ? 'selected' : '' }}>Pre-Order</option>
                    <option value="custom"     {{ old('status', $product->status) == 'custom'     ? 'selected' : '' }}>Custom Only</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="border rounded p-3 w-full">{{ old('description', $product->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Foto Produk</label>
                @if ($product->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                             class="h-32 w-32 object-cover rounded border">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="border rounded p-3 w-full">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WebP. Maks: 2MB.</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button class="px-6 py-2 bg-[var(--caramel)] text-white rounded font-medium">Simpan Perubahan</button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border rounded text-gray-600">Batal</a>
            </div>
        </form>
    </div>
@endsection
