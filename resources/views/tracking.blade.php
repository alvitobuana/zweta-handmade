@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-caramel to-dusty-pink text-white rounded-3xl px-8 lg:px-12 py-12 mb-12">
        <h1 class="text-4xl lg:text-5xl font-serif mb-3">Lacak Pesanan Anda</h1>
        <p class="text-lg text-gray-100">Ketahui status terbaru pesanan tas handmade Anda</p>
    </div>

    @if (session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm flex items-center gap-3">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm shadow-sm flex items-center gap-3">
            <span>⚠️</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Search Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border-l-4 border-caramel">
        <p class="text-dark-brown font-semibold mb-4">Masukkan Kode Pesanan Anda</p>
        <form method="get" action="{{ route('tracking') }}" class="flex gap-3 flex-col sm:flex-row">
            <input 
                class="flex-1 px-6 py-3 border-2 border-soft-beige rounded-lg focus:outline-none focus:border-caramel placeholder-gray-400" 
                placeholder="Contoh: ZW-24001" 
                name="code" 
                value="{{ $code ?? '' }}"
                type="text"
            >
            <button type="submit" class="px-8 py-3 bg-caramel text-white font-semibold rounded-lg hover:bg-opacity-90 transition shadow-lg">
                🔍 Lacak
            </button>
        </form>
    </div>

    @if(auth()->check() && $userOrders->isNotEmpty())
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border-l-4 border-caramel">
            <h3 class="font-serif text-xl text-dark-brown font-semibold mb-4">📦 Daftar Pesanan Anda</h3>
            <p class="text-sm text-gray-600 mb-6">Pilih salah satu pesanan di bawah ini untuk melacak proses pembuatannya secara langsung.</p>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-soft-beige/50 text-gray-400 font-bold uppercase tracking-wider text-xs">
                            <th class="pb-3">Kode</th>
                            <th class="pb-3">Produk</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Total Harga</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-soft-beige/20 text-xs">
                        @foreach($userOrders as $uo)
                            <tr class="hover:bg-cream/40 transition">
                                <td class="py-4 font-bold text-dark-brown">{{ $uo->code }}</td>
                                <td class="py-4 text-gray-700">{{ $uo->product }}</td>
                                <td class="py-4 text-gray-500">{{ $uo->created_at ? $uo->created_at->format('d M Y') : '-' }}</td>
                                <td class="py-4 font-semibold text-caramel">Rp {{ number_format($uo->price, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide text-white
                                        @if($uo->status == 'pending') bg-yellow-500
                                        @elseif($uo->status == 'menunggu_verifikasi') bg-amber-500
                                        @elseif($uo->status == 'produksi') bg-blue-500
                                        @elseif($uo->status == 'finishing') bg-purple-500
                                        @elseif($uo->status == 'siap_dikirim') bg-indigo-500
                                        @elseif($uo->status == 'selesai') bg-green-500
                                        @else bg-gray-500 @endif">
                                        @if($uo->status == 'pending') Menunggu Pembayaran
                                        @elseif($uo->status == 'menunggu_verifikasi') Verifikasi
                                        @elseif($uo->status == 'produksi') Sedang Dibuat
                                        @elseif($uo->status == 'finishing') Finishing
                                        @elseif($uo->status == 'siap_dikirim') Siap Dikirim
                                        @elseif($uo->status == 'selesai') Selesai
                                        @else {{ ucfirst($uo->status) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <a href="{{ route('tracking', ['code' => $uo->code]) }}" class="px-4 py-2 bg-caramel text-white rounded-lg font-semibold hover:bg-opacity-95 transition shadow-sm {{ $code == $uo->code ? 'ring-2 ring-caramel ring-offset-2 opacity-75' : '' }}">
                                        {{ $code == $uo->code ? 'Sedang Dilacak' : 'Lacak' }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
                <div class="bg-white rounded-xl p-6 border-l-4 border-caramel shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Nama Customer</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $order->customer_name }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-blue-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Produk</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $order->product }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-purple-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Jumlah</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $order->qty }} pcs</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-green-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Total Harga</p>
                    <p class="text-xl font-semibold text-caramel">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <p class="text-sm text-gray-600 mb-3">Status Saat Ini</p>
                <span class="inline-block px-6 py-3 rounded-full text-white font-semibold
                    @if($order->status == 'pending') bg-yellow-500
                    @elseif($order->status == 'menunggu_verifikasi') bg-amber-500
                    @elseif($order->status == 'produksi') bg-blue-500
                    @elseif($order->status == 'finishing') bg-purple-500
                    @elseif($order->status == 'siap_dikirim') bg-indigo-500
                    @elseif($order->status == 'selesai') bg-green-500
                    @else bg-gray-500 @endif">
                    @if($order->status == 'pending') Menunggu Pembayaran
                    @elseif($order->status == 'menunggu_verifikasi') Menunggu Verifikasi Pembayaran
                    @elseif($order->status == 'produksi') Sedang Dibuat
                    @elseif($order->status == 'finishing') Proses Finishing
                    @elseif($order->status == 'siap_dikirim') Siap Dikirim
                    @elseif($order->status == 'selesai') Selesai / Diterima
                    @else {{ ucfirst($order->status) }}
                    @endif
                </span>
            </div>

            <!-- Bukti Pembayaran Form & Status -->
            @if ($order->status == 'pending')
                <div class="bg-white rounded-2xl p-8 border-l-4 border-caramel shadow-md">
                    <h3 class="text-xl font-serif text-dark-brown font-semibold mb-4">Upload Bukti Pembayaran</h3>
                    <p class="text-sm text-gray-600 mb-6">Silakan lakukan transfer ke rekening di bawah ini, lalu unggah foto bukti transfer Anda untuk verifikasi.</p>
                    
                    <!-- Bank info -->
                    <div class="mb-8">
                        <div class="bg-[#FFFDF9] p-6 rounded-2xl border border-soft-beige max-w-md">
                            <p class="text-xs font-bold text-caramel uppercase tracking-wider mb-3">Metode Pembayaran (Transfer Bank)</p>
                            <div class="flex items-center justify-between border-b border-soft-beige/50 pb-3 mb-3">
                                <span class="text-sm text-gray-500">Nama Bank</span>
                                <span class="font-bold text-dark-brown text-sm">Bank BCA</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-soft-beige/50 pb-3 mb-3">
                                <span class="text-sm text-gray-500">Nomor Rekening</span>
                                <span class="font-bold text-dark-brown text-base select-all">123-456-7890</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Nama Penerima</span>
                                <span class="font-semibold text-dark-brown text-sm">Zweta Handmade</span>
                            </div>
                        </div>
                                  <form action="{{ route('tracking.uploadReceipt', $order->code) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-dark-brown mb-3">Pilih File Foto Bukti Transfer</label>
                            
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <!-- Dropzone -->
                                <div class="flex-1 w-full">
                                    <label id="receipt_dropzone" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-soft-beige rounded-2xl cursor-pointer bg-cream hover:bg-soft-beige hover:bg-opacity-20 transition relative text-center px-4">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <span class="text-3xl mb-2">📄</span>
                                            <p class="text-sm text-gray-600 font-medium">Drag & drop bukti transfer ke sini atau klik untuk upload</p>
                                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                                        </div>
                                        <input type="file" name="receipt" id="receipt_input" required class="hidden" accept="image/*" />
                                    </label>
                                </div>
                                
                                <!-- Preview Container -->
                                <div class="w-full md:w-64">
                                    <p class="text-xs font-semibold text-gray-500 mb-2">Live Preview:</p>
                                    <div class="bg-gray-50 border border-soft-beige rounded-2xl h-40 flex items-center justify-center overflow-hidden shadow-sm">
                                        <img id="receipt_preview" src="" alt="Preview Bukti Transfer" class="w-full h-full object-cover hidden">
                                        <div id="receipt_preview_placeholder" class="text-center p-4">
                                            <span class="text-3xl text-gray-300 block mb-1">📷</span>
                                            <p class="text-[11px] text-gray-400 font-medium">Belum ada file terpilih</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="px-8 py-3 bg-caramel text-white font-semibold rounded-xl hover:bg-opacity-95 transition shadow-lg w-full sm:w-auto flex items-center justify-center gap-2">
                            <span>📤</span> Unggah & Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            @elseif ($order->status == 'menunggu_verifikasi')
                <div class="bg-[#FFFDF9] border-l-4 border-amber-500 rounded-2xl p-8 shadow-md">
                    <h3 class="text-xl font-serif text-amber-700 font-semibold mb-2">Menunggu Verifikasi Pembayaran</h3>
                    <p class="text-sm text-gray-600 mb-6">Bukti transfer Anda telah berhasil diunggah dan sedang dalam proses peninjauan oleh admin. Mohon ditunggu.</p>
                    @if($order->payment_receipt)
                        <div class="w-48 border border-soft-beige rounded-2xl overflow-hidden bg-white shadow-sm">
                            <img src="{{ asset($order->payment_receipt) }}" alt="Bukti Transfer" class="w-full h-auto object-cover">
                        </div>
                    @endif
                </div>
            @endif

            <!-- Timeline Progress -->
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <h3 class="text-xl font-serif text-dark-brown mb-8">Tahapan Pesanan</h3>
                
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-caramel to-gray-300"></div>

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
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) ✓ @else 2 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) text-green-700 @else text-gray-600 @endif">Pembayaran Terverifikasi</p>
                                <p class="text-sm @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) text-green-600 @else text-gray-500 @endif">Proses verifikasi pembayaran</p>
                            </div>
                        </div>

                        <!-- Mulai Produksi -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) ✓ @else 3 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) text-green-700 @else text-gray-600 @endif">Mulai Produksi</p>
                                <p class="text-sm @if(in_array($order->status, ['produksi', 'finishing', 'siap_dikirim', 'selesai'])) text-green-600 @else text-gray-500 @endif">Tim produksi mulai membuat tas</p>
                            </div>
                        </div>

                        <!-- Proses Finishing -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['finishing', 'siap_dikirim', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['finishing', 'siap_dikirim', 'selesai'])) ✓ @else 4 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['finishing', 'siap_dikirim', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['finishing', 'siap_dikirim', 'selesai'])) text-green-700 @else text-gray-600 @endif">Proses Finishing</p>
                                <p class="text-sm @if(in_array($order->status, ['finishing', 'siap_dikirim', 'selesai'])) text-green-600 @else text-gray-500 @endif">Kualitas diperiksa dan dikemas</p>
                            </div>
                        </div>

                        <!-- Siap Dikirim -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if(in_array($order->status, ['siap_dikirim', 'selesai'])) bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if(in_array($order->status, ['siap_dikirim', 'selesai'])) ✓ @else 5 @endif
                            </div>
                            <div class="@if(in_array($order->status, ['siap_dikirim', 'selesai'])) bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if(in_array($order->status, ['siap_dikirim', 'selesai'])) text-green-700 @else text-gray-600 @endif">Siap Dikirim</p>
                                <p class="text-sm @if(in_array($order->status, ['siap_dikirim', 'selesai'])) text-green-600 @else text-gray-500 @endif">Pesanan siap untuk pengiriman</p>
                            </div>
                        </div>

                        <!-- Pesanan Selesai -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 @if($order->status == 'selesai') bg-green-500 @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white text-lg">
                                @if($order->status == 'selesai') ✓ @else 6 @endif
                            </div>
                            <div class="@if($order->status == 'selesai') bg-green-50 border-green-500 @else bg-gray-50 border-gray-300 @endif rounded-lg p-4 border-l-4">
                                <p class="font-semibold @if($order->status == 'selesai') text-green-700 @else text-gray-600 @endif">Pesanan Selesai</p>
                                <p class="text-sm @if($order->status == 'selesai') text-green-600 @else text-gray-500 @endif">Pesanan selesai dan diterima dengan baik</p>
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
        <div class="bg-gradient-to-r from-soft-beige to-cream rounded-2xl p-12 text-center border-2 border-caramel">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-2xl font-serif text-dark-brown mb-3">Belum Ada Kode Pesanan?</h3>
            <p class="text-gray-700 mb-8 max-w-md mx-auto">Masukkan kode pesanan Anda di atas untuk melacak status dan memantau proses pembuatan tas handmade Anda secara real-time.</p>
            <div class="inline-block">
                <p class="text-sm font-semibold text-caramel">💡 Contoh kode pesanan: ZW-24001</p>
            </div>
        </div>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('receipt_input');
            const preview = document.getElementById('receipt_preview');
            const placeholder = document.getElementById('receipt_preview_placeholder');
            const dropZone = document.getElementById('receipt_dropzone');

            if (input) {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = "";
                        preview.classList.add('hidden');
                        placeholder.classList.remove('hidden');
                    }
                });
            }

            if (dropZone && input) {
                // Drag events
                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropZone.classList.add('border-caramel', 'bg-opacity-40');
                        dropZone.classList.remove('border-soft-beige');
                    }, false);
                });

                ['dragleave', 'dragend'].forEach(eventName => {
                    dropZone.addEventListener(eventName, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropZone.classList.remove('border-caramel', 'bg-[#FAF0E6]/50');
                        dropZone.classList.add('border-soft-beige');
                    }, false);
                });

                // Drop event
                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.remove('border-caramel', 'bg-opacity-40');
                    dropZone.classList.add('border-soft-beige');
                    
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    if (files && files[0]) {
                        input.files = files;
                        // Trigger the change event manually to run the preview logic
                        const event = new Event('change');
                        input.dispatchEvent(event);
                    }
                }, false);
            }
        });
    </script>
    @endpush
@endsection

