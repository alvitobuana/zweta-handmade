@extends('layouts.admin')

@section('content')
    @php
        $monthsMap = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
        ];
        $formatIndo = function($date, $daysToAdd = 0) use ($monthsMap) {
            if (!$date) {
                $mockDates = ['12 Juni', '12 Juni', '13 Juni', '14 Juni', '15 Juni', '16 Juni'];
                return $mockDates[$daysToAdd] ?? '12 Juni';
            }
            $targetDate = $date->copy()->addDays($daysToAdd);
            $engMonth = $targetDate->format('F');
            $indoMonth = $monthsMap[$engMonth] ?? $engMonth;
            return $targetDate->format('j') . ' ' . $indoMonth;
        };

        $statusVal = $order->status;
        $step1 = true; // Order dibuat
        $step2 = in_array($statusVal, ['produksi', 'finishing', 'siap_dikirim', 'selesai']); // Pembayaran diverifikasi
        $step3 = in_array($statusVal, ['produksi', 'finishing', 'siap_dikirim', 'selesai']); // Masuk antrean produksi
        $step4 = in_array($statusVal, ['produksi', 'finishing', 'siap_dikirim', 'selesai']); // Sedang dibuat 50%
        $step5 = in_array($statusVal, ['finishing', 'siap_dikirim', 'selesai']); // Finishing
        $step6 = in_array($statusVal, ['siap_dikirim', 'selesai']); // Siap dikirim
        $step7 = $statusVal == 'selesai'; // Selesai

        $stepsData = [
            [
                'label' => 'Order dibuat',
                'active' => $step1,
                'days' => 0,
            ],
            [
                'label' => 'Pembayaran diverifikasi',
                'active' => $step2,
                'days' => 0,
            ],
            [
                'label' => 'Masuk antrean produksi',
                'active' => $step3,
                'days' => 1,
            ],
            [
                'label' => 'Sedang dibuat 50%',
                'active' => $step4,
                'days' => 2,
            ],
            [
                'label' => 'Finishing',
                'active' => $step5,
                'days' => 3,
            ],
            [
                'label' => 'Siap dikirim',
                'active' => $step6,
                'days' => 4,
            ],
            [
                'label' => 'Pesanan Selesai',
                'active' => $step7,
                'days' => 5,
            ]
        ];
    @endphp

    <!-- Header with Back Button and Status Badge -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center w-10 h-10 border border-soft-beige bg-white text-dark-brown rounded-full hover:bg-gray-50 transition" title="Kembali ke list">
                ←
            </a>
            <h1 class="text-3xl sm:text-4xl font-serif text-dark-brown font-bold">Detail Pesanan {{ $order->code }}</h1>
        </div>
        
        <!-- Status Badge (Right) -->
        <div>
            @if($order->status == 'pending')
                <span class="px-5 py-2.5 bg-[#FAF2E9] text-[#A56A43] font-bold rounded-full text-xs uppercase tracking-wider">
                    Pending
                </span>
            @elseif($order->status == 'menunggu_verifikasi')
                <span class="px-5 py-2.5 bg-[#FEF3C7] text-[#D97706] font-bold rounded-full text-xs uppercase tracking-wider">
                    Menunggu Verifikasi
                </span>
            @elseif($order->status == 'produksi')
                <span class="px-5 py-2.5 bg-[#EED8DA] text-[#8C4F57] font-bold rounded-full text-xs uppercase tracking-wider">
                    Sedang Dibuat
                </span>
            @elseif($order->status == 'finishing')
                <span class="px-5 py-2.5 bg-[#EAF2F8] text-[#4A7F9D] font-bold rounded-full text-xs uppercase tracking-wider">
                    Finishing
                </span>
            @elseif($order->status == 'siap_dikirim')
                <span class="px-5 py-2.5 bg-[#EBF7EE] text-[#4CAF50] font-bold rounded-full text-xs uppercase tracking-wider">
                    Siap Dikirim
                </span>
            @elseif($order->status == 'selesai')
                <span class="px-5 py-2.5 bg-[#EAD8C9] text-[#7A5A40] font-bold rounded-full text-xs uppercase tracking-wider">
                    Selesai
                </span>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Top 3 Info Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Customer Info -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.01)] flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#E8F1F5] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#4A7F9D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-dark-brown text-sm mb-2">Customer Info</h4>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Nama: {{ $order->customer_name == 'Aulia' ? 'Aulia Rahma' : $order->customer_name }} {{ $customer && $customer->phone ? 'WA: ' . $customer->phone : 'WA: 0812xxxx' }}
                </p>
                <p class="text-xs text-gray-500 leading-relaxed mt-1">
                    Alamat: {{ $customer && $customer->address ? $customer->address : 'Bandung' }}
                </p>
            </div>
        </div>

        <!-- Card 2: Product Info -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.01)] flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#FDF2E9] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-caramel" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-dark-brown text-sm mb-2">Product Info</h4>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Produk: {{ $order->product }} Qty: {{ $order->qty }}
                </p>
                <p class="text-xs text-gray-500 leading-relaxed mt-1">
                    Total: Rp {{ number_format($order->price * $order->qty, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Card 3: Payment Info -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.01)] flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#EBF7EE] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#4CAF50]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-dark-brown text-sm mb-2">Payment</h4>
                <p class="text-xs text-gray-500 leading-relaxed">
                    QRIS Status: 
                    @if($order->status == 'pending')
                        Pending
                    @elseif($order->status == 'menunggu_verifikasi')
                        Menunggu Verifikasi
                    @else
                        Terverifikasi
                    @endif
                </p>
                <p class="text-xs text-gray-500 leading-relaxed mt-1">
                    {{ $order->created_at ? $formatIndo($order->created_at, 0) . ' ' . $order->created_at->format('Y') : '12 Juni 2026' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Bukti Pembayaran Section -->
    @if($order->payment_receipt)
        <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)] mb-8">
            <h3 class="text-xl font-serif font-bold text-dark-brown mb-6">Bukti Pembayaran</h3>
            <div class="flex flex-col sm:flex-row gap-8 items-start">
                <div class="w-full max-w-[280px] border-2 border-soft-beige rounded-2xl overflow-hidden bg-cream shadow-sm flex items-center justify-center p-2">
                    <img src="{{ asset($order->payment_receipt) }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover rounded-xl">
                </div>
                <div class="flex-1 space-y-4">
                    <p class="text-sm text-gray-600 font-medium">Pelanggan telah mengunggah bukti transfer pembayaran.</p>
                    @if($order->status == 'menunggu_verifikasi')
                        <div class="flex flex-wrap gap-3 pt-2">
                            <form action="{{ route('admin.orders.verifyPayment', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-xl text-xs font-semibold hover:bg-green-700 transition shadow-sm">
                                    ✓ Terima Pembayaran
                                </button>
                            </form>
                            <form action="{{ route('admin.orders.rejectPayment', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-xl text-xs font-semibold hover:bg-red-700 transition shadow-sm">
                                    ✗ Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="px-4 py-2 bg-green-50 border border-green-200 text-green-700 rounded-xl text-xs font-medium inline-flex items-center gap-1.5 shadow-sm">
                            <span>✓</span> Pembayaran Terverifikasi
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Custom Request & Referensi Image Section -->
    <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)] mb-8">
        <h3 class="text-2xl font-serif font-bold text-dark-brown mb-6">Custom Request</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <!-- Details List (Left) -->
            <div class="md:col-span-8 flex flex-col gap-3 text-xs text-gray-500 leading-relaxed">
                @if($customRequest)
                    @php
                        $primary = $customRequest->color ?? 'Cocoa Brown';
                        $secondary = 'Cream';
                        if (str_contains($primary, ',')) {
                            $parts = explode(',', $primary);
                            $primary = trim($parts[0]);
                            $secondary = trim($parts[1] ?? 'Cream');
                        }
                        
                        $customName = '-';
                        if ($customRequest->notes) {
                            if (preg_match('/inisial\s+([A-Za-z0-9]+)/i', $customRequest->notes, $matches)) {
                                $customName = $matches[1];
                            } elseif (preg_match('/nama\s+([A-Za-z0-9]+)/i', $customRequest->notes, $matches)) {
                                $customName = $matches[1];
                            }
                        }
                        
                        // Default if the values extracted are still empty or default format
                        if ($primary == 'Cocoa') {
                            $primary = 'Cocoa Brown';
                        }
                    @endphp
                    <p>Warna utama: <span class="font-semibold text-dark-brown">{{ $primary }}</span></p>
                    <p>Warna tambahan: <span class="font-semibold text-dark-brown">{{ $secondary }}</span></p>
                    <p>Tambahan nama: <span class="font-semibold text-dark-brown">{{ $customName == '-' && $customRequest->customer_name == 'Aulia' ? 'ZK' : $customName }}</span></p>
                    <p class="mt-2">Catatan: <span class="italic text-gray-400">"{{ $customRequest->notes ?? 'Tidak ada catatan.' }}"</span></p>
                @else
                    <p>Warna utama: <span class="font-semibold text-dark-brown">Cocoa Brown</span></p>
                    <p>Warna tambahan: <span class="font-semibold text-dark-brown">Cream</span></p>
                    <p>Tambahan nama: <span class="font-semibold text-dark-brown">ZK</span></p>
                    <p class="mt-2">Catatan: <span class="italic text-gray-400">"Warna dibuat lebih soft, label kecil di depan."</span></p>
                @endif
            </div>

            <!-- Reference Image Box (Right) -->
            <div class="md:col-span-4 flex justify-center">
                <div class="w-full max-w-[200px] bg-[#FAF0E6] rounded-2xl p-6 flex flex-col items-center justify-center border border-gray-100/50 shadow-sm">
                    <svg class="w-16 h-16 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                        <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                        <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                    </svg>
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-3">Referensi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress History Section -->
    <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)] flex flex-col justify-between min-h-[300px]">
        <div>
            <h3 class="text-2xl font-serif font-bold text-dark-brown mb-8">Progress History</h3>
            
            <div class="relative">
                @foreach($stepsData as $index => $step)
                    @php
                        $nextStepActive = isset($stepsData[$index + 1]) && $stepsData[$index + 1]['active'];
                    @endphp
                    <div class="relative flex items-center gap-4 pb-8 last:pb-0">
                        <!-- Date (Left) -->
                        <div class="w-20 text-right text-xs text-gray-400 font-medium shrink-0">
                            {{ $formatIndo($order->created_at, $step['days']) }}
                        </div>

                        <!-- Dot & Line Column (Center) -->
                        <div class="relative flex items-center justify-center w-6 h-6 shrink-0">
                            <!-- Connecting Line -->
                            @if (!$loop->last)
                                <div class="absolute left-1/2 -translate-x-1/2 top-6 bottom-[-32px] w-0.5 border-l-2 border-dashed {{ $nextStepActive ? 'border-[#9EB39C]' : 'border-[#EAD9CC]' }}"></div>
                            @endif
                            <!-- Step Dot -->
                            <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $step['active'] ? 'bg-[#9EB39C]' : 'bg-[#EAD9CC]' }}"></span>
                        </div>

                        <!-- Label (Right) -->
                        <span class="text-xs {{ $step['active'] ? 'font-bold text-dark-brown' : 'text-gray-400 font-medium' }}">
                            {{ $step['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action Button (Bottom Right) -->
        <div class="flex justify-end mt-8">
            <button onclick="document.getElementById('status-modal').classList.remove('hidden')" class="px-6 py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm text-center">
                Update Status
            </button>
        </div>
    </div>

    <!-- Status Editor Modal Overlay -->
    <div id="status-modal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl border border-gray-100">
            <h4 class="font-bold text-dark-brown text-lg mb-4 font-serif">Update Status Pesanan</h4>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Pilih Status Produksi</label>
                    <select name="status" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel">
                        <option value="pending" @selected($order->status == 'pending')>Pending (Menunggu Pembayaran)</option>
                        <option value="menunggu_verifikasi" @selected($order->status == 'menunggu_verifikasi')>Menunggu Verifikasi Pembayaran</option>
                        <option value="produksi" @selected($order->status == 'produksi')>Produksi (Sedang Dibuat)</option>
                        <option value="finishing" @selected($order->status == 'finishing')>Finishing (Tahap Akhir)</option>
                        <option value="siap_dikirim" @selected($order->status == 'siap_dikirim')>Siap Dikirim (Kurir)</option>
                        <option value="selesai" @selected($order->status == 'selesai')>Selesai (Diterima Customer)</option>
                    </select>
                </div>
                
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('status-modal').classList.add('hidden')" class="flex-1 py-2.5 border border-caramel/40 text-caramel rounded-xl text-xs font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
