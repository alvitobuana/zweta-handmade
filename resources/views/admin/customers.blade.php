@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-serif">Data Customer</h1>
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
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-center">Total Pesanan</th>
                    <th class="px-6 py-3 text-right">Total Belanja</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $customer->name }}</td>
                        <td class="px-6 py-4">{{ $customer->email }}</td>
                        <td class="px-6 py-4">{{ $customer->phone }}</td>
                        <td class="px-6 py-4 text-center">{{ $customer->total_orders }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            <form method="post" action="{{ route('admin.customers.destroy', $customer) }}" class="inline" onsubmit="return confirm('Hapus customer ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-600">Tidak ada data customer</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
