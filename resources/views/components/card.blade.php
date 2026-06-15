@props(['title' => null, 'price' => null, 'href' => '#', 'status' => 'ready'])
@php
    $statusClass = 'bg-gray-200 text-gray-800';
    if($status === 'ready') $statusClass = 'bg-green-100 text-green-700 border border-green-300';
    if($status === 'pre-order') $statusClass = 'bg-yellow-100 text-yellow-700 border border-yellow-300';
    if($status === 'custom') $statusClass = 'bg-pink-100 text-pink-700 border border-pink-300';
@endphp

<a href="{{ $href }}" class="group">
    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 h-full flex flex-col">
        <!-- Image -->
        <div class="bg-gradient-to-br from-[--soft-beige] to-[--cream] h-48 flex items-center justify-center overflow-hidden group-hover:scale-105 transition duration-300">
            <svg class="w-20 h-20 text-[--caramel] opacity-40" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 4a3 3 0 016 0v12a3 3 0 11-6 0V4z"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">
            <div class="flex justify-between items-start gap-2 mb-3">
                <h3 class="text-lg font-semibold text-[--dark-brown] group-hover:text-[--caramel] transition flex-1 line-clamp-2">
                    {{ $title ?? 'Produk' }}
                </h3>
                <span class="badge text-xs font-semibold px-2 py-1 rounded-full whitespace-nowrap {{ $statusClass }}">
                    {{ ucfirst($status) }}
                </span>
            </div>

            <p class="text-[--caramel] font-bold text-xl mb-4">{{ $price ?? 'Rp 0' }}</p>

            <!-- Buttons -->
            <div class="mt-auto space-y-2 pt-2 border-t border-[--soft-beige]">
                <button class="w-full px-4 py-2 bg-[--caramel] text-white rounded-lg font-semibold hover:bg-opacity-90 transition text-sm">
                    Lihat Detail
                </button>
                <button class="w-full px-4 py-2 border-2 border-[--caramel] text-[--caramel] rounded-lg font-semibold hover:bg-[--caramel] hover:text-white transition text-sm">
                    Custom Order
                </button>
            </div>
        </div>
    </div>
</a>
