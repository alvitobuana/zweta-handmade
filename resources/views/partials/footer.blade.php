<footer class="mt-20 bg-[--dark-brown] text-cream py-12 rounded-t-3xl">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <!-- Brand Info -->
            <div>
                <h3 class="font-serif text-xl font-bold mb-3">🎀 Zweta Handmade</h3>
                <p class="text-sm text-cream/80 mb-4">Tas handmade custom dengan sentuhan personal dan kualitas terbaik.</p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-[--caramel] rounded-full flex items-center justify-center hover:bg-opacity-80 transition">f</a>
                    <a href="#" class="w-10 h-10 bg-[--caramel] rounded-full flex items-center justify-center hover:bg-opacity-80 transition">📷</a>
                    <a href="#" class="w-10 h-10 bg-[--caramel] rounded-full flex items-center justify-center hover:bg-opacity-80 transition">𝕏</a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold mb-4">Link Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-cream/80 hover:text-cream transition">Home</a></li>
                    <li><a href="{{ route('katalog') }}" class="text-cream/80 hover:text-cream transition">Katalog</a></li>
                    <li><a href="{{ route('custom') }}" class="text-cream/80 hover:text-cream transition">Custom Order</a></li>
                    <li><a href="{{ route('tracking') }}" class="text-cream/80 hover:text-cream transition">Tracking</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div>
                <h4 class="font-semibold mb-4">Informasi</h4>
                <ul class="space-y-2 text-sm">
                    <li class="text-cream/80">📞 +62 812-xxxx-xxxx</li>
                    <li class="text-cream/80">📧 hello@zwetahandmade.com</li>
                    <li class="text-cream/80">📍 Jakarta, Indonesia</li>
                    <li class="text-cream/80">⏰ Senin-Jumat: 09:00-17:00</li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <p class="text-sm text-cream/80 mb-3">Dapatkan update promo dan koleksi terbaru</p>
                <form class="flex">
                    <input type="email" placeholder="Email Anda" class="flex-1 px-3 py-2 rounded-l-lg focus:outline-none text-sm">
                    <button type="submit" class="px-3 bg-[--caramel] rounded-r-lg hover:bg-opacity-90 transition">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-cream/30 pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center text-xs text-cream/70">
                <p>&copy; 2026 Zweta Handmade. Semua hak dilindungi.</p>
                <div class="flex gap-4 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-cream transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-cream transition">Syarat Layanan</a>
                    <a href="#" class="hover:text-cream transition">Kontak</a>
                </div>
            </div>
        </div>
    </div>
</footer>
