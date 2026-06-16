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
        </nav>

        <!-- Right Section -->
        <div class="flex items-center gap-3">
            @auth
                <div class="flex items-center gap-2 pl-4 border-l-2 border-[--soft-beige]">
                    @if (auth()->user()->isAdmin())
                        {{-- Admin: tampilkan tombol Admin Panel --}}
                        <a href="{{ url('/admin') }}"
                           class="px-4 py-2 bg-[--dark-brown] text-white rounded-full text-sm font-semibold hover:bg-opacity-90 transition">
                            ⚙️ Admin
                        </a>
                    @else
                        {{-- User biasa: tampilkan nama --}}
                        <span class="text-sm font-medium text-[--dark-brown]">
                            👤 {{ auth()->user()->name }}
                        </span>
                    @endif
                    <form action="{{ route('logout') }}" method="post" class="inline-block">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 border-2 border-[--caramel] text-[--caramel] rounded-full text-sm font-semibold hover:bg-[--caramel] hover:text-white transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                {{-- Tamu: tampilkan Login & Register --}}
                <a href="{{ route('login') }}"
                   class="px-5 py-2 border-2 border-[--caramel] text-[--caramel] rounded-full text-sm font-semibold hover:bg-[--caramel] hover:text-white transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2 bg-[--caramel] text-white rounded-full text-sm font-semibold hover:bg-opacity-90 transition">
                    Daftar
                </a>
            @endauth
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="lg:hidden border-t border-[--soft-beige] px-6 py-4 space-y-2">
        <a href="{{ route('home') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Home</a>
        <a href="{{ route('katalog') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Katalog</a>
        <a href="{{ route('custom') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Custom Order</a>
        <a href="{{ route('tracking') }}" class="block py-2 text-sm text-[--dark-brown] hover:text-[--caramel]">Tracking</a>
        @guest
            <div class="flex gap-3 pt-2 border-t border-[--soft-beige]">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2 border-2 border-[--caramel] text-[--caramel] rounded-full text-sm font-semibold">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2 bg-[--caramel] text-white rounded-full text-sm font-semibold">Daftar</a>
            </div>
        @endguest
        @auth
            <form action="{{ route('logout') }}" method="post" class="pt-2 border-t border-[--soft-beige]">
                @csrf
                <button type="submit" class="w-full py-2 border-2 border-[--caramel] text-[--caramel] rounded-full text-sm font-semibold">Logout</button>
            </form>
        @endauth
    </div>
</header>
