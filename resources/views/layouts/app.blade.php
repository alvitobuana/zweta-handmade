<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zweta Handmade - Tas handmade custom berkualitas tinggi">
    <title>{{ isset($title) ? $title . ' | Zweta Handmade' : 'Zweta Handmade - Tas Handmade Custom' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="/css/app.css">
    @endif
</head>
<body class="bg-cream text-[--dark-brown] min-h-screen font-sans flex flex-col">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="flex-1">
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
