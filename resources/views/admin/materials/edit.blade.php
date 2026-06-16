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

            <!-- Name Field (Disabled) -->
            <div>
                <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Nama Bahan</label>
                <input type="text" value="{{ $material->name }}" class="w-full px-5 py-3.5 bg-gray-50 border border-[#F2ECE4] rounded-[18px] text-sm text-gray-500 font-medium focus:outline-none" disabled>
            </div>

            <!-- Type Field (Disabled) -->
            <div>
                <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Jenis</label>
                <input type="text" value="{{ $material->type }}" class="w-full px-5 py-3.5 bg-gray-50 border border-[#F2ECE4] rounded-[18px] text-sm text-gray-500 font-medium focus:outline-none" disabled>
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
