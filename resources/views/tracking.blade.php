@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-[--caramel] to-[--dusty-pink] text-white rounded-3xl px-8 lg:px-12 py-12 mb-12">
        <h1 class="text-4xl lg:text-5xl font-serif mb-3">Lacak Pesanan Anda</h1>
        <p class="text-lg text-gray-100">Ketahui status terbaru pesanan tas handmade Anda</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border-l-4 border-[--caramel]">
        <p class="text-[--dark-brown] font-semibold mb-4">Masukkan Kode Pesanan Anda</p>
        <form method="get" action="{{ route('tracking') }}" class="flex gap-3 flex-col sm:flex-row">
            <input 
                class="flex-1 px-6 py-3 border-2 border-[--soft-beige] rounded-lg focus:outline-none focus:border-[--caramel] placeholder-gray-400" 
                placeholder="Contoh: ZW-24001" 
                name="code" 
                value="{{ $code ?? '' }}"
                type="text"
            >
            <button type="submit" class="px-8 py-3 bg-[--caramel] text-white font-semibold rounded-lg hover:bg-opacity-90 transition shadow-lg">
                🔍 Lacak
            </button>
        </form>
    </div>

    <!-- Search Results -->
    @if ($order)
        <div class="space-y-8">
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-8 border-2 border-green-300">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-3xl">✅</span>
                    <h2 class="text-2xl font-serif text-green-700">Pesanan Ditemukan!</h2>
                </div>
                <p class="text-green-600">Kode pesanan: <span class="font-bold">{{ $order->code }}</span></p>
            </div>

            <!-- Order Details Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 border-l-4 border-[--caramel] shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Nama Customer</p>
                    <p class="text-xl font-semibold text-[--dark-brown]">{{ $order->customer_name }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-blue-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Produk</p>
                    <p class="text-xl font-semibold text-[--dark-brown]">{{ $order->product }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-purple-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Jumlah</p>
                    <p class="text-xl font-semibold text-[--dark-brown]">{{ $order->qty }} pcs</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-green-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Total Harga</p>
                    <p class="text-xl font-semibold text-[--caramel]">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <p class="text-sm text-gray-600 mb-3">Status Saat Ini</p>
                <span class="inline-block px-6 py-3 rounded-full text-white font-semibold
                    @if($order->status == 'pending') bg-yellow-500
                    @elseif($order->status == 'produksi') bg-blue-500
                    @elseif($order->status == 'finishing') bg-purple-500
                    @elseif($order->status == 'selesai') bg-green-500
                    @else bg-gray-500 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Timeline Progress -->
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <h3 class="text-xl font-serif text-[--dark-brown] mb-8">Tahapan Pesanan</h3>
                
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-[--caramel] to-gray-300"></div>

                    <!-- Timeline Items -->
                    <div class="space-y-8">
                        <!-- Pesanan Diterima -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-lg">✓</div>
                            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-500">
                                <p class="font-semibold text-green-700">Pesanan Diterima</p>
                                <p class="text-sm text-green-600">{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : 'Pending' }}</p>
                            </div>
                        </div>

                        <!-- Pembayaran Terverifikasi -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) ✓ @else 2 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) text-green-700 @else text-gray-600 @endif">Pembayaran Terverifikasi</p>
                                <p class="text-sm @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) text-green-600 @else text-gray-500 @endif">Proses verifikasi pembayaran</p>
                            </div>
                        </div>

                        <!-- Mulai Produksi -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) ✓ @else 3 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) text-green-700 @else text-gray-600 @endif">Mulai Produksi</p>
                                <p class="text-sm @if(in_array($order->status, ['produksi', 'finishing', 'selesai'])) text-green-600 @else text-gray-500 @endif">Tim produksi mulai membuat tas</p>
                            </div>
                        </div>

                        <!-- Proses Finishing -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['finishing', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['finishing', 'selesai'])) ✓ @else 4 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['finishing', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['finishing', 'selesai'])) text-green-700 @else text-gray-600 @endif">Proses Finishing</p>
                                <p class="text-sm @if(in_array($order->status, ['finishing', 'selesai'])) text-green-600 @else text-gray-500 @endif">Kualitas diperiksa dan dikemas</p>
                            </div>
                        </div>

                        <!-- Siap Dikirim -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if($order->status == 'selesai') bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if($order->status == 'selesai') ✓ @else 5 @endif
                            </div>
                            <div class="@if($order->status == 'selesai') bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if($order->status == 'selesai') text-green-700 @else text-gray-600 @endif">Siap Dikirim</p>
                                <p class="text-sm @if($order->status == 'selesai') text-green-600 @else text-gray-500 @endif">Pesanan siap untuk pengiriman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($order->notes)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
                    <p class="text-sm text-blue-600 mb-2">Catatan:</p>
                    <p class="text-blue-900">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    @elseif ($code)
        <div class="bg-red-50 border-2 border-red-300 rounded-2xl p-8 text-center">
            <div class="text-5xl mb-4">❌</div>
            <h3 class="text-2xl font-serif text-red-700 mb-2">Pesanan Tidak Ditemukan</h3>
            <p class="text-red-600 mb-6">Kode pesanan <span class="font-bold">{{ $code }}</span> tidak ada dalam sistem kami.</p>
            <p class="text-gray-700 mb-6">Silakan periksa kembali kode pesanan Anda dan coba lagi.</p>
            <a href="{{ route('tracking') }}" class="inline-block px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                Coba Lagi
            </a>
        </div>
    @else
        <div class="bg-gradient-to-r from-[--soft-beige] to-[--cream] rounded-2xl p-12 text-center border-2 border-[--caramel]">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-2xl font-serif text-[--dark-brown] mb-3">Belum Ada Kode Pesanan?</h3>
            <p class="text-gray-700 mb-8 max-w-md mx-auto">Masukkan kode pesanan Anda di atas untuk melacak status dan memantau proses pembuatan tas handmade Anda secara real-time.</p>
            <div class="inline-block">
                <p class="text-sm font-semibold text-[--caramel]">💡 Contoh kode pesanan: ZW-24001</p>
            </div>
        </div>
    @endif

@endsection

