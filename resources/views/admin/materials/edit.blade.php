@extends('layouts.admin')

@section('content')
    <!-- Header with Back Button -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.materials.index') }}" class="inline-flex items-center justify-center w-10 h-10 border border-[#F2ECE4] bg-white text-[#4B2B20] rounded-full hover:bg-gray-50 transition" title="Kembali ke list">
            ←
        </a>
        <h1 class="text-3xl font-serif text-[#4B2B20] font-bold">Edit Bahan: {{ $material->name }}</h1>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-[2rem] border border-[#FAF6F0] p-8 shadow-[0_4px_30px_rgba(75,43,32,0.02)] max-w-xl">
        <form action="{{ route('admin.materials.update', $material) }}" method="post" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Name Field -->
            <div>
                <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Nama Bahan <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $material->name) }}" class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] font-medium focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] transition" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori Field -->
            <div>
                <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="type" required
                        class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] font-medium focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] transition">
                    <option value="Bahan" {{ old('type', $material->type) == 'Bahan' ? 'selected' : '' }}>Bahan</option>
                    <option value="Aksesoris" {{ old('type', $material->type) == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Field -->
            <div>
                <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Harga Rekomendasi (Rp)</label>
                <input type="number" name="price" value="{{ $material->price }}" class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] font-medium focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] transition" required min="0">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity & Min Stock Fields -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Quantity</label>
                    <input type="number" name="quantity" value="{{ $material->quantity }}" class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] font-medium focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Min. Stok</label>
                    <input type="number" name="min_stock" value="{{ $material->min_stock }}" class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] font-medium focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] transition" required>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-2 flex gap-4">
                <a href="{{ route('admin.materials.index') }}" class="flex-1 py-3.5 border border-[#A56A43]/40 text-[#A56A43] font-bold rounded-xl text-xs hover:bg-gray-50 transition text-center shadow-sm">
                    Batal
                </a>
                <button type="submit" class="flex-1 py-3.5 bg-[#A56A43] text-white font-bold rounded-xl text-xs hover:bg-opacity-95 transition text-center shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
