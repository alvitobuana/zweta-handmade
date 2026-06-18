@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap items-center justify-center gap-2">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3.5 py-2 bg-cream text-gray-300 rounded-xl text-xs font-semibold border border-soft-beige/40 cursor-not-allowed select-none">
                &laquo;&laquo; First
            </span>
        @else
            <a href="{{ $paginator->url(1) }}" class="px-3.5 py-2 bg-white text-dark-brown hover:bg-caramel hover:text-white rounded-xl text-xs font-semibold border border-soft-beige/80 transition-all duration-200 shadow-sm">
                &laquo;&laquo; First
            </a>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3.5 py-2 bg-cream text-gray-300 rounded-xl text-xs font-semibold border border-soft-beige/40 cursor-not-allowed select-none">
                &laquo; Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3.5 py-2 bg-white text-dark-brown hover:bg-caramel hover:text-white rounded-xl text-xs font-semibold border border-soft-beige/80 transition-all duration-200 shadow-sm">
                &laquo; Prev
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden sm:flex items-center gap-1.5">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3.5 py-2 text-gray-400 select-none text-xs">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3.5 py-2 bg-caramel text-white rounded-xl text-xs font-bold border border-caramel shadow-sm select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3.5 py-2 bg-white text-dark-brown hover:bg-caramel hover:text-white rounded-xl text-xs font-semibold border border-soft-beige/80 transition-all duration-200 shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Mobile Current Page Indicator --}}
        <span class="flex sm:hidden px-4 py-2 bg-caramel text-white rounded-xl text-xs font-bold border border-caramel shadow-sm select-none">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3.5 py-2 bg-white text-dark-brown hover:bg-caramel hover:text-white rounded-xl text-xs font-semibold border border-soft-beige/80 transition-all duration-200 shadow-sm">
                Next &raquo;
            </a>
        @else
            <span class="px-3.5 py-2 bg-cream text-gray-300 rounded-xl text-xs font-semibold border border-soft-beige/40 cursor-not-allowed select-none">
                Next &raquo;
            </span>
        @endif

        {{-- Last Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-3.5 py-2 bg-white text-dark-brown hover:bg-caramel hover:text-white rounded-xl text-xs font-semibold border border-soft-beige/80 transition-all duration-200 shadow-sm">
                Last &raquo;&raquo;
            </a>
        @else
            <span class="px-3.5 py-2 bg-cream text-gray-300 rounded-xl text-xs font-semibold border border-soft-beige/40 cursor-not-allowed select-none">
                Last &raquo;&raquo;
            </span>
        @endif
    </nav>
@endif
