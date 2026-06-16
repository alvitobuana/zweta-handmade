@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center py-12 lg:py-20 mb-16">
        <!-- Text Content -->
        <div class="lg:col-span-7 flex flex-col items-start">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#FAF0E6] text-caramel rounded-full text-xs font-semibold uppercase tracking-wider mb-6">
                ✨ Handmade Since 2024
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-dark-brown font-bold leading-tight mb-6">
                Tas Handmade Custom dengan Sentuhan Personal
            </h1>
            <p class="text-sm sm:text-base text-gray-500 leading-relaxed mb-8 max-w-xl">
                Setiap tas dibuat dengan penuh ketelitian, detail, dan karakter yang bisa disesuaikan dengan kebutuhan pelanggan.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('katalog') }}" class="px-8 py-3.5 bg-caramel text-white rounded-full font-semibold hover:bg-opacity-95 transition shadow-sm text-sm">
                    Lihat Koleksi
                </a>
                <a href="{{ route('custom') }}" class="px-8 py-3.5 border border-soft-beige bg-white text-dark-brown rounded-full font-semibold hover:bg-gray-50 transition text-sm">
                    Buat Custom
                </a>
            </div>
        </div>

        <!-- Illustration & Floating Cards -->
        <div class="lg:col-span-5 relative flex justify-center py-6">
            <div class="relative w-full max-w-[320px] h-[320px] flex items-center justify-center">
                <!-- SVG illustration of the bag -->
                <svg class="w-full h-full max-w-[260px] h-auto mx-auto drop-shadow-md" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background circle -->
                    <circle cx="100" cy="110" r="75" fill="#FAF0E6" />
                    <!-- Handles -->
                    <path d="M65 85 C 65 25, 135 25, 135 85" stroke="#4B2B20" stroke-width="3.5" stroke-linecap="round" fill="none" />
                    <!-- Bag body -->
                    <path d="M50 85 H 150 L 142 165 C 141 170, 137 174, 132 174 H 68 C 63 174, 59 170, 58 165 L 50 85 Z" fill="#A56A43" />
                </svg>

                <!-- Floating Card 1 (Top Right) -->
                <div class="absolute -top-2 -right-10 bg-white rounded-2xl shadow-[0_8px_30px_rgb(28,20,16,0.06)] border border-gray-100/50 px-4 py-3 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 text-sm">
                        ⭐
                    </div>
                    <div>
                        <p class="text-xs font-bold text-dark-brown leading-tight">50+ Pesanan</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Pesanan selesai</p>
                    </div>
                </div>

                <!-- Floating Card 2 (Middle Left) -->
                <div class="absolute top-1/2 -left-12 -translate-y-1/2 bg-white rounded-2xl shadow-[0_8px_30px_rgb(28,20,16,0.06)] border border-gray-100/50 px-4 py-3 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-sm">
                        👜
                    </div>
                    <div>
                        <p class="text-xs font-bold text-dark-brown leading-tight">Production Tracking</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Pantau progres</p>
                    </div>
                </div>

                <!-- Floating Card 3 (Bottom Right) -->
                <div class="absolute -bottom-2 -right-8 bg-white rounded-2xl shadow-[0_8px_30px_rgb(28,20,16,0.06)] border border-gray-100/50 px-4 py-3 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 text-sm">
                        🎨
                    </div>
                    <div>
                        <p class="text-xs font-bold text-dark-brown leading-tight">Custom Available</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Warna dan nama</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Performance Section -->
    <section class="mb-20">
        <h2 class="text-2xl sm:text-3xl font-serif text-dark-brown font-bold mb-8">
            Brand Performance
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Total Produk</p>
                <p class="text-3xl font-bold text-dark-brown">20+</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Pesanan Selesai</p>
                <p class="text-3xl font-bold text-dark-brown">50+</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Customer</p>
                <p class="text-3xl font-bold text-dark-brown">40+</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Custom Order</p>
                <p class="text-3xl font-bold text-dark-brown">18+</p>
            </div>
        </div>
    </section>

    <!-- Why Choose Zweta Section -->
    <section class="mb-20">
        <h2 class="text-2xl sm:text-3xl font-serif text-dark-brown font-bold mb-8">
            Why Choose Zweta?
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Left Promo Card -->
            <div class="lg:col-span-5 bg-[#FAF0E6] rounded-3xl p-8 flex flex-col items-center justify-center relative min-h-[300px] border border-gray-100/50 shadow-[0_4px_20px_rgba(28,20,16,0.01)]">
                <svg class="w-full max-w-[200px] h-auto drop-shadow-sm" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="110" r="65" fill="#FFF8F2" />
                    <path d="M70 90 C 70 40, 130 40, 130 90" stroke="#4B2B20" stroke-width="3" stroke-linecap="round" fill="none" />
                    <path d="M55 90 H 145 L 138 160 C 137 164, 134 167, 130 167 H 70 C 66 167, 63 164, 62 160 L 55 90 Z" fill="#A56A43" />
                </svg>
                <p class="text-xs font-semibold text-dark-brown tracking-wider uppercase mt-6">
                    Proses Handmade
                </p>
            </div>

            <!-- Right 2x2 Grid -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-center shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                    <div class="flex items-center gap-3.5 mb-3">
                        <span class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-sm">👜</span>
                        <h4 class="font-bold text-dark-brown text-base">Handmade</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                        Dibuat manual dengan perhatian pada detail.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-center shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                    <div class="flex items-center gap-3.5 mb-3">
                        <span class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-sm">🎨</span>
                        <h4 class="font-bold text-dark-brown text-base">Custom Design</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                        Pelanggan bisa memilih warna, ukuran, dan nama.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-center shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                    <div class="flex items-center gap-3.5 mb-3">
                        <span class="w-8 h-8 rounded-full bg-yellow-50 flex items-center justify-center text-sm">⭐</span>
                        <h4 class="font-bold text-dark-brown text-base">Quality Material</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                        Bahan dipilih sesuai kebutuhan produk.
                    </p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-center shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                    <div class="flex items-center gap-3.5 mb-3">
                        <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-sm">📦</span>
                        <h4 class="font-bold text-dark-brown text-base">Production Tracking</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                        Status pesanan bisa dipantau dari awal sampai selesai.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Pemesanan Section -->
    <section class="mb-20">
        <h2 class="text-2xl sm:text-3xl font-serif text-dark-brown font-bold mb-12">
            Cara Pemesanan
        </h2>
        <div class="relative flex flex-col md:flex-row justify-between items-center gap-8 md:gap-4 px-4 py-4">
            <!-- Dashed Connection Line -->
            <div class="absolute top-[32%] left-[10%] right-[10%] h-0.5 border-t border-dashed border-soft-beige z-0 hidden md:block"></div>

            <!-- Step 1 -->
            <div class="relative z-10 flex flex-col items-center text-center max-w-[120px]">
                <div class="w-14 h-14 rounded-full border border-caramel bg-white flex items-center justify-center text-lg font-bold text-dark-brown mb-4 shadow-[0_4px_12px_rgba(28,20,16,0.04)]">
                    1
                </div>
                <p class="text-sm font-semibold text-dark-brown">Pilih Produk</p>
            </div>

            <!-- Step 2 -->
            <div class="relative z-10 flex flex-col items-center text-center max-w-[120px]">
                <div class="w-14 h-14 rounded-full border border-caramel bg-white flex items-center justify-center text-lg font-bold text-dark-brown mb-4 shadow-[0_4px_12px_rgba(28,20,16,0.04)]">
                    2
                </div>
                <p class="text-sm font-semibold text-dark-brown">Isi Custom</p>
            </div>

            <!-- Step 3 -->
            <div class="relative z-10 flex flex-col items-center text-center max-w-[120px]">
                <div class="w-14 h-14 rounded-full border border-caramel bg-white flex items-center justify-center text-lg font-bold text-dark-brown mb-4 shadow-[0_4px_12px_rgba(28,20,16,0.04)]">
                    3
                </div>
                <p class="text-sm font-semibold text-dark-brown">Pembayaran</p>
            </div>

            <!-- Step 4 -->
            <div class="relative z-10 flex flex-col items-center text-center max-w-[120px]">
                <div class="w-14 h-14 rounded-full border border-caramel bg-white flex items-center justify-center text-lg font-bold text-dark-brown mb-4 shadow-[0_4px_12px_rgba(28,20,16,0.04)]">
                    4
                </div>
                <p class="text-sm font-semibold text-dark-brown">Produksi</p>
            </div>

            <!-- Step 5 -->
            <div class="relative z-10 flex flex-col items-center text-center max-w-[120px]">
                <div class="w-14 h-14 rounded-full border border-caramel bg-white flex items-center justify-center text-lg font-bold text-dark-brown mb-4 shadow-[0_4px_12px_rgba(28,20,16,0.04)]">
                    5
                </div>
                <p class="text-sm font-semibold text-dark-brown">Selesai</p>
            </div>
        </div>
    </section>

    <!-- Testimoni Customer Section -->
    <section class="mb-20">
        <h2 class="text-2xl sm:text-3xl font-serif text-dark-brown font-bold mb-8">
            Testimoni Customer
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <div class="flex items-center gap-1.5 mb-4 text-caramel text-sm">
                    <span class="text-base text-yellow-500">★</span>
                    <span class="font-bold text-dark-brown">Aulia</span>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed italic">
                    "Tasnya rapi, warnanya sesuai request, dan prosesnya bisa dipantau. Cocok untuk hadiah handmade."
                </p>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <div class="flex items-center gap-1.5 mb-4 text-caramel text-sm">
                    <span class="text-base text-yellow-500">★</span>
                    <span class="font-bold text-dark-brown">Nadya</span>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed italic">
                    "Tasnya rapi, warnanya sesuai request, dan prosesnya bisa dipantau. Cocok untuk hadiah handmade."
                </p>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col shadow-[0_4px_20px_rgba(28,20,16,0.02)]">
                <div class="flex items-center gap-1.5 mb-4 text-caramel text-sm">
                    <span class="text-base text-yellow-500">★</span>
                    <span class="font-bold text-dark-brown">Rani</span>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed italic">
                    "Tasnya rapi, warnanya sesuai request, dan prosesnya bisa dipantau. Cocok untuk hadiah handmade."
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="mb-20">
        <h2 class="text-2xl sm:text-3xl font-serif text-dark-brown font-bold mb-8">
            FAQ
        </h2>
        <div class="max-w-3xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(28,20,16,0.01)] overflow-hidden transition-all duration-300">
                <button class="w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base text-dark-brown">Apakah bisa custom warna?</span>
                    <span class="faq-icon text-xl text-caramel font-bold transition-transform duration-200">+</span>
                </button>
                <div class="faq-content hidden px-6 pb-6 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-gray-50/50 pt-4">
                    Ya, Anda bisa menentukan warna tas custom Anda sesuai katalog benang/bahan yang tersedia di halaman Custom.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(28,20,16,0.01)] overflow-hidden transition-all duration-300">
                <button class="w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base text-dark-brown">Berapa lama proses pengerjaan?</span>
                    <span class="faq-icon text-xl text-caramel font-bold transition-transform duration-200">+</span>
                </button>
                <div class="faq-content hidden px-6 pb-6 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-gray-50/50 pt-4">
                    Proses pengerjaan biasanya berkisar antara 3-7 hari kerja tergantung dari tingkat kesulitan desain yang Anda pilih.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(28,20,16,0.01)] overflow-hidden transition-all duration-300">
                <button class="w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base text-dark-brown">Apakah bisa pesan lewat WhatsApp?</span>
                    <span class="faq-icon text-xl text-caramel font-bold transition-transform duration-200">+</span>
                </button>
                <div class="faq-content hidden px-6 pb-6 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-gray-50/50 pt-4">
                    Bisa, Anda juga bisa langsung memesan atau bertanya via WhatsApp yang tertera di kontak kami.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(28,20,16,0.01)] overflow-hidden transition-all duration-300">
                <button class="w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base text-dark-brown">Bagaimana cara tracking pesanan?</span>
                    <span class="faq-icon text-xl text-caramel font-bold transition-transform duration-200">+</span>
                </button>
                <div class="faq-content hidden px-6 pb-6 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-gray-50/50 pt-4">
                    Anda dapat memantau status pembuatan tas secara real-time melalui halaman Tracking dengan memasukkan nomor pesanan Anda.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(28,20,16,0.01)] overflow-hidden transition-all duration-300">
                <button class="w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base text-dark-brown">Apakah tersedia pembayaran QRIS?</span>
                    <span class="faq-icon text-xl text-caramel font-bold transition-transform duration-200">+</span>
                </button>
                <div class="faq-content hidden px-6 pb-6 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-gray-50/50 pt-4">
                    Ya, kami menyediakan pembayaran digital menggunakan QRIS dan berbagai pilihan transfer bank untuk memudahkan transaksi Anda.
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function toggleFaq(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('.faq-icon');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '−';
        } else {
            content.classList.add('hidden');
            icon.textContent = '+';
        }
    }
</script>
@endpush
