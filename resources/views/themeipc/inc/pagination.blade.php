@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')"><i class="fas fa-caret-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $start = max(1, $currentPage - 1); // Trang bắt đầu
            $end = min($lastPage, $currentPage + 1); // Trang kết thúc
        @endphp

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $currentPage)
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- "Three Dots" Separator --}}
        @if ($end < $lastPage)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif

        {{-- Last Page Link --}}
        @if ($currentPage < $lastPage)
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="@lang('pagination.next')"><i class="fas fa-caret-right"></i></a>
            </li>
        @endif
    </ul>
@endif
