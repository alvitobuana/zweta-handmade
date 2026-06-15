@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Dashboard Admin</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-[--dark-brown]">
            <p class="text-gray-600 text-sm">Total Produk</p>
            <p class="text-3xl font-semibold">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm">Total Pesanan</p>
            <p class="text-3xl font-semibold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-purple-500">
            <p class="text-gray-600 text-sm">Custom Request</p>
            <p class="text-3xl font-semibold">{{ $totalCustomRequests }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-gray-600 text-sm">Total Customer</p>
            <p class="text-3xl font-semibold">{{ $totalCustomers }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Pesanan berdasarkan Status</h3>
            <div class="space-y-2">
                @foreach ($ordersByStatus as $status => $count)
                    <div class="flex justify-between items-center">
                        <span class="capitalize">{{ $status }}</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Custom Request berdasarkan Status</h3>
            <div class="space-y-2">
                @foreach ($requestsByStatus as $status => $count)
                    <div class="flex justify-between items-center">
                        <span class="capitalize">{{ $status }}</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Pesanan Terbaru</h3>
            <div class="space-y-3">
                @forelse ($recentOrders as $order)
                    <div class="border-b pb-3 last:border-0">
                        <p class="font-medium">{{ $order->code }}</p>
                        <p class="text-sm text-gray-600">{{ $order->customer_name }} - {{ $order->product }}</p>
                        <p class="text-sm text-gray-600">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="text-gray-400">Tidak ada pesanan</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Custom Request Terbaru</h3>
            <div class="space-y-3">
                @forelse ($recentRequests as $request)
                    <div class="border-b pb-3 last:border-0">
                        <p class="font-medium">{{ $request->customer_name }}</p>
                        <p class="text-sm text-gray-600">Model: {{ $request->model }}</p>
                        <p class="text-sm text-gray-600">Status: <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">{{ $request->status }}</span></p>
                    </div>
                @empty
                    <p class="text-gray-400">Tidak ada request</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

