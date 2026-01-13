@if ($paginator->hasPages())
    <div class="pagination-wrapper">

        <ul class="pagination">

            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                @if ($paginator->onFirstPage())
                    <span class="page-link">‹</span>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">‹</a>
                @endif
            </li>

            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            @if ($page == $paginator->currentPage())
                                <span class="page-link">{{ $page }}</span>
                            @else
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">›</a>
                @else
                    <span class="page-link">›</span>
                @endif
            </li>

        </ul>

        <small class="pagination-info">
            Showing {{ $paginator->firstItem() }}
            to {{ $paginator->lastItem() }}
            of {{ $paginator->total() }} results
        </small>

    </div>
@endif
