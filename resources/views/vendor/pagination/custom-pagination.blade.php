@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center">
        <div class="flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 bg-indigo-600 text-gray rounded-md hover:bg-indigo-700 transition duration-300">Previous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-gray bg-indigo-600 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-4 py-2 bg-gray-100 text-indigo-600 rounded-md hover:bg-indigo-200 transition duration-300">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 bg-indigo-600 text-gray rounded-md hover:bg-indigo-700 transition duration-300">Next</a>
            @else
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md">Next</span>
            @endif
        </div>
    </nav>
@endif
