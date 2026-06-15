<!doctype html>
<html lang="en">
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
<body class="min-h-screen bg-cream text-dark-brown font-sans">
    <div class="flex">
        <aside class="w-56 bg-dark-brown text-cream min-h-screen p-6">
            <h2 class="font-serif text-xl mb-8">Zweta Admin</h2>
            <nav class="flex flex-col gap-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-caramel/20">📊 Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="px-3 py-2 rounded hover:bg-caramel/20">📦 Produk</a>
                <a href="{{ route('admin.orders.index') }}" class="px-3 py-2 rounded hover:bg-caramel/20">📋 Pesanan</a>
                <a href="{{ route('admin.customrequests.index') }}" class="px-3 py-2 rounded hover:bg-caramel/20">✨ Custom Request</a>
                <a href="{{ route('admin.materials.index') }}" class="px-3 py-2 rounded hover:bg-caramel/20">📦 Stok Bahan</a>
                <a href="{{ route('admin.customers.index') }}" class="px-3 py-2 rounded hover:bg-caramel/20">👥 Data Customer</a>
                <a href="{{ route('admin.production') }}" class="px-3 py-2 rounded hover:bg-caramel/20">⚙️ Production Queue</a>
            </nav>
            <hr class="my-6 border-caramel/30">
            <form method="post" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="px-3 py-2 rounded hover:bg-red-500/20 text-sm w-full text-left">🚪 Logout</button>
            </form>
        </aside>
        <main class="flex-1 p-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
