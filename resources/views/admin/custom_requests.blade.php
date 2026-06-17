@extends('layouts.admin')

@section('content')
    @php
        $monthsMap = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
        ];
        $formatIndo = function($date) use ($monthsMap) {
            if (!$date) return '-';
            $engMonth = $date->format('F');
            $indoMonth = $monthsMap[$engMonth] ?? $engMonth;
            return $date->format('j') . ' ' . $indoMonth;
        };
    @endphp

    <div class="mb-10">
        <h1 class="text-4xl font-serif text-dark-brown font-bold mb-2">Custom Order Request</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)] mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-dark-brown">
                        <th class="pb-4 font-bold text-xs">Customer</th>
                        <th class="pb-4 font-bold text-xs">Produk</th>
                        <th class="pb-4 font-bold text-xs">Deadline</th>
                        <th class="pb-4 font-bold text-xs">Status</th>
                        <th class="pb-4 font-bold text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($requests as $index => $r)
                        @php
                            // Format product name: e.g. "Tote Bag" -> "Tote Custom"
                            $prodName = $r->model ?? 'Tote';
                            if (str_contains(strtolower($prodName), 'tote')) {
                                $prodName = 'Tote Custom';
                            } elseif (str_contains(strtolower($prodName), 'sling')) {
                                $prodName = 'Sling Custom';
                            } else {
                                $prodName = $prodName . ' Custom';
                            }
                            
                            // Format status label
                            $statusLabel = 'Menunggu';
                            if ($r->status == 'diproses') $statusLabel = 'Diproses';
                            if ($r->status == 'selesai') $statusLabel = 'Selesai';
                            if ($r->status == 'dibatalkan') $statusLabel = 'Dibatalkan';
                        @endphp
                        <tr class="hover:bg-[#FFF8F2]/30 transition-colors cursor-pointer" onclick="selectRequest({{ $r->id }})" id="row-{{ $r->id }}">
                            <td class="py-4 text-xs font-semibold text-dark-brown">{{ $r->customer_name }}</td>
                            <td class="py-4 text-xs text-gray-500">{{ $prodName }}</td>
                            <td class="py-4 text-xs text-gray-500">{{ $formatIndo($r->deadline) }}</td>
                            <td class="py-4 text-xs text-gray-500">{{ $statusLabel }}</td>
                            <td class="py-4 text-xs font-bold text-caramel text-right">
                                <button type="button" class="hover:underline focus:outline-none">
                                    Lihat
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-gray-400">Tidak ada custom request ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($requests->hasPages())
            <div class="mt-6">
                {{ $requests->links() }}
            </div>
        @endif
    </div>

    <!-- Detail Request Terpilih Card -->
    <div id="detail-card" class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)] hidden">
        <h3 class="text-2xl font-serif font-bold text-dark-brown mb-6">Detail Request Terpilih</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Info Panel (6 cols) -->
            <div class="lg:col-span-5 space-y-4 text-xs text-gray-500 leading-relaxed">
                <p>Model: <span id="detail-model" class="font-semibold text-dark-brown">-</span></p>
                <p>Warna: <span id="detail-color" class="font-semibold text-dark-brown">-</span></p>
                <p>Ukuran: <span id="detail-size" class="font-semibold text-dark-brown">-</span></p>
                <p class="pt-2">Catatan: <span id="detail-notes" class="italic text-gray-400">"-"</span></p>
            </div>

            <!-- Middle Input Fields (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Harga Custom</label>
                    <input type="text" id="input-price" value="Rp 150.000" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-xs focus:outline-none focus:border-caramel text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Estimasi</label>
                    <input type="text" id="input-estimation" value="7 hari" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-xs focus:outline-none focus:border-caramel text-gray-700">
                </div>
            </div>

            <!-- Right Box & Actions (3 cols) -->
            <div class="lg:col-span-3 flex flex-col items-center gap-6">
                <!-- Reference Image Box -->
                <div id="reference-image-container" class="w-full max-w-[180px] h-[180px] bg-[#FAF0E6] rounded-2xl flex flex-col items-center justify-center border border-gray-100/50 shadow-sm shrink-0 overflow-hidden">
                    <svg class="w-16 h-16 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                        <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                        <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                    </svg>
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-3">Referensi</span>
                </div>

                <!-- Status Update Forms -->
                <div class="w-full flex gap-3">
                    <form id="form-terima" method="post" action="" class="flex-1">
                        @csrf
                        <input type="hidden" name="status" value="diproses">
                        <button type="submit" class="w-full py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm text-center">
                            Terima
                        </button>
                    </form>
                    <form id="form-tolak" method="post" action="" class="flex-1">
                        @csrf
                        <input type="hidden" name="status" value="dibatalkan">
                        <button type="submit" class="w-full py-2.5 border border-caramel/40 text-caramel bg-white rounded-xl text-xs font-semibold hover:bg-red-500/10 transition text-center">
                            Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle interactive detail loading -->
    <script>
        // Store all request details in a JSON map
        const requestsData = {
            @foreach($requests as $r)
                "{{ $r->id }}": {
                    "id": {{ $r->id }},
                    "model": "{{ $r->model ?? 'Tote Bag' }}",
                    "color": "{{ $r->color ?? 'Cocoa' }}",
                    "notes": "{!! addslashes($r->notes ?? '') !!}",
                    "reference_image": "{{ $r->reference_image ? asset($r->reference_image) : '' }}",
                    "updateUrl": "{{ route('admin.customrequests.updateStatus', $r->id) }}"
                },
            @endforeach
        };

        function selectRequest(id) {
            const data = requestsData[id];
            if (!data) return;

            // Highlight selected row
            document.querySelectorAll('tbody tr').forEach(tr => tr.classList.remove('bg-[#FFF8F2]/60'));
            const activeRow = document.getElementById('row-' + id);
            if (activeRow) activeRow.classList.add('bg-[#FFF8F2]/60');

            // Parse size (ukuran) from notes
            let size = 'Medium';
            const notesLower = data.notes.toLowerCase();
            if (notesLower.includes('small') || notesLower.includes('kecil')) {
                size = 'Small';
            } else if (notesLower.includes('large') || notesLower.includes('besar') || notesLower.includes('medium')) {
                if (notesLower.includes('large') || notesLower.includes('besar')) {
                    size = 'Large';
                } else {
                    size = 'Medium';
                }
            } else {
                // Check if notes contains "ukuran X"
                if (notesLower.includes('ukuran')) {
                    if (notesLower.includes('medium')) size = 'Medium';
                    if (notesLower.includes('small')) size = 'Small';
                    if (notesLower.includes('large')) size = 'Large';
                }
            }

            // Parse colors
            let colorDisplay = data.color;
            if (colorDisplay === 'Cocoa' || colorDisplay === 'Cocoa Brown') {
                colorDisplay = 'Cocoa + Cream';
            }

            // Populate detail fields
            document.getElementById('detail-model').innerText = data.model;
            document.getElementById('detail-color').innerText = colorDisplay;
            document.getElementById('detail-size').innerText = size;
            document.getElementById('detail-notes').innerText = data.notes ? data.notes : 'Tidak ada catatan.';

            // Populate reference image
            const imgContainer = document.getElementById('reference-image-container');
            if (data.reference_image) {
                imgContainer.innerHTML = `
                    <a href="${data.reference_image}" target="_blank" class="w-full h-full block group relative">
                        <img src="${data.reference_image}" alt="Reference Image" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-[10px] text-white font-bold uppercase tracking-wider">Perbesar 🔍</span>
                        </div>
                    </a>
                `;
            } else {
                imgContainer.innerHTML = `
                    <svg class="w-16 h-16 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                        <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                        <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                    </svg>
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-3">Tidak Ada</span>
                `;
            }

            // Update form actions
            document.getElementById('form-terima').action = data.updateUrl;
            document.getElementById('form-tolak').action = data.updateUrl;

            // Show details card
            document.getElementById('detail-card').classList.remove('hidden');
        }

        // Auto-select the first request on page load
        window.addEventListener('DOMContentLoaded', () => {
            const firstId = Object.keys(requestsData)[0];
            if (firstId) {
                selectRequest(firstId);
            }
        });
    </script>
@endsection
