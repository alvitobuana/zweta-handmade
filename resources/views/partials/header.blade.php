<header class="bg-cream border-b border-soft-beige/40 sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-serif text-2xl font-semibold text-dark-brown hover:text-caramel transition tracking-tight">
            Zweta Handmade
        </a>

        <!-- Desktop Navigation (Centered) -->
        <nav class="hidden lg:flex gap-8 text-sm font-medium text-dark-brown">
            <a href="{{ route('home') }}" class="hover:text-caramel transition">Home</a>
            <a href="{{ route('katalog') }}" class="hover:text-caramel transition">Katalog</a>
            <a href="{{ route('custom') }}" class="hover:text-caramel transition">Custom</a>
            <a href="{{ route('tracking') }}" class="hover:text-caramel transition">Tracking</a>
            <a href="#footer" class="hover:text-caramel transition">Kontak</a>
        </nav>

        <!-- Right Section -->
        <div class="flex items-center gap-3">
            <!-- Search bar -->
            <form action="{{ route('katalog') }}" method="GET" class="relative hidden sm:block">
                <input type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="Search product..." class="w-48 lg:w-56 px-4 py-1.5 text-xs bg-white border border-soft-beige rounded-full focus:outline-none focus:border-caramel placeholder-gray-400">
            </form>

            @guest
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="px-5 py-1.5 border border-dark-brown/30 text-dark-brown rounded-full text-xs font-semibold hover:bg-dark-brown hover:text-white transition">
                    Login
                </a>
                <!-- Profile Icon (Guest) -->
                <a href="{{ route('login') }}" class="w-8 h-8 rounded-full bg-caramel text-white flex items-center justify-center hover:bg-opacity-95 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @else
                <!-- Admin Panel Button if admin -->
                @if (auth()->user()->isAdmin())
                    <a href="{{ url('/admin') }}"
                       class="px-4 py-1.5 bg-dark-brown text-white rounded-full text-xs font-semibold hover:bg-opacity-90 transition">
                        ⚙️ Admin
                    </a>
                @else
                    <span class="text-xs font-medium text-dark-brown hidden md:inline">
                        👤 {{ auth()->user()->name }}
                    </span>
                @endif

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="post" class="inline-block">
                    @csrf
                    <button type="submit"
                            class="px-4 py-1.5 border border-caramel/40 text-caramel rounded-full text-xs font-semibold hover:bg-caramel hover:text-white transition">
                        Logout
                    </button>
                </form>

                <!-- Profile Initials -->
                <div class="w-8 h-8 rounded-full bg-caramel text-white flex items-center justify-center font-bold text-xs" title="{{ auth()->user()->name }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endguest

            <!-- Mobile Toggle Menu Button -->
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="lg:hidden p-2 text-dark-brown hover:text-caramel">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-soft-beige/40 px-6 py-4 space-y-2 bg-cream">
        <a href="{{ route('home') }}" class="block py-2 text-sm text-dark-brown hover:text-caramel">Home</a>
        <a href="{{ route('katalog') }}" class="block py-2 text-sm text-dark-brown hover:text-caramel">Katalog</a>
        <a href="{{ route('custom') }}" class="block py-2 text-sm text-dark-brown hover:text-caramel">Custom</a>
        <a href="{{ route('tracking') }}" class="block py-2 text-sm text-dark-brown hover:text-caramel">Tracking</a>
        <a href="#footer" onclick="document.getElementById('mobile-menu').classList.add('hidden')" class="block py-2 text-sm text-dark-brown hover:text-caramel">Kontak</a>
        
        <!-- Mobile Search -->
        <form action="{{ route('katalog') }}" method="GET" class="pt-2 relative">
            <input type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="Search product..." class="w-full px-4 py-2 text-xs bg-white border border-soft-beige rounded-full focus:outline-none focus:border-caramel placeholder-gray-400">
        </form>
    </div>
</header>
