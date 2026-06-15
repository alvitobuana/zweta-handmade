@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-serif">Custom Request</h1>
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
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Model</th>
                    <th class="px-6 py-3 text-left">Warna</th>
                    <th class="px-6 py-3 text-center">Deadline</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $r)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $r->customer_name }}</td>
                        <td class="px-6 py-4">{{ $r->email }}</td>
                        <td class="px-6 py-4">{{ $r->model }}</td>
                        <td class="px-6 py-4">{{ $r->color }}</td>
                        <td class="px-6 py-4 text-center">{{ $r->deadline ? $r->deadline->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded text-white text-sm
                                @if($r->status == 'menunggu') bg-yellow-500
                                @elseif($r->status == 'dikonfirmasi') bg-blue-500
                                @elseif($r->status == 'ditolak') bg-red-500
                                @elseif($r->status == 'selesai') bg-green-500
                                @else bg-gray-500 @endif">
                                {{ ucfirst($r->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form method="post" action="{{ route('admin.customrequests.updateStatus', $r) }}" class="inline">
                                @csrf
                                <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                    <option value="">Ubah Status</option>
                                    <option value="menunggu"    @selected($r->status == 'menunggu')>Menunggu</option>
                                    <option value="diproses"    @selected($r->status == 'diproses')>Diproses</option>
                                    <option value="selesai"     @selected($r->status == 'selesai')>Selesai</option>
                                    <option value="dibatalkan"  @selected($r->status == 'dibatalkan')>Dibatalkan</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-600">Tidak ada custom request</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($requests->hasPages())
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @endif
@endsection

