@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-[34px] font-serif font-bold text-[#4B2B20]">Production Queue</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm shadow-sm flex items-center gap-2">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Kanban Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 items-start">
        @php
            $columns = [
                [
                    'title' => 'Menunggu',
                    'orders' => $waiting,
                    'emptyText' => 'Belum ada antrean',
                ],
                [
                    'title' => 'Sedang Dibuat',
                    'orders' => $inProgress,
                    'emptyText' => 'Tidak ada pengerjaan',
                ],
                [
                    'title' => 'Finishing',
                    'orders' => $finishing,
                    'emptyText' => 'Tidak ada finishing',
                ],
                [
                    'title' => 'Siap Dikirim',
                    'orders' => $ready,
                    'emptyText' => 'Tidak ada siap kirim',
                ],
                [
                    'title' => 'Selesai',
                    'orders' => $completed,
                    'emptyText' => 'Belum ada yang selesai',
                ],
            ];
        @endphp

        @foreach ($columns as $col)
            <!-- Column -->
            <div class="bg-[#FAF5EF] rounded-[24px] p-5 min-h-[650px] border border-[#F5ECE2] flex flex-col">
                <!-- Column Header -->
                <div class="flex justify-between items-center mb-5 shrink-0">
                    <h2 class="font-bold text-base text-[#4B2B20]">{{ $col['title'] }}</h2>
                    <span class="text-xs font-semibold bg-[#EAD8C9]/40 text-[#A56A43] px-2.5 py-1 rounded-full">
                        {{ count($col['orders']) }}
                    </span>
                </div>

                <!-- Column Cards Container -->
                <div class="flex-1 flex flex-col gap-4 overflow-y-auto max-h-[550px] pr-1">
                    @forelse ($col['orders'] as $order)
                        @php
                            $deadlineDate = $order->created_at ? $order->created_at->addDays(5) : now()->addDays(5);
                            $daysLeft = now()->diffInDays($deadlineDate, false);
                            $isUrgent = $daysLeft <= 2;
                        @endphp
                        <!-- Card -->
                        <div class="bg-white rounded-[20px] p-5 shadow-[0_4px_20px_rgba(75,43,32,0.03)] border border-[#FAF6F0] hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(75,43,32,0.07)] transition duration-300 flex flex-col gap-3 group">
                            <!-- Card Header -->
                            <div class="flex justify-between items-start gap-2">
                                <span class="font-bold text-[15px] text-[#4B2B20] tracking-wide">{{ $order->code }}</span>
                                
                                <!-- Status Updater Dropdown -->
                                <form method="post" action="{{ route('admin.orders.updateStatus', $order) }}" class="relative select-status-form shrink-0">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="text-[10px] bg-[#FAF2EA]/70 text-[#A56A43] font-bold rounded-full py-1 pl-2.5 pr-6 border border-transparent hover:border-[#A56A43]/30 focus:outline-none cursor-pointer appearance-none transition">
                                        <option value="pending" @selected($order->status == 'pending')>Menunggu</option>
                                        <option value="produksi" @selected($order->status == 'produksi')>Sedang Dibuat</option>
                                        <option value="finishing" @selected($order->status == 'finishing')>Finishing</option>
                                        <option value="siap_dikirim" @selected($order->status == 'siap_dikirim')>Siap Dikirim</option>
                                        <option value="selesai" @selected($order->status == 'selesai')>Selesai</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-[#A56A43]">
                                        <svg class="h-2.5 w-2.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                        </svg>
                                    </div>
                                </form>
                            </div>

                            <!-- Card Body -->
                            <div class="flex flex-col gap-1 text-[13px] text-gray-500 font-medium">
                                <p><span class="text-gray-400">Customer:</span> <span class="text-gray-700">{{ $order->customer_name }}</span></p>
                                <p class="text-gray-700 font-semibold">{{ $order->product }}</p>
                                <p><span class="text-gray-400">Deadline:</span> <span class="text-[#A56A43] font-semibold">{{ $deadlineDate->translatedFormat('j M') }}</span></p>
                            </div>

                            <!-- Card Footer -->
                            <div class="pt-1 flex items-center justify-between">
                                @if($isUrgent)
                                    <span class="inline-block text-xs bg-[#D79A4F] text-white font-bold py-1.5 px-4 rounded-full shadow-sm">
                                        Urgent
                                    </span>
                                @else
                                    <span class="inline-block text-xs bg-[#FAF2EA] text-[#A56A43] font-bold py-1.5 px-4 rounded-full">
                                        Normal
                                    </span>
                                @endif

                                <!-- View Details Link -->
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-xs font-bold text-[#A56A43] hover:underline opacity-0 group-hover:opacity-100 transition duration-200">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="border-2 border-dashed border-[#EAD8C9]/40 rounded-[20px] p-6 text-center text-xs text-gray-400 font-medium my-auto flex flex-col items-center gap-2">
                            <span>📦</span>
                            <span>{{ $col['emptyText'] }}</span>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
@endsection
