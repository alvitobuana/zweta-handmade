@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[34px] font-serif font-bold text-[#4B2B20]">Data Customer</h1>
    </div>

    <!-- Search Box -->
    <div class="mb-8 max-w-md">
        <label class="block text-xs font-bold text-[#4B2B20] uppercase tracking-wider mb-2">Search Customer</label>
        <form method="get" action="{{ route('admin.customers.index') }}" class="relative">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Cari nama/WA" 
                class="w-full px-5 py-3.5 bg-white border border-[#F2ECE4] rounded-[18px] text-sm text-[#4B2B20] placeholder-gray-400 focus:outline-none focus:border-[#A56A43] focus:ring-1 focus:ring-[#A56A43] shadow-[0_4px_16px_rgba(75,43,32,0.02)] transition"
            >
            @if($search)
                <a href="{{ route('admin.customers.index') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs">
                    Clear
                </a>
            @endif
        </form>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Customers Table Card -->
    <div class="bg-white rounded-[2rem] border border-[#FAF6F0] p-8 shadow-[0_4px_30px_rgba(75,43,32,0.02)] mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-[#4B2B20]">
                        <th class="pb-5 font-bold">Nama</th>
                        <th class="pb-5 font-bold">WhatsApp</th>
                        <th class="pb-5 font-bold text-center">Total Order</th>
                        <th class="pb-5 font-bold">Total Belanja</th>
                        <th class="pb-5 font-bold">Terakhir Pesan</th>
                        <th class="pb-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-sans text-[13px] text-gray-600 font-medium">
                    @forelse ($customers as $index => $customer)
                        @php
                            $latestOrder = \App\Models\Order::where('customer_name', $customer->name)->latest()->first();
                            $lastOrderDate = $latestOrder ? $latestOrder->created_at->translatedFormat('j F') : '10 Juni';
                            
                            $favProduct = \App\Models\Order::where('customer_name', $customer->name)
                                ->select('product')
                                ->groupBy('product')
                                ->orderByRaw('COUNT(*) DESC')
                                ->first();
                            $favoriteProduct = $favProduct ? $favProduct->product : 'Tote Bag Custom';
                        @endphp
                        <tr 
                            class="customer-row hover:bg-[#FFF8F2]/30 cursor-pointer transition {{ $index === 0 ? 'bg-[#FFF8F2]/50' : '' }}"
                            data-name="{{ $customer->name }}"
                            data-orders="{{ $customer->total_orders }} order"
                            data-favorite="{{ $favoriteProduct }}"
                            data-spent="Rp {{ number_format($customer->total_spent, 0, ',', '.') }}"
                        >
                            <!-- Nama -->
                            <td class="py-4 text-[#4B2B20] font-semibold text-sm">{{ $customer->name }}</td>
                            
                            <!-- WhatsApp -->
                            <td class="py-4">{{ $customer->phone ?: '0812xxxx' }}</td>
                            
                            <!-- Total Order -->
                            <td class="py-4 text-center font-bold">{{ $customer->total_orders }}</td>
                            
                            <!-- Total Belanja -->
                            <td class="py-4 text-[#A56A43] font-semibold">Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                            
                            <!-- Terakhir Pesan -->
                            <td class="py-4 text-gray-500">{{ $lastOrderDate }}</td>
                            
                            <!-- Aksi -->
                            <td class="py-4 text-right" onclick="event.stopPropagation()">
                                <form method="post" action="{{ route('admin.customers.destroy', $customer) }}" class="inline" onsubmit="return confirm('Hapus customer ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:underline text-xs font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 font-medium">Tidak ada data customer</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($customers->hasPages())
            <div class="mt-6 border-t border-gray-50 pt-4">
                {{ $customers->links() }}
            </div>
        @endif
    </div>

    <!-- Detail Customer Terpilih Card -->
    <div class="bg-white rounded-[2rem] border border-[#FAF6F0] p-8 shadow-[0_4px_30px_rgba(75,43,32,0.02)]">
        <h3 class="text-xl font-serif font-bold text-[#4B2B20] mb-6">Detail Customer Terpilih</h3>
        
        <div id="detail-empty" class="text-sm text-gray-400 font-medium py-4 {{ count($customers) > 0 ? 'hidden' : '' }}">
            Silakan pilih customer untuk melihat detail.
        </div>

        @if(count($customers) > 0)
            @php
                $firstCustomer = $customers->first();
                $firstFavProduct = \App\Models\Order::where('customer_name', $firstCustomer->name)
                    ->select('product')
                    ->groupBy('product')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first();
                $firstFavName = $firstFavProduct ? $firstFavProduct->product : 'Tote Bag Custom';
            @endphp
            <div id="detail-content" class="flex flex-col gap-3 font-sans text-sm text-gray-600 font-medium">
                <p>Nama Customer: <span id="detail-name" class="text-[#4B2B20] font-bold">{{ $firstCustomer->name }}</span></p>
                <p>Riwayat pesanan: <span id="detail-orders" class="text-[#4B2B20] font-semibold">{{ $firstCustomer->total_orders }} order</span></p>
                <p>Produk favorit: <span id="detail-favorite" class="text-[#4B2B20] font-semibold">{{ $firstFavName }}</span></p>
                <p>Total belanja: <span id="detail-spent" class="text-[#A56A43] font-bold">Rp {{ number_format($firstCustomer->total_spent, 0, ',', '.') }}</span></p>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.customer-row');
            const detailName = document.getElementById('detail-name');
            const detailOrders = document.getElementById('detail-orders');
            const detailFavorite = document.getElementById('detail-favorite');
            const detailSpent = document.getElementById('detail-spent');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    // Remove active background class from all rows
                    rows.forEach(r => r.classList.remove('bg-[#FFF8F2]/50'));
                    
                    // Add active class to clicked row
                    this.classList.add('bg-[#FFF8F2]/50');

                    // Update detail section values
                    if (detailName) {
                        detailName.textContent = this.dataset.name;
                        detailOrders.textContent = this.dataset.orders;
                        detailFavorite.textContent = this.dataset.favorite;
                        detailSpent.textContent = this.dataset.spent;
                    }
                });
            });
        });
    </script>
@endsection
