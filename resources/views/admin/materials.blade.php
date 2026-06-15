@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-serif">Stok Bahan & Laporan</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 border-l-4 border-[--dark-brown]">
            <p class="text-gray-600 text-sm">Total Bahan</p>
            <p class="text-2xl font-semibold">{{ count($materials) }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 border-l-4 border-green-500">
            <p class="text-gray-600 text-sm">Stok Aman</p>
            <p class="text-2xl font-semibold">{{ $materials->where('status', 'aman')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 border-l-4 border-red-500">
            <p class="text-gray-600 text-sm">Stok Habis</p>
            <p class="text-2xl font-semibold">{{ $materials->where('status', 'habis')->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-[--dark-brown] text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Nama Bahan</th>
                    <th class="px-6 py-3 text-left">Jenis</th>
                    <th class="px-6 py-3 text-center">Quantity</th>
                    <th class="px-6 py-3 text-center">Min. Stok</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materials as $material)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $material->name }}</td>
                        <td class="px-6 py-4">{{ $material->type }}</td>
                        <td class="px-6 py-4 text-center">{{ $material->quantity }}</td>
                        <td class="px-6 py-4 text-center">{{ $material->min_stock }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded text-white text-sm
                                @if($material->status == 'aman') bg-green-500
                                @elseif($material->status == 'habis') bg-red-500
                                @else bg-gray-500 @endif">
                                {{ ucfirst($material->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.materials.edit', $material) }}" class="text-[--caramel] hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-600">Tidak ada data bahan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
