@extends('layouts.admin')

@section('content')
    <!-- Form Action Links (Top Header) -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-4xl font-serif text-dark-brown font-bold mb-2">Edit Produk</h1>
            <p class="text-sm text-gray-500">Ubah informasi produk, foto, stok, dan status produk Zweta Handmade.</p>
        </div>
        
        <!-- Action Buttons (Right - Top) -->
        <div id="top-action-buttons" class="flex items-center gap-3 transition-all duration-300">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 border border-caramel/40 text-caramel rounded-xl text-xs font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" form="edit-product-form" class="px-6 py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm">
                Simpan Produk
            </button>
        </div>
    </div>

    <!-- Back Button Link -->
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-soft-beige bg-white text-dark-brown rounded-full text-xs font-semibold hover:bg-gray-50 transition">
            ← Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Container -->
    <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_4px_20px_rgba(28,20,16,0.01)]">
        <form id="edit-product-form" action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            @csrf
            @method('PUT')

            <!-- Hidden slug input (automatically synchronized in JS) -->
            <input type="hidden" name="slug" id="slug-input" value="{{ old('slug', $product->slug) }}">

            <!-- Left Column: Photo Management -->
            <div class="lg:col-span-5 flex flex-col">
                <label class="block text-sm font-bold text-dark-brown mb-3">Foto Produk</label>
                
                <!-- Large Photo Preview Container -->
                <div id="preview-image-container" class="w-full h-80 bg-[#FAF0E6] rounded-3xl flex flex-col items-center justify-center overflow-hidden mb-4 relative border border-gray-100/50">
                    @if ($product->image)
                        <img src="{{ str_starts_with($product->image, 'uploads/') ? asset($product->image) : Storage::url($product->image) }}" class="w-full h-full object-cover">
                    @else
                        <!-- Minimalist SVG Bag Illustration -->
                        <svg class="w-20 h-20 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                            <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                            <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                        </svg>
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-4">FOTO</span>
                    @endif
                </div>

                <!-- Hidden Input and Actions -->
                <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImageFile(this)">
                <input type="hidden" name="remove_image" id="remove-image-input" value="0">

                <div class="flex gap-4 mb-3">
                    <button type="button" onclick="document.getElementById('image-input').click()" class="flex-1 py-3 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition text-center">
                        Ganti Foto
                    </button>
                    <button type="button" onclick="clearProductImage()" class="flex-1 py-3 border border-caramel/40 text-caramel bg-white rounded-xl text-xs font-semibold hover:bg-red-500/10 transition">
                        Hapus
                    </button>
                </div>
                <p class="text-[10px] text-gray-400 mb-8">Format JPG/PNG, Maksimal 5 MB.</p>

                <!-- Product Gallery -->
                <div>
                    <label class="block text-sm font-bold text-dark-brown mb-3">Galeri Produk</label>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="aspect-square bg-[#FAF0E6] rounded-xl border border-gray-100 flex items-center justify-center"></div>
                        <div class="aspect-square bg-[#FAF0E6] rounded-xl border border-gray-100 flex items-center justify-center"></div>
                        <div class="aspect-square bg-[#FAF0E6] rounded-xl border border-gray-100 flex items-center justify-center"></div>
                        <div class="aspect-square bg-white rounded-xl border border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-lg cursor-pointer hover:bg-gray-50">
                            +
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Information -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <h3 class="text-lg font-bold text-dark-brown border-b border-gray-50 pb-2">Informasi Produk</h3>

                <!-- Nama Produk -->
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Nama Produk</label>
                    <input type="text" name="name" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400" value="{{ old('name', $product->name) }}" placeholder="Tote Ferro" required>
                </div>

                <!-- Kategori & Status Produk -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel">
                            <option value="Sling Bag" {{ old('category', $product->category) == 'Sling Bag' ? 'selected' : '' }}>Sling Bag</option>
                            <option value="Backpack" {{ old('category', $product->category) == 'Backpack' ? 'selected' : '' }}>Backpack</option>
                            <option value="Totebag" {{ old('category', $product->category) == 'Totebag' ? 'selected' : '' }}>Totebag</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Status Produk</label>
                        <select name="status" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel">
                            <option value="ready" {{ old('status', $product->status) == 'ready' ? 'selected' : '' }}>Ready Stock</option>
                            <option value="pre-order" {{ old('status', $product->status) == 'pre-order' ? 'selected' : '' }}>Pre-Order</option>
                            <option value="custom" {{ old('status', $product->status) == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Harga</label>
                        <input type="number" name="price" min="0" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400" value="{{ old('price', $product->price) }}" placeholder="125000" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Stok</label>
                        <input type="number" name="stock" min="0" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400" value="{{ old('stock', $product->stock) }}" placeholder="8">
                    </div>
                </div>

                <!-- Bahan & Ukuran -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Bahan</label>
                        <input type="text" name="material" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400" value="{{ old('material', $product->material) }}" placeholder="Rajut premium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Ukuran</label>
                        <input type="text" name="size" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400" value="{{ old('size', $product->size) }}" placeholder="25 x 20 x 8 cm">
                    </div>
                </div>

                <!-- Warna Tersedia -->
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Warna Tersedia</label>
                    <input type="text" name="colors" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400 mb-3" value="{{ old('colors', $product->colors) }}" placeholder="Coklat, Beige, Pink, Sage">
                    
                    <!-- Color Indicators Row -->
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-[#8C6239] shadow-sm border border-white" title="Coklat"></span>
                        <span class="w-6 h-6 rounded-full bg-[#DDCBB4] shadow-sm border border-white" title="Beige"></span>
                        <span class="w-6 h-6 rounded-full bg-[#D4B2B6] shadow-sm border border-white" title="Pink"></span>
                        <span class="w-6 h-6 rounded-full bg-[#9EB39C] shadow-sm border border-white" title="Sage"></span>
                        <span class="text-xs text-gray-400 ml-2">Coklat, Beige, Pink, Sage</span>
                    </div>
                </div>

                <!-- Deskripsi Produk -->
                <div>
                    <label class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="5" class="w-full px-4 py-3 bg-white border border-soft-beige rounded-xl text-sm focus:outline-none focus:border-caramel placeholder-gray-400 leading-relaxed" placeholder="Tulis deskripsi produk di sini...">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Bottom Form Action Buttons (Right-aligned) -->
                <div id="bottom-action-buttons" class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-gray-50 transition-all duration-300 opacity-0 pointer-events-none">
                    <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 border border-caramel/40 text-caramel rounded-xl text-xs font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-caramel text-white rounded-xl text-xs font-semibold hover:bg-opacity-95 transition shadow-sm">
                        Simpan Produk
                    </button>
                </div>

                <p class="text-[10px] text-gray-400 italic">Perubahan data produk akan langsung tampil di katalog customer setelah disimpan.</p>
            </div>
        </form>
    </div>

    <!-- Client-Side Form Scripts -->
    <script>
        function clearProductImage() {
            document.getElementById('preview-image-container').innerHTML = `
                <svg class="w-20 h-20 text-dark-brown/20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="55" r="30" fill="#FFF8F2" />
                    <path d="M35 45 C 35 15, 65 15, 65 45" stroke="#A56A43" stroke-width="2" stroke-linecap="round" fill="none" />
                    <path d="M28 45 H 72 L 68 80 C 67 83, 64 85, 61 85 H 39 C 36 85, 33 83, 32 80 L 28 45 Z" fill="#A56A43" opacity="0.8" />
                </svg>
                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-4">FOTO</span>
            `;
            document.getElementById('remove-image-input').value = '1';
            document.getElementById('image-input').value = '';
        }

        function previewImageFile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image-container').innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                    `;
                    document.getElementById('remove-image-input').value = '0';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Auto-slugify product name into hidden slug field
        document.querySelector('input[name="name"]').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            document.getElementById('slug-input').value = slug;
        });

        // Dynamic scroll behavior to toggle save button between header (top) and form (bottom right)
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.querySelector('main');
            const topActions = document.getElementById('top-action-buttons');
            const bottomActions = document.getElementById('bottom-action-buttons');

            if (scrollContainer && topActions && bottomActions) {
                scrollContainer.addEventListener('scroll', function() {
                    // If scrolled down by more than 150px, hide top buttons and show bottom buttons
                    if (scrollContainer.scrollTop > 150) {
                        topActions.classList.add('opacity-0', 'pointer-events-none');
                        bottomActions.classList.remove('opacity-0', 'pointer-events-none');
                    } else {
                        topActions.classList.remove('opacity-0', 'pointer-events-none');
                        bottomActions.classList.add('opacity-0', 'pointer-events-none');
                    }
                });
            }
        });
    </script>
@endsection
