@if ($paginator->hasPages())
    <nav aria-label="Navegación simple">
        <ul class="pagination pagination-sm justify-content-center mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-chevron-left"></i> Anterior
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i> Anterior
                    </a>
                </li>
            @endif

            {{-- Current Page Info --}}
            <li class="page-item active">
                <span class="page-link">
                    Página {{ $paginator->currentPage() }}
                </span>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Siguiente <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        Siguiente <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif