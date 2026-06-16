@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.materials.index') }}" class="text-[--caramel] hover:underline">← Kembali</a>
        <h1 class="text-3xl font-serif mt-2">Edit Bahan: {{ $material->name }}</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.materials.update', $material) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Bahan</label>
                <input type="text" value="{{ $material->name }}" class="border rounded px-3 py-2 w-full mt-1" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" value="{{ $material->type }}" class="border rounded px-3 py-2 w-full mt-1" disabled>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" value="{{ $material->quantity }}" class="border rounded px-3 py-2 w-full mt-1" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Min. Stok</label>
                    <input type="number" name="min_stock" value="{{ $material->min_stock }}" class="border rounded px-3 py-2 w-full mt-1" required>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-4 py-2 bg-[--caramel] text-white rounded">Simpan</button>
                <a href="{{ route('admin.materials.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
            </div>
        </form>
    </div>
@endsection
