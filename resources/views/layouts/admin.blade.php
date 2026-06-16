<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zweta Admin</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="/css/app.css">
    @endif
</head>
<body class="min-h-screen bg-cream text-dark-brown font-sans flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-dark-brown text-cream p-8 flex flex-col justify-between shrink-0 shadow-xl">
        <div>
            <!-- Sidebar Title -->
            <h2 class="font-serif text-2xl font-bold tracking-tight text-white mb-10">
                Zweta Admin
            </h2>

            <!-- Sidebar Navigation -->
            <nav class="flex flex-col gap-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.products.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Produk
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.orders.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Pesanan
                </a>
                <a href="{{ route('admin.customrequests.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.customrequests.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Custom Request
                </a>
                <a href="{{ route('admin.production') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.production*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Produksi
                </a>
                <a href="{{ route('admin.materials.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.materials.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Stok Bahan
                </a>
                <a href="#" 
                   class="px-4 py-2.5 rounded-lg transition text-cream/75 hover:bg-caramel/15 hover:text-white">
                    Laporan
                </a>
                <a href="{{ route('admin.customers.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.customers.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
                    Customer
                </a>
            </nav>
        </div>

        <!-- Logout Button -->
        <div class="mt-8 border-t border-cream/10 pt-6">
            <form method="post" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-lg transition text-cream/75 hover:bg-red-500/20 hover:text-red-200 text-sm font-medium w-full text-left">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        @yield('content')
    </main>
</body>
</html>
