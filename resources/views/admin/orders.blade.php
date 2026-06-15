@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-serif">Daftar Pesanan</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-[--dark-brown] text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Kode</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-center">Qty</th>
                    <th class="px-6 py-3 text-right">Harga</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $o->code }}</td>
                        <td class="px-6 py-4">{{ $o->customer_name }}</td>
                        <td class="px-6 py-4">{{ $o->product }}</td>
                        <td class="px-6 py-4 text-center">{{ $o->qty }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($o->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded text-white text-sm
                                @if($o->status == 'pending') bg-yellow-500
                                @elseif($o->status == 'produksi') bg-blue-500
                                @elseif($o->status == 'finishing') bg-purple-500
                                @elseif($o->status == 'selesai') bg-green-500
                                @else bg-gray-500 @endif">
                                {{ ucfirst($o->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form method="post" action="{{ route('admin.orders.updateStatus', $o) }}" class="inline">
                                @csrf
                                <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                    <option value="">Ubah Status</option>
                                    <option value="pending" @selected($o->status == 'pending')>Pending</option>
                                    <option value="produksi" @selected($o->status == 'produksi')>Produksi</option>
                                    <option value="finishing" @selected($o->status == 'finishing')>Finishing</option>
                                    <option value="selesai" @selected($o->status == 'selesai')>Selesai</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-600">Tidak ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($orders->hasPages())
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
@endsection

