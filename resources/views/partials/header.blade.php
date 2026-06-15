<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-serif text-2xl font-bold text-[--dark-brown] hover:text-[--caramel] transition">
            🎀 Zweta Handmade
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex gap-8 text-sm font-medium text-[--dark-brown]">
            <a href="{{ route('home') }}" class="hover:text-[--caramel] transition">Home</a>
            <a href="{{ route('katalog') }}" class="hover:text-[--caramel] transition">Katalog</a>
            <a href="{{ route('custom') }}" class="hover:text-[--caramel] transition">Custom Order</a>
            <a href="{{ route('tracking') }}" class="hover:text-[--caramel] transition">Tracking</a>
            <a href="#" class="hover:text-[--caramel] transition">Kontak</a>
        </nav>

        <!-- Right Section -->
        <div class="flex items-center gap-4">
            <form action="#" class="hidden sm:block">
                <input type="search" placeholder="Cari produk..." class="rounded-full border-2 border-[--soft-beige] px-4 py-2 bg-white text-sm focus:outline-none focus:border-[--caramel] transition" />
            </form>

            @auth
                <div class="flex items-center gap-2 pl-4 border-l-2 border-[--soft-beige]">
                    <a href="{{ url('/admin') }}" class="px-4 py-2 bg-[--caramel] text-white rounded-full text-sm font-semibold hover:bg-opacity-90 transition">Admin</a>
                    <form action="{{ route('logout') }}" method="post" class="inline-block">
                        @csrf
                        <button type="submit" class="px-4 py-2 border-2 border-[--caramel] text-[--caramel] rounded-full text-sm font-semibold hover:bg-[--caramel] hover:text-white transition">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 bg-[--caramel] text-white rounded-full font-semibold hover:bg-opacity-90 transition">Login</a>
            @endauth
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="lg:hidden border-t border-[--soft-beige] px-6 py-4 space-y-2">
        <a href="{{ route('home') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Home</a>
        <a href="{{ route('katalog') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Katalog</a>
        <a href="{{ route('custom') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Custom Order</a>
        <a href="{{ route('tracking') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Tracking</a>
    </div>
</header>
