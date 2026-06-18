@extends('layouts.app')

@section('title', 'Profil Saya - Zweta Handmade')

@section('content')

@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm flex items-center gap-2">
        <span>✅</span> {{ session('success') }}
    </div>
@endif

<!-- Page Title -->
<div class="mb-8">
    <h1 class="text-4xl font-serif font-bold text-dark-brown">Profil Saya</h1>
    <p class="text-gray-500 mt-1">Kelola data akun dan pantau riwayat pesanan Zweta Handmade.</p>
</div>

<div class="grid lg:grid-cols-2 gap-8 mb-8">

    <!-- LEFT: User Info Card -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-soft-beige/40">
        <!-- Avatar & Name -->
        <div class="flex items-center gap-4 mb-8">
            <div class="w-16 h-16 rounded-full bg-caramel flex items-center justify-center text-white text-2xl font-bold shadow-md">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-xl font-serif font-bold text-dark-brown">{{ $user->name }}</p>
                <p class="text-sm text-gray-400 mt-0.5">{{ $user->is_admin ? 'Admin' : 'Customer' }}</p>
            </div>
        </div>

        <!-- Info Fields (Read-Only Display) -->
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Email</label>
                <div class="w-full px-4 py-3 bg-cream border border-soft-beige rounded-xl text-sm text-dark-brown">
                    {{ $user->email }}
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Nomor WhatsApp</label>
                <div class="w-full px-4 py-3 bg-cream border border-soft-beige rounded-xl text-sm text-dark-brown">
                    {{ $user->whatsapp ?? '—' }}
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Alamat</label>
                <div class="w-full px-4 py-3 bg-cream border border-soft-beige rounded-xl text-sm text-dark-brown min-h-[48px]">
                    {{ $user->address ?? '—' }}
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Latest Order Status -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-soft-beige/40">
        <p class="text-lg font-serif font-bold text-dark-brown mb-5">Status Pesanan Terbaru</p>

        @if($latestActivity)
            <p class="text-caramel font-bold text-sm mb-1">{{ $latestActivity->code }}</p>
            <p class="font-bold text-dark-brown text-base mb-1">{{ $latestActivity->product }}</p>
            <p class="text-xs text-gray-400 mb-4">Dipesan: {{ $latestActivity->created_at?->format('d M Y') }}</p>

            @if(isset($latestActivity->is_custom_request))
                <!-- Custom Request Status Layout -->
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-300 mb-6">
                    Menunggu Konfirmasi Admin
                </span>

                <!-- Timeline Progress for Custom Request -->
                <div class="flex items-center gap-0">
                    @php
                        $timelineSteps = [
                            ['label' => 'Dikirim'],
                            ['label' => 'Review'],
                            ['label' => 'Bayar'],
                            ['label' => 'Produksi'],
                        ];
                        // Since it's waiting for admin, the active step is step 2 (Review), index 1
                        $orderIdx = 1;
                    @endphp
                    @foreach($timelineSteps as $i => $step)
                        <div class="flex flex-col items-center {{ $i < count($timelineSteps) - 1 ? 'flex-1' : '' }}">
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-bold transition
                                {{ $i <= $orderIdx ? ($i == $orderIdx ? 'bg-amber-500 border-amber-500 text-white animate-pulse' : 'bg-caramel border-caramel text-white') : 'bg-white border-gray-200 text-gray-400' }}">
                                @if($i < $orderIdx)
                                    ✓
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </div>
                            <span class="text-[10px] text-gray-500 mt-1.5 text-center">{{ $step['label'] }}</span>
                        </div>
                        @if($i < count($timelineSteps) - 1)
                            <div class="flex-1 h-0.5 {{ $i < $orderIdx ? 'bg-caramel' : 'bg-gray-200' }} mb-4 -mt-4"></div>
                        @endif
                    @endforeach
                </div>
            @else
                <!-- Regular Order Status Layout -->
                <!-- Status Badge -->
                @php
                    $statusMap = [
                        'pending'              => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-yellow-100 text-yellow-700 border border-yellow-300'],
                        'menunggu_verifikasi'  => ['label' => 'Verifikasi Pembayaran', 'color' => 'bg-amber-100 text-amber-700 border border-amber-300'],
                        'produksi'             => ['label' => 'Produksi', 'color' => 'bg-blue-100 text-blue-700 border border-blue-300'],
                        'finishing'            => ['label' => 'Finishing', 'color' => 'bg-purple-100 text-purple-700 border border-purple-300'],
                        'siap_dikirim'         => ['label' => 'Siap Dikirim', 'color' => 'bg-indigo-100 text-indigo-700 border border-indigo-300'],
                        'selesai'              => ['label' => 'Selesai', 'color' => 'bg-green-100 text-green-700 border border-green-300'],
                    ];
                    $s = $statusMap[$latestActivity->status] ?? ['label' => ucfirst($latestActivity->status), 'color' => 'bg-gray-100 text-gray-700'];
                    $steps = ['pending', 'menunggu_verifikasi', 'produksi', 'finishing', 'selesai'];
                    $currentIdx = array_search($latestActivity->status, $steps);
                    if ($latestActivity->status === 'siap_dikirim') $currentIdx = 3; // treat as after finishing
                @endphp
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold {{ $s['color'] }} mb-6">
                    {{ $s['label'] }}
                </span>

                <!-- Timeline Progress -->
                <div class="flex items-center gap-0">
                    @php
                        $timelineSteps = [
                            ['key' => 'pending',             'label' => 'Diterima'],
                            ['key' => 'menunggu_verifikasi', 'label' => 'Bayar'],
                            ['key' => 'produksi',            'label' => 'Produksi'],
                            ['key' => 'finishing',           'label' => 'Finishing'],
                            ['key' => 'selesai',             'label' => 'Selesai'],
                        ];
                        $orderIdx = array_search($latestActivity->status, array_column($timelineSteps, 'key'));
                        if ($latestActivity->status === 'siap_dikirim') $orderIdx = 3;
                        if ($latestActivity->status === 'selesai') $orderIdx = 4;
                    @endphp
                    @foreach($timelineSteps as $i => $step)
                        <div class="flex flex-col items-center {{ $i < count($timelineSteps) - 1 ? 'flex-1' : '' }}">
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-bold transition
                                {{ $i <= $orderIdx ? 'bg-caramel border-caramel text-white' : 'bg-white border-gray-200 text-gray-400' }}">
                                @if($i < $orderIdx)
                                    ✓
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </div>
                            <span class="text-[10px] text-gray-500 mt-1.5 text-center">{{ $step['label'] }}</span>
                        </div>
                        @if($i < count($timelineSteps) - 1)
                            <div class="flex-1 h-0.5 {{ $i < $orderIdx ? 'bg-caramel' : 'bg-gray-200' }} mb-4 -mt-4"></div>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="mt-6 pt-5 border-t border-soft-beige/50">
                <a href="{{ route('tracking', ['code' => $latestActivity->code]) }}"
                   class="text-caramel hover:underline font-semibold text-sm">
                    Lihat detail pesanan →
                </a>
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-48 text-center">
                <div class="text-5xl mb-4">📦</div>
                <p class="text-gray-400 font-medium">Belum ada pesanan.</p>
                <a href="{{ route('katalog') }}" class="mt-4 px-5 py-2 bg-caramel text-white text-sm font-semibold rounded-xl hover:bg-opacity-90 transition">
                    Belanja Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Action Buttons -->
<div class="flex gap-4">
    <a href="{{ route('profile.edit') }}"
       class="px-8 py-3 bg-caramel text-white font-semibold rounded-xl hover:bg-opacity-90 transition shadow-md">
        ✏️ Edit Profil
    </a>

    <!-- Logout trigger -->
    <button onclick="document.getElementById('logoutModal').classList.remove('hidden')"
            class="px-8 py-3 border-2 border-caramel text-caramel font-semibold rounded-xl hover:bg-caramel hover:text-white transition">
        Logout
    </button>
</div>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 p-8 text-center">
        <div class="text-5xl mb-4">⚠️</div>
        <h2 class="text-xl font-serif font-bold text-dark-brown mb-2">Konfirmasi Logout</h2>
        <p class="text-gray-500 text-sm mb-8">Apakah kamu yakin ingin keluar dari akun Zweta Handmade?</p>
        <div class="flex gap-3">
            <button onclick="document.getElementById('logoutModal').classList.add('hidden')"
                    class="flex-1 py-3 border-2 border-soft-beige text-dark-brown font-semibold rounded-xl hover:bg-soft-beige transition">
                Kembali
            </button>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 transition shadow-md">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

@endsection