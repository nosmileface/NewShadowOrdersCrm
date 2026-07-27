@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center py-3 px-3">

        <div class="text-muted">
            Показано {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} из {{ $paginator->total() }}
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">

                <li class="page-item first {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    @if ($paginator->onFirstPage())
                        <span class="page-link"><i class="tf-icon bx bx-chevrons-left"></i></span>
                    @else
                        <a class="page-link" href="{{ $paginator->url(1) }}" rel="first">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    @endif
                </li>

                <li class="page-item prev {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    @if ($paginator->onFirstPage())
                        <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
                    @else
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="tf-icon bx bx-chevron-left"></i>
                        </a>
                    @endif
                </li>

                @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <li class="page-item next {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                    @if ($paginator->hasMorePages())
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <i class="tf-icon bx bx-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-link"><i class="tf-icon bx bx-chevron-right"></i></span>
                    @endif
                </li>

                <li class="page-item last {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                    @if ($paginator->hasMorePages())
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    @else
                        <span class="page-link"><i class="tf-icon bx bx-chevrons-right"></i></span>
                    @endif
                </li>

            </ul>
        </nav>
    </div>
@endif
