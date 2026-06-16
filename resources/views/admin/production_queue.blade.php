@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-serif">Production Queue</h1>
    </div>

    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-yellow-100 rounded-lg p-4 border-l-4 border-yellow-500">
            <p class="text-gray-600 text-sm">Menunggu</p>
            <p class="text-3xl font-semibold">{{ count($waiting) }}</p>
        </div>
        <div class="bg-blue-100 rounded-lg p-4 border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm">Sedang Dibuat</p>
            <p class="text-3xl font-semibold">{{ count($inProgress) }}</p>
        </div>
        <div class="bg-purple-100 rounded-lg p-4 border-l-4 border-purple-500">
            <p class="text-gray-600 text-sm">Finishing</p>
            <p class="text-3xl font-semibold">{{ count($finishing) }}</p>
        </div>
        <div class="bg-green-100 rounded-lg p-4 border-l-4 border-green-500">
            <p class="text-gray-600 text-sm">Siap Kirim</p>
            <p class="text-3xl font-semibold">{{ count($ready) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4">
        <!-- Menunggu -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-4 text-center text-yellow-600">MENUNGGU</h3>
            <div class="space-y-3">
                @forelse ($waiting as $order)
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-3">
                        <p class="font-semibold text-sm">{{ $order->code }}</p>
                        <p class="text-xs text-gray-600">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-600">{{ $order->product }}</p>
                        <form method="post" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-2">
                            @csrf
                            <input type="hidden" name="status" value="produksi">
                            <button type="submit" class="text-xs bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Mulai Produksi</button>
                        </form>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-sm py-4">Tidak ada</p>
                @endforelse
            </div>
        </div>

        <!-- Sedang Dibuat -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-4 text-center text-blue-600">SEDANG DIBUAT</h3>
            <div class="space-y-3">
                @forelse ($inProgress as $order)
                    <div class="bg-blue-50 border border-blue-200 rounded p-3">
                        <p class="font-semibold text-sm">{{ $order->code }}</p>
                        <p class="text-xs text-gray-600">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-600">{{ $order->product }}</p>
                        <form method="post" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-2">
                            @csrf
                            <input type="hidden" name="status" value="finishing">
                            <button type="submit" class="text-xs bg-purple-500 text-white px-2 py-1 rounded hover:bg-purple-600">Ke Finishing</button>
                        </form>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-sm py-4">Tidak ada</p>
                @endforelse
            </div>
        </div>

        <!-- Finishing -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-4 text-center text-purple-600">FINISHING</h3>
            <div class="space-y-3">
                @forelse ($finishing as $order)
                    <div class="bg-purple-50 border border-purple-200 rounded p-3">
                        <p class="font-semibold text-sm">{{ $order->code }}</p>
                        <p class="text-xs text-gray-600">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-600">{{ $order->product }}</p>
                        <form method="post" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-2">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="text-xs bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Selesai</button>
                        </form>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-sm py-4">Tidak ada</p>
                @endforelse
            </div>
        </div>

        <!-- Siap Dikirim -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-4 text-center text-green-600">SIAP DIKIRIM</h3>
            <div class="space-y-3">
                @forelse ($ready as $order)
                    <div class="bg-green-50 border border-green-200 rounded p-3">
                        <p class="font-semibold text-sm">{{ $order->code }}</p>
                        <p class="text-xs text-gray-600">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-600">{{ $order->product }}</p>
                        <p class="text-xs text-green-600 font-semibold mt-2">✓ Selesai</p>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-sm py-4">Tidak ada</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
