@extends('layouts.admin')

@section('content')
    <!-- Dashboard Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-serif text-dark-brown font-bold mb-2">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">Ringkasan bisnis Zweta Handmade hari ini.</p>
    </div>

    <!-- Stats Grid (6 Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Total Pesanan -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Total Pesanan</p>
            <p class="text-2xl text-gray-500">{{ $totalOrders }}</p>
        </div>

        <!-- Card 2: Revenue -->
        @php
            if ($totalRevenue >= 1000000) {
                $formattedRevenue = 'Rp ' . number_format($totalRevenue / 1000000, 1, ',', '.') . ' jt';
            } else {
                $formattedRevenue = 'Rp ' . number_format($totalRevenue, 0, ',', '.');
            }
        @endphp
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Revenue</p>
            <p class="text-2xl text-gray-500">{{ $formattedRevenue }}</p>
        </div>

        <!-- Card 3: Custom Order -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Custom Order</p>
            <p class="text-2xl text-gray-500">{{ $totalCustomRequests }}</p>
        </div>

        <!-- Card 4: Produk -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Produk</p>
            <p class="text-2xl text-gray-500">{{ $totalProducts }}</p>
        </div>

        <!-- Card 5: Pending -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Pending</p>
            <p class="text-2xl text-gray-500">{{ $pendingCount }}</p>
        </div>

        <!-- Card 6: Deadline Dekat -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.015)]">
            <p class="text-sm font-bold text-dark-brown mb-3">Deadline Dekat</p>
            <p class="text-2xl text-gray-500">{{ $deadlineCount }}</p>
        </div>
    </div>

    <!-- Recent Orders Card -->
    <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)]">
        <h3 class="text-lg font-bold text-dark-brown mb-6">Pesanan Terbaru</h3>
        <div class="space-y-4">
            @forelse ($recentOrders as $order)
                <div class="text-sm text-gray-500 leading-relaxed flex items-center flex-wrap gap-1.5">
                    <span class="font-medium text-dark-brown">{{ $order->code }}</span>
                    <span>{{ $order->customer_name }}</span>
                    <span>{{ $order->product }}</span>
                    @if ($order->status == 'produksi')
                        <span class="text-green-700 font-medium bg-green-50 px-2 py-0.5 rounded-md text-xs">Dibayar</span>
                        <span class="text-gray-400">Sedang dibuat</span>
                    @elseif ($order->status == 'pending')
                        <span class="text-amber-700 font-medium bg-amber-50 px-2 py-0.5 rounded-md text-xs">Pending</span>
                        <span class="text-gray-400">Menunggu produksi</span>
                    @else
                        <span class="text-blue-700 font-medium bg-blue-50 px-2 py-0.5 rounded-md text-xs">{{ ucfirst($order->status) }}</span>
                    @endif
                    <span class="text-gray-400 text-xs ml-auto">{{ $order->created_at->translatedFormat('j F') }}</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Tidak ada pesanan terbaru</p>
            @endforelse
        </div>
    </div>
@endsection
