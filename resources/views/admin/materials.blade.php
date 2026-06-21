@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[34px] font-serif font-bold text-[#4B2B20]">Stok Bahan</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm flex items-center gap-2">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm shadow-sm flex items-center gap-2">
            <span>⚠️</span> {{ session('error') }}
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Material</span>
            <span class="text-xl font-bold text-[#4B2B20]">{{ count($materials) }}</span>
        </div>
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menipis</span>
            <span class="text-xl font-bold text-amber-500">{{ $materials->where('status', 'menipis')->count() }}</span>
        </div>
        <div class="bg-white rounded-3xl border border-[#FAF6F0] p-6 shadow-[0_4px_30px_rgba(75,43,32,0.01)] flex flex-col gap-1.5">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Habis</span>
            <span class="text-xl font-bold text-red-500">{{ $materials->where('status', 'habis')->count() }}</span>
        </div>
    </div>

    <!-- Action Row -->
    <div class="flex justify-end mb-5">
        <button onclick="openModal()" class="px-5 py-2.5 bg-[#A56A43] text-white font-bold rounded-xl text-xs hover:bg-opacity-90 transition shadow-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Bahan
        </button>
    </div>

    <!-- Materials Table -->
    <div class="bg-white rounded-[2rem] border border-[#FAF6F0] p-8 shadow-[0_4px_30px_rgba(75,43,32,0.02)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-[#4B2B20]">
                        <th class="pb-5 font-bold">Nama Bahan</th>
                        <th class="pb-5 font-bold">Kategori</th>
                        <th class="pb-5 font-bold">Harga</th>
                        <th class="pb-5 font-bold">Jumlah</th>
                        <th class="pb-5 font-bold">Minimum</th>
                        <th class="pb-5 font-bold">Status</th>
                        <th class="pb-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-sans text-[13px] text-gray-600 font-medium">
                    @forelse ($materials as $material)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 text-[#4B2B20] font-semibold text-sm">{{ $material->name }}</td>
                            <td class="py-4">{{ $material->type }}</td>
                            <td class="py-4 font-semibold text-gray-700">Rp {{ number_format($material->price, 0, ',', '.') }}</td>
                            <td class="py-4 font-semibold text-gray-700">{{ $material->quantity }} pcs</td>
                            <td class="py-4 text-gray-400">{{ $material->min_stock }} pcs</td>
                            <td class="py-4">
                                @if($material->status == 'aman')
                                    <span class="inline-flex items-center gap-1 text-green-700 bg-green-50 border border-green-200 px-2.5 py-1 rounded-full text-xs font-bold">✓ Aman</span>
                                @elseif($material->status == 'menipis')
                                    <span class="inline-flex items-center gap-1 text-amber-700 bg-amber-50 border border-amber-200 px-2.5 py-1 rounded-full text-xs font-bold">⚠ Menipis</span>
                                @elseif($material->status == 'habis')
                                    <span class="inline-flex items-center gap-1 text-red-700 bg-red-50 border border-red-200 px-2.5 py-1 rounded-full text-xs font-bold">✕ Habis</span>
                                @else
                                    <span class="text-gray-500 font-bold">{{ ucfirst($material->status) }}</span>
                                @endif
                            </td>
                            <td class="py-4 text-right flex items-center justify-end gap-3">
                                <a href="{{ route('admin.materials.edit', $material) }}"
                                   class="text-[#A56A43] hover:underline font-bold text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('admin.materials.destroy', $material) }}" method="POST"
                                      onsubmit="return confirm('Hapus bahan {{ $material->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-bold text-xs">
                                        Hapus
                                    </button>
                                </form>
                             </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400 font-medium">
                                <div class="text-4xl mb-3">📦</div>
                                <p>Belum ada data bahan. Klik "Tambah Bahan" untuk mulai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============================================================
         MODAL TAMBAH BAHAN
    ============================================================ -->
    <div id="tambahBahanModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden"
         onclick="closeModalOutside(event)">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 overflow-hidden" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-[#4B2B20] to-[#A56A43] px-8 py-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-serif font-bold text-white">Tambah Bahan Baru</h2>
                    <p class="text-white/70 text-sm mt-0.5">Isi form di bawah untuk menambahkan bahan</p>
                </div>
                <button onclick="closeModal()" class="text-white/80 hover:text-white transition text-2xl leading-none">&times;</button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('admin.materials.store') }}" method="POST" class="px-8 py-7 space-y-5">
                @csrf

                <!-- Nama Bahan -->
                <div>
                    <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-1.5">
                        Nama Bahan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required
                           placeholder="Contoh: Kulit Sapi"
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 border-2 border-[#EAD9CC] rounded-xl focus:outline-none focus:border-[#A56A43] text-sm text-[#4B2B20] placeholder-gray-400 transition">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="type" required
                            class="w-full px-4 py-3 border-2 border-[#EAD9CC] rounded-xl focus:outline-none focus:border-[#A56A43] text-sm text-[#4B2B20] transition bg-white">
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                        <option value="Bahan" {{ old('type') == 'Bahan' ? 'selected' : '' }}>Bahan</option>
                        <option value="Aksesoris" {{ old('type') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-1.5">
                        Harga Rekomendasi (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" required min="0"
                           placeholder="Contoh: 15000"
                           value="{{ old('price', 0) }}"
                           class="w-full px-4 py-3 border-2 border-[#EAD9CC] rounded-xl focus:outline-none focus:border-[#A56A43] text-sm text-[#4B2B20] placeholder-gray-400 transition">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah & Minimum (2 kolom) -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-1.5">
                            Jumlah (pcs) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantity" required min="0"
                               placeholder="0"
                               value="{{ old('quantity') }}"
                               class="w-full px-4 py-3 border-2 border-[#EAD9CC] rounded-xl focus:outline-none focus:border-[#A56A43] text-sm text-[#4B2B20] transition">
                        @error('quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-1.5">
                            Minimum Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="min_stock" required min="0"
                               placeholder="0"
                               value="{{ old('min_stock') }}"
                               class="w-full px-4 py-3 border-2 border-[#EAD9CC] rounded-xl focus:outline-none focus:border-[#A56A43] text-sm text-[#4B2B20] transition">
                        @error('min_stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Info otomatis -->
                <div class="bg-[#FFF8F2] rounded-xl p-3 text-xs text-gray-500 border border-[#EAD9CC]">
                    💡 Status (<span class="font-semibold text-green-600">Aman</span> / <span class="font-semibold text-amber-500">Menipis</span> / <span class="font-semibold text-red-500">Habis</span>) akan dihitung otomatis berdasarkan jumlah &amp; minimum stok.
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="closeModal()"
                            class="flex-1 px-5 py-3 border-2 border-[#EAD9CC] text-[#4B2B20] font-semibold rounded-xl hover:bg-[#FAF6F0] transition text-sm">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 px-5 py-3 bg-[#A56A43] text-white font-semibold rounded-xl hover:bg-opacity-90 transition shadow-md text-sm">
                        💾 Simpan Bahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openModal() {
        document.getElementById('tambahBahanModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('tambahBahanModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function closeModalOutside(e) {
        if (e.target === document.getElementById('tambahBahanModal')) {
            closeModal();
        }
    }

    // Buka otomatis kalau ada validation error (form sudah pernah disubmit)
    @if($errors->any())
        openModal();
    @endif

    // ESC key untuk tutup modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>
@endpush
