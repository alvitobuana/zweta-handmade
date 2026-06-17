@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-dusty-pink to-caramel text-white rounded-3xl px-8 lg:px-12 py-12 mb-12">
        <h1 class="text-4xl lg:text-5xl font-serif mb-3">Custom Order</h1>
        <p class="text-lg text-gray-100">Wujudkan desain tas impian Anda dengan spesifikasi yang Anda inginkan</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-12 mb-16">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-serif text-dark-brown mb-8">📝 Informasi Custom Order</h2>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('custom.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Customer Info Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-dark-brown mb-4">Informasi Pelanggan</h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required 
                                    class="w-full px-4 py-3 border-2 @error('customer_name') border-red-500 @else border-soft-beige @enderror rounded-lg focus:outline-none focus:border-caramel">
                                @error('customer_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required 
                                    class="w-full px-4 py-3 border-2 @error('phone') border-red-500 @else border-soft-beige @enderror rounded-lg focus:outline-none focus:border-caramel">
                                @error('phone')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full px-4 py-3 border-2 @error('email') border-red-500 @else border-soft-beige @enderror rounded-lg focus:outline-none focus:border-caramel">
                            @error('email')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Design Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-dark-brown mb-4">Spesifikasi Tas</h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Model Tas *</label>
                                <select name="model" required 
                                    class="w-full px-4 py-3 border-2 @error('model') border-red-500 @else border-soft-beige @enderror rounded-lg focus:outline-none focus:border-caramel">
                                    <option value="">Pilih Model</option>
                                    <option value="Sling Bag" @selected(old('model') == 'Sling Bag')>Sling Bag</option>
                                    <option value="Backpack" @selected(old('model') == 'Backpack')>Backpack</option>
                                    <option value="Totebag" @selected(old('model') == 'Totebag')>Tote Bag</option>
                                </select>
                                @error('model')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Warna Utama *</label>
                                <select name="color" required 
                                    class="w-full px-4 py-3 border-2 @error('color') border-red-500 @else border-soft-beige @enderror rounded-lg focus:outline-none focus:border-caramel">
                                    <option value="">Pilih Warna</option>
                                    <option value="Coklat" @selected(old('color') == 'Coklat')>Coklat</option>
                                    <option value="Krem" @selected(old('color') == 'Krem')>Krem</option>
                                    <option value="Merah Muda" @selected(old('color') == 'Merah Muda')>Merah Muda</option>
                                    <option value="Sage" @selected(old('color') == 'Sage')>Sage</option>
                                    <option value="Hitam" @selected(old('color') == 'Hitam')>Hitam</option>
                                </select>
                                @error('color')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan/Permintaan Khusus</label>
                            <textarea name="notes" rows="4" placeholder="Jelaskan desain tas impian Anda, detail khusus, atau permintaan tambahan..." 
                                class="w-full px-4 py-3 border-2 border-soft-beige rounded-lg focus:outline-none focus:border-caramel resize-none">{{ old('notes') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Referensi (Opsional)</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-soft-beige rounded-lg cursor-pointer bg-cream hover:bg-soft-beige hover:bg-opacity-20 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <span class="text-3xl mb-2">🖼️</span>
                                        <p class="text-sm text-gray-600 font-medium">Klik untuk upload gambar referensi</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                    <input type="file" name="reference_image" id="reference_image_input" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            @error('reference_image')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-dark-brown mb-4">Timeline Pengerjaan</h3>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deadline Diinginkan (Opsional)</label>
                            <input type="date" name="deadline" value="{{ old('deadline') }}" 
                                class="w-full px-4 py-3 border-2 border-soft-beige rounded-lg focus:outline-none focus:border-caramel">
                            <p class="text-xs text-gray-600 mt-2">Kami akan berusaha memenuhi deadline Anda. Pengerjaan standar: 3-7 hari kerja.</p>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="pt-6 border-t-2 border-soft-beige">
                        <button type="submit" class="w-full px-8 py-3 bg-caramel text-white font-semibold rounded-lg hover:bg-opacity-90 transition shadow-lg text-lg">
                            ✉️ Kirim Request Custom
                        </button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="mt-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                        <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                        @foreach ($errors->all() as $error)
                            <p class="text-sm">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Preview & Info Section -->
        <div class="space-y-6">
            <!-- Preview Card -->
            <div class="bg-gradient-to-br from-soft-beige to-cream rounded-2xl p-8 shadow-lg">
                <h3 class="text-lg font-serif text-dark-brown mb-4">👜 Gambar Referensi</h3>
                <div class="bg-white rounded-xl h-64 flex items-center justify-center mb-4 shadow-md overflow-hidden border border-soft-beige">
                    <img id="reference_image_preview" src="" alt="Preview Gambar Referensi" class="w-full h-full object-cover hidden">
                    <div id="preview_placeholder" class="text-center p-4">
                        <span class="text-4xl text-gray-400 block mb-2">📷</span>
                        <p class="text-sm text-gray-500 font-medium">Belum ada gambar referensi.</p>
                        <p class="text-xs text-gray-400 mt-1">Unggah gambar di formulir kiri untuk melihat preview live.</p>
                    </div>
                </div>
            </div>

            <!-- Pricing Card -->
            <div class="bg-white rounded-2xl p-8 border-2 border-caramel shadow-lg">
                <h3 class="text-lg font-serif text-dark-brown mb-4">💰 Estimasi Harga</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Harga Dasar</span>
                        <span class="font-semibold">Rp 125.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Customisasi</span>
                        <span class="font-semibold">+ Rp 50.000</span>
                    </div>
                    <div class="border-t border-gray-300 pt-3 flex justify-between">
                        <span class="font-semibold text-dark-brown">Total</span>
                        <span class="text-2xl font-bold text-caramel">Rp 175.000</span>
                    </div>
                </div>
                <p class="text-xs text-gray-600">*Harga final akan dikonfirmasi setelah Anda mengirim request</p>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 rounded-2xl p-6 border-l-4 border-blue-500">
                <h3 class="font-semibold text-blue-900 mb-3">ℹ️ Informasi Penting</h3>
                <ul class="text-sm text-blue-800 space-y-2">
                    <li>✓ Konsultasi gratis dengan desainer</li>
                    <li>✓ Perubahan desain tanpa biaya tambahan</li>
                    <li>✓ Garansi kualitas 100%</li>
                    <li>✓ Pengiriman ke seluruh Indonesia</li>
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('reference_image_input');
            const preview = document.getElementById('reference_image_preview');
            const placeholder = document.getElementById('preview_placeholder');

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
        });
    </script>
    @endpush

@endsection

