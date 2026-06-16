<footer id="footer" class="mt-20 bg-dark-brown text-cream py-16 rounded-t-[2.5rem]">
    <div class="container mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-start gap-12">
            <!-- Brand Column -->
            <div class="max-w-md">
                <h3 class="font-serif text-2xl font-semibold tracking-wide text-white">Zweta Handmade</h3>
                <p class="text-sm text-cream/70 mt-4 leading-relaxed">
                    Tas handmade custom dengan sentuhan personal. Dibuat untuk membantu customer dan memudahkan manajemen produksi.
                </p>
            </div>

            <!-- Menu Column -->
            <div class="flex flex-col">
                <h4 class="font-semibold text-white tracking-wider uppercase text-xs mb-4">Menu</h4>
                <div class="flex flex-wrap items-center gap-2 text-sm text-cream/70">
                    <a href="{{ route('katalog') }}" class="hover:text-white transition">Katalog</a>
                    <span class="text-cream/30">•</span>
                    <a href="{{ route('custom') }}" class="hover:text-white transition">Custom</a>
                    <span class="text-cream/30">•</span>
                    <a href="{{ route('tracking') }}" class="hover:text-white transition">Tracking</a>
                    <span class="text-cream/30">•</span>
                    <a href="{{ route('kontak') }}" class="hover:text-white transition">Kontak</a>
                </div>
            </div>
        </div>

        <!-- Divider & Bottom Info -->
        <div class="border-t border-cream/10 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-cream/50">
            <p>&copy; 2026 Zweta Handmade. Semua hak dilindungi.</p>
            <div class="flex gap-6 mt-4 sm:mt-0">
                <span class="flex items-center gap-1">📍 Jakarta, Indonesia</span>
                <span class="flex items-center gap-1">📧 hello@zwetahandmade.com</span>
            </div>
        </div>
    </div>
</footer>
