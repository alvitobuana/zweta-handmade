@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-serif text-dark-brown font-bold mb-2">Kelola Pesanan</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filter Section -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-4 mb-8">
        <!-- Search Input -->
        <div class="flex-1 max-w-sm">
            <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Search</label>
            <form action="{{ route('admin.orders.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="Kode/customer" class="w-full px-4 py-2.5 text-xs bg-white border border-soft-beige rounded-xl focus:outline-none focus:border-caramel placeholder-gray-400">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
            </form>
        </div>
        
        <!-- Status Filter Dropdown -->
        <div>
            <form action="{{ route('admin.orders.index') }}" method="GET" class="inline">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <select name="status" onchange="this.form.submit()" class="px-5 py-2.5 bg-[#FAF0E6] border border-caramel/40 text-dark-brown rounded-xl text-xs font-semibold focus:outline-none cursor-pointer hover:bg-opacity-80 transition">
                    <option value="">Filter Status (Semua)</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="produksi" {{ request('status') == 'produksi' ? 'selected' : '' }}>Produksi</option>
                    <option value="finishing" {{ request('status') == 'finishing' ? 'selected' : '' }}>Finishing</option>
                    <option value="siap_dikirim" {{ request('status') == 'siap_dikirim' ? 'selected' : '' }}>Siap Dikirim</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-dark-brown">
                        <th class="pb-4 font-bold text-xs">Kode</th>
                        <th class="pb-4 font-bold text-xs">Customer</th>
                        <th class="pb-4 font-bold text-xs">Produk</th>
                        <th class="pb-4 font-bold text-xs">Bayar</th>
                        <th class="pb-4 font-bold text-xs">Produksi</th>
                        <th class="pb-4 font-bold text-xs">Tgl Pesan</th>
                        <th class="pb-4 font-bold text-xs">Deadline</th>
                        <th class="pb-4 font-bold text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $o)
                        <!-- Row Data -->
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <!-- Kode -->
                            <td class="py-4 text-xs font-semibold text-dark-brown">{{ $o->code }}</td>
                            
                            <!-- Customer -->
                            <td class="py-4 text-xs text-gray-500">{{ $o->customer_name }}</td>
                            
                            <!-- Produk -->
                            <td class="py-4 text-xs text-gray-500">{{ $o->product }}</td>
                            
                            <!-- Bayar Status -->
                            <td class="py-4 text-xs text-gray-500">
                                @if($o->status == 'pending')
                                    <span class="text-amber-600 font-semibold bg-amber-50 px-2 py-0.5 rounded text-[10px] uppercase tracking-wider">Belum Bayar</span>
                                @elseif($o->status == 'menunggu_verifikasi')
                                    <span class="text-indigo-600 font-semibold bg-indigo-50 px-2 py-0.5 rounded text-[10px] uppercase tracking-wider animate-pulse">Menunggu Verifikasi</span>
                                @else
                                    <span class="text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded text-[10px] uppercase tracking-wider">Terverifikasi</span>
                                @endif
                            </td>
                            
                            <!-- Produksi Status (Inline Editable Dropdown) -->
                            <td class="py-4 text-xs text-gray-500">
                                <form method="post" action="{{ route('admin.orders.updateStatus', $o) }}" class="inline">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="bg-transparent text-xs text-gray-500 font-medium cursor-pointer focus:outline-none border-b border-dashed border-gray-300 hover:text-caramel">
                                        <option value="pending" @selected($o->status == 'pending')>Menunggu Pembayaran</option>
                                        <option value="menunggu_verifikasi" @selected($o->status == 'menunggu_verifikasi')>Menunggu Verifikasi</option>
                                        <option value="produksi" @selected($o->status == 'produksi')>Produksi</option>
                                        <option value="finishing" @selected($o->status == 'finishing')>Finishing</option>
                                        <option value="siap_dikirim" @selected($o->status == 'siap_dikirim')>Siap Dikirim</option>
                                        <option value="selesai" @selected($o->status == 'selesai')>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            
                            <!-- Tgl Pesan -->
                            <td class="py-4 text-xs text-gray-500">
                                {{ $o->created_at ? $o->created_at->translatedFormat('j M') : '-' }}
                            </td>

                            <!-- Deadline -->
                            <td class="py-4 text-xs text-gray-500 font-semibold text-amber-700">
                                {{ $o->created_at ? $o->created_at->addDays(5)->translatedFormat('j M') : '14 Juni' }}
                            </td>
                            
                            <!-- Aksi (Detail Link) -->
                            <td class="py-4 text-xs font-bold text-caramel text-right">
                                <a href="{{ route('admin.orders.show', $o->id) }}" class="hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <!-- Expandable Details Row -->
                        <tr id="detail-{{ $o->id }}" class="hidden bg-[#FFF8F2]/40">
                            <td colspan="8" class="px-6 py-4 border-t border-b border-gray-100">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-gray-500 p-2">
                                    <div>
                                        <p class="font-bold text-dark-brown uppercase tracking-wider text-[10px] mb-1">Rincian Pembelian</p>
                                        <p>Produk: <span class="font-semibold text-dark-brown">{{ $o->product }}</span></p>
                                        <p>Jumlah: <span class="font-semibold text-dark-brown">{{ $o->qty }} pcs</span></p>
                                        <p>Harga Satuan: <span class="font-semibold text-dark-brown">Rp {{ number_format($o->price, 0, ',', '.') }}</span></p>
                                        <p class="font-semibold mt-1">Total: <span class="text-caramel font-bold">Rp {{ number_format($o->price * $o->qty, 0, ',', '.') }}</span></p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-dark-brown uppercase tracking-wider text-[10px] mb-1">Catatan Pesanan</p>
                                        <p class="italic">"{{ $o->notes ?? 'Tidak ada catatan khusus dari pembeli.' }}"</p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-dark-brown uppercase tracking-wider text-[10px] mb-1">Informasi Waktu</p>
                                        <p>Dipesan pada: {{ $o->created_at ? $o->created_at->translatedFormat('l, d F Y (H:i)') : '-' }}</p>
                                        <p>Status Produksi saat ini: <span class="capitalize font-semibold text-dark-brown">{{ $o->status }}</span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-xs text-gray-400">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif

    <!-- Inline Script to toggle details row -->
    <script>
        function toggleDetailRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.classList.toggle('hidden');
            }
        }
    </script>
@endsection
