@if ($paginator->hasPages())
    <ul class="pagination pagination-circle">
        @if ($paginator->onFirstPage())
            <li class="page-item previous disabled">
                <a href="#" class="page-link" rel="prev">
                    <i class="previous"></i>
                </a>
            </li>
        @else
            <li class="page-item previous">
                <a href="{{ $paginator->withQueryString()->previousPageUrl() }}" class="page-link" rel="prev">
                    <i class="previous"></i>
                </a>
            </li>
        @endif

        @php
            $maxDisplayedPages = config('pagination.max_displayed_pages_pagination');
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $startPage = max(1, min($currentPage, max(1, $lastPage - $maxDisplayedPages + 1)));
            $endPage = min($lastPage, $startPage + $maxDisplayedPages - 1);
        @endphp

        @if ($startPage > 2)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">
                    1
                </a>
            </li>
            <li class="page-item disabled">
                <span class="page-link">..</span>
            </li>
        @endif

        @foreach (range($startPage, $endPage) as $page)
            @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page">
                    <span class="page-link">
                        {{ $page }}
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($page) }}">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endforeach

        @if ($endPage < $lastPage)
            <li class="page-item disabled">
                <span class="page-link">..</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($lastPage) }}">
                    {{ $lastPage }}
                </a>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a href="{{ $paginator->withQueryString()->nextPageUrl() }}" class="page-link" rel="next">
                    <i class="next"></i>
                </a>
            </li>
        @else
            <li class="page-item next disabled">
                <a href="#" class="page-link" rel="next">
                    <i class="next"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
