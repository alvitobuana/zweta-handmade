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
                                <td class="py-4 font-semibold text-caramel">
                                    @if(isset($uo->is_custom_request))
                                        Menunggu Estimasi
                                    @else
                                        Rp {{ number_format($uo->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="py-4">
                                    @if(isset($uo->is_custom_request))
                                        @if($uo->status == 'dibatalkan')
                                            <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide text-white bg-red-500">
                                                Ditolak Admin
                                            </span>
                                        @else
                                            <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide text-white bg-amber-500">
                                                Menunggu Konfirmasi
                                            </span>
                                        @endif
                                    @else
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
                                    @endif
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

    <!-- Search     @if ($order)
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
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 mb-8">
                    <p class="text-sm text-blue-600 mb-2">Catatan:</p>
                    <p class="text-blue-900">{{ $order->notes }}</p>
                </div>
            @endif

            <!-- Review Section -->
            @if($order->status === 'selesai' && auth()->check())
                <div class="bg-gradient-to-br from-soft-beige to-white rounded-2xl p-8 shadow-md border border-caramel/20">
                    <h3 class="text-2xl font-serif text-dark-brown mb-6 flex items-center gap-2">
                        <span>⭐</span> Ulasan Produk
                    </h3>
                    
                    @if($existingReview)
                        <div class="bg-white rounded-xl p-6 border border-soft-beige shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-caramel flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-dark-brown">Ulasan Anda</p>
                                    <p class="text-sm text-yellow-500">
                                        {!! str_repeat('★', $existingReview->rating) !!}{!! str_repeat('<span class="text-gray-300">★</span>', 5 - $existingReview->rating) !!}
                                    </p>
                                </div>
                                <div class="ml-auto text-xs text-gray-400">
                                    {{ $existingReview->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">{{ $existingReview->comment }}</p>
                            @if($existingReview->media_path)
                                <div class="border border-soft-beige rounded-xl overflow-hidden inline-block shadow-sm">
                                    @if($existingReview->media_type == 'video')
                                        <video src="{{ asset($existingReview->media_path) }}" controls class="h-32 object-cover"></video>
                                    @else
                                        <img src="{{ asset($existingReview->media_path) }}" alt="Review Media" class="h-32 object-cover cursor-pointer hover:opacity-90" onclick="window.open('{{ asset($existingReview->media_path) }}', '_blank')">
                                    @endif
                                </div>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('product.review.store', $order->code) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm text-gray-600 mb-2 font-medium">Rating (1-5)</label>
                                <div class="flex flex-row-reverse justify-end gap-1 rating-stars">
                                    <input type="radio" id="star5" name="rating" value="5" class="hidden peer" required />
                                    <label for="star5" class="text-gray-300 text-3xl cursor-pointer peer-checked:text-yellow-500 hover:text-yellow-400 transition-colors">★</label>
                                    
                                    <input type="radio" id="star4" name="rating" value="4" class="hidden peer" />
                                    <label for="star4" class="text-gray-300 text-3xl cursor-pointer peer-checked:text-yellow-500 hover:text-yellow-400 transition-colors peer-checked:peer-hover:text-yellow-500">★</label>
                                    
                                    <input type="radio" id="star3" name="rating" value="3" class="hidden peer" />
                                    <label for="star3" class="text-gray-300 text-3xl cursor-pointer peer-checked:text-yellow-500 hover:text-yellow-400 transition-colors peer-checked:peer-hover:text-yellow-500">★</label>
                                    
                                    <input type="radio" id="star2" name="rating" value="2" class="hidden peer" />
                                    <label for="star2" class="text-gray-300 text-3xl cursor-pointer peer-checked:text-yellow-500 hover:text-yellow-400 transition-colors peer-checked:peer-hover:text-yellow-500">★</label>
                                    
                                    <input type="radio" id="star1" name="rating" value="1" class="hidden peer" />
                                    <label for="star1" class="text-gray-300 text-3xl cursor-pointer peer-checked:text-yellow-500 hover:text-yellow-400 transition-colors peer-checked:peer-hover:text-yellow-500">★</label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm text-gray-600 mb-2 font-medium">Komentar (Opsional)</label>
                                <textarea name="comment" rows="3" class="w-full border-2 border-soft-beige rounded-xl px-4 py-3 bg-white text-dark-brown focus:border-caramel focus:outline-none transition-colors" placeholder="Ceritakan pengalaman Anda dengan produk ini..."></textarea>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-sm text-gray-600 mb-2 font-medium">Upload Foto / Video (Opsional)</label>
                                <div class="relative w-full border-2 border-dashed border-caramel/50 rounded-2xl p-6 text-center hover:bg-caramel/5 transition bg-white group cursor-pointer" onclick="document.getElementById('review_media').click()">
                                    <input type="file" id="review_media" name="media" class="hidden" accept="image/jpeg,image/png,image/jpg,video/mp4,video/quicktime" onchange="previewReviewMedia(this)">
                                    <div id="media_preview_container" class="hidden mt-2 mb-4 relative max-w-xs mx-auto">
                                        <img id="media_preview_img" src="" class="rounded-xl shadow-sm hidden w-full">
                                        <video id="media_preview_vid" src="" class="rounded-xl shadow-sm hidden w-full" controls></video>
                                    </div>
                                    <div id="media_upload_prompt">
                                        <span class="text-3xl text-caramel mb-2 block group-hover:scale-110 transition-transform">📸</span>
                                        <p class="text-sm text-gray-600 font-medium">Klik untuk memilih file</p>
                                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, MP4 (Max 10MB)</p>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-caramel text-white font-semibold rounded-xl hover:bg-opacity-90 transition shadow-lg text-center flex items-center justify-center gap-2">
                                <span>🚀</span> Kirim Ulasan
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    @elseif ($customRequest)
        <!-- Rendering CustomRequest (Before Admin Approval) -->
        <div class="space-y-8">
            <!-- Custom Request Header -->
            @if($customRequest->status == 'dibatalkan')
                <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-300 rounded-2xl p-8">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl">❌</span>
                        <h2 class="text-2xl font-serif text-red-800">Request Custom Ditolak Admin</h2>
                    </div>
                    <p class="text-red-700">Kode Request: <span class="font-bold">{{ $customRequest->code }}</span></p>
                </div>
            @else
                <div class="bg-gradient-to-r from-amber-50 to-amber-100 border border-amber-300 rounded-2xl p-8">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl">📝</span>
                        <h2 class="text-2xl font-serif text-amber-800">Request Custom Diterima Admin!</h2>
                    </div>
                    <p class="text-amber-700">Kode Request: <span class="font-bold">{{ $customRequest->code }}</span></p>
                </div>
            @endif

            <!-- Custom Request Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 border-l-4 border-caramel shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Model Tas</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $customRequest->model ?? 'Custom' }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-blue-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Warna Utama</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $customRequest->color }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-purple-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Deadline Diinginkan</p>
                    <p class="text-xl font-semibold text-dark-brown">{{ $customRequest->deadline ? $customRequest->deadline->format('d M Y') : 'Tanpa Deadline' }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 border-l-4 border-yellow-500 shadow-md">
                    <p class="text-sm text-gray-600 mb-2">Estimasi Harga</p>
                    @if($customRequest->status == 'dibatalkan')
                        <p class="text-xl font-bold text-red-600">Dibatalkan</p>
                    @else
                        <p class="text-xl font-bold text-amber-600">Menunggu Estimasi</p>
                    @endif
                </div>
            </div>

            <!-- Status Badge -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <p class="text-sm text-gray-600 mb-3">Status Saat Ini</p>
                @if($customRequest->status == 'dibatalkan')
                    <span class="inline-block px-6 py-3 rounded-full text-white font-semibold bg-red-600">
                        Request Ditolak oleh Admin
                    </span>
                @else
                    <span class="inline-block px-6 py-3 rounded-full text-white font-semibold bg-amber-500">
                        Menunggu Persetujuan & Estimasi Harga Admin
                    </span>
                @endif
            </div>

            <!-- Alasan Penolakan if exists -->
            @if($customRequest->status == 'dibatalkan' && $customRequest->rejection_reason)
                <div class="bg-red-50 border-l-4 border-red-500 rounded-2xl p-8 shadow-md">
                    <h3 class="text-xl font-serif text-red-800 font-semibold mb-2">Alasan Penolakan Admin:</h3>
                    <p class="text-sm text-red-700 font-medium leading-relaxed">"{{ $customRequest->rejection_reason }}"</p>
                </div>
            @endif

            <!-- Reference Image if exists -->
            @if($customRequest->reference_image)
                <div class="bg-white rounded-2xl p-8 border-l-4 border-caramel shadow-md">
                    <h3 class="text-xl font-serif text-dark-brown font-semibold mb-4">Gambar Referensi</h3>
                    <div class="w-64 border border-soft-beige rounded-2xl overflow-hidden bg-white shadow-sm">
                        <img src="{{ asset($customRequest->reference_image) }}" alt="Gambar Referensi" class="w-full h-auto object-cover">
                    </div>
                </div>
            @endif

            <!-- Custom Request Timeline Progress -->
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <h3 class="text-xl font-serif text-dark-brown mb-8">Tahapan Request Custom</h3>
                
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-caramel to-gray-300"></div>

                    <!-- Timeline Items -->
                    <div class="space-y-8">
                        <!-- Request Dikirim -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-lg">✓</div>
                            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-500">
                                <p class="font-semibold text-green-700">Request Custom Dikirim</p>
                                <p class="text-sm text-green-600">Telah dikirim pada {{ $customRequest->created_at ? $customRequest->created_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                        </div>

                        <!-- Review Admin -->
                        @if($customRequest->status == 'dibatalkan')
                            <div class="relative pl-20">
                                <div class="absolute left-0 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white text-lg">
                                    ❌
                                </div>
                                <div class="bg-red-50 border-red-500 rounded-lg p-4 border-l-4">
                                    <p class="font-semibold text-red-700">Request Custom Ditolak</p>
                                    <p class="text-sm text-red-600">Request custom Anda ditolak oleh admin. Silakan buat request baru dengan menyesuaikan catatan dari admin.</p>
                                </div>
                            </div>
                        @else
                            <div class="relative pl-20">
                                <div class="absolute left-0 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white text-lg">
                                    <span class="animate-ping absolute inline-flex h-8 w-8 rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative">2</span>
                                </div>
                                <div class="bg-amber-50 border-amber-500 rounded-lg p-4 border-l-4">
                                    <p class="font-semibold text-amber-700">Menunggu Estimasi Harga & Konfirmasi Admin</p>
                                    <p class="text-sm text-amber-600">Admin sedang memeriksa detail request custom Anda. Mohon ditunggu.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Pembayaran -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 text-lg">3</div>
                            <div class="bg-gray-50 border-gray-200 rounded-lg p-4 border-l-4">
                                <p class="font-semibold text-gray-500">Menunggu Pembayaran</p>
                                <p class="text-sm text-gray-400">Pembayaran dilakukan setelah harga dikonfirmasi oleh admin</p>
                            </div>
                        </div>

                        <!-- Produksi -->
                        <div class="relative pl-20">
                            <div class="absolute left-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 text-lg">4</div>
                            <div class="bg-gray-50 border-gray-200 rounded-lg p-4 border-l-4">
                                <p class="font-semibold text-gray-500">Mulai Produksi</p>
                                <p class="text-sm text-gray-400">Proses pengerjaan tas handmade Anda oleh pengrajin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($customRequest->notes)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
                    <p class="text-sm text-blue-600 mb-2">Catatan Request Anda:</p>
                    <p class="text-blue-900">{{ $customRequest->notes }}</p>
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

        function previewReviewMedia(input) {
            const file = input.files[0];
            if (!file) return;

            const container = document.getElementById('media_preview_container');
            const imgPreview = document.getElementById('media_preview_img');
            const vidPreview = document.getElementById('media_preview_vid');
            const prompt = document.getElementById('media_upload_prompt');

            // Reset
            imgPreview.classList.add('hidden');
            vidPreview.classList.add('hidden');
            prompt.classList.add('hidden');
            container.classList.remove('hidden');

            const url = URL.createObjectURL(file);
            
            if (file.type.startsWith('video/')) {
                vidPreview.src = url;
                vidPreview.classList.remove('hidden');
            } else {
                imgPreview.src = url;
                imgPreview.classList.remove('hidden');
            }
        }
    </script>
    @endpush
@endsection

