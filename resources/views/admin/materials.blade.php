@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[34px] font-serif font-bold text-[#4B2B20]">Stok Bahan</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Total Material -->
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Material</span>
            <span class="text-xl font-bold text-[#4B2B20]">{{ count($materials) }}</span>
        </div>

        <!-- Menipis -->
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menipis</span>
            <span class="text-xl font-bold text-[#4B2B20]">{{ $materials->where('status', 'menipis')->count() }}</span>
        </div>

        <!-- Habis -->
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Habis</span>
            <span class="text-xl font-bold text-[#4B2B20]">{{ $materials->where('status', 'habis')->count() }}</span>
        </div>
    </div>

    <!-- Action Row (Tambah Bahan) -->
    <div class="flex justify-end mb-5">
        <a href="#" class="px-5 py-2.5 bg-[#A56A43] text-white font-bold rounded-xl text-xs hover:bg-opacity-95 transition shadow-sm inline-block">
            + Tambah Bahan
        </a>
    </div>

    <!-- Materials Table Card -->
    <div class="bg-white rounded-[2rem] border border-[#FAF6F0] p-8 shadow-[0_4px_30px_rgba(75,43,32,0.02)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-[#4B2B20]">
                        <th class="pb-5 font-bold">Nama Bahan</th>
                        <th class="pb-5 font-bold">Jenis</th>
                        <th class="pb-5 font-bold">Jumlah</th>
                        <th class="pb-5 font-bold">Minimum</th>
                        <th class="pb-5 font-bold">Status</th>
                        <th class="pb-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-sans text-[13px] text-gray-600 font-medium">
                    @forelse ($materials as $material)
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- Nama Bahan -->
                            <td class="py-4 text-[#4B2B20] font-semibold text-sm">{{ $material->name }}</td>
                            
                            <!-- Jenis -->
                            <td class="py-4">{{ $material->type }}</td>
                            
                            <!-- Jumlah -->
                            <td class="py-4 font-semibold text-gray-700">{{ $material->quantity }} pcs</td>
                            
                            <!-- Minimum -->
                            <td class="py-4 text-gray-400">{{ $material->min_stock }} pcs</td>
                            
                            <!-- Status -->
                            <td class="py-4">
                                @if($material->status == 'aman')
                                    <span class="text-green-600 font-bold">Aman</span>
                                @elseif($material->status == 'menipis')
                                    <span class="text-amber-500 font-bold">Menipis</span>
                                @elseif($material->status == 'habis')
                                    <span class="text-red-500 font-bold">Habis</span>
                                @else
                                    <span class="text-gray-500 font-bold">{{ ucfirst($material->status) }}</span>
                                @endif
                            </td>
                            
                            <!-- Aksi -->
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.materials.edit', $material) }}" class="text-[#A56A43] hover:underline font-bold text-xs">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 font-medium">Tidak ada data bahan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
