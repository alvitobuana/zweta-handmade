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
                <a href="{{ route('admin.reports.index') }}" 
                   class="px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.reports.*') ? 'bg-caramel text-white font-medium shadow-sm' : 'text-cream/75 hover:bg-caramel/15 hover:text-white' }}">
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
            <button type="button" onclick="document.getElementById('logout-modal').classList.remove('hidden')" class="px-4 py-2.5 rounded-lg transition text-cream/75 hover:bg-red-500/20 hover:text-red-200 text-sm font-medium w-full text-left">
                Logout
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        @yield('content')
    </main>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl border border-gray-100 flex flex-col items-center text-center">
            <h4 class="font-serif font-bold text-dark-brown text-2xl mb-2">Keluar dari Admin Panel</h4>
            <p class="text-xs text-gray-500 mb-6 font-medium">Pastikan semua data sudah tersimpan sebelum logout.</p>
            
            <!-- Icon -->
            <div class="w-20 h-20 bg-[#FFF0F0] border border-red-100 rounded-2xl flex items-center justify-center mb-8">
                <svg class="w-10 h-10 text-[#E84A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <div class="flex gap-4 w-full">
                <button type="button" onclick="document.getElementById('logout-modal').classList.add('hidden')" class="flex-1 py-3 text-sm font-bold text-dark-brown hover:bg-gray-50 rounded-xl transition">
                    Kembali
                </button>
                <form method="post" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-[#E84A4A] text-white rounded-xl text-sm font-bold hover:bg-opacity-95 transition shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
