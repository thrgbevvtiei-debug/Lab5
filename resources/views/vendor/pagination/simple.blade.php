@if ($paginator->hasPages())
    <nav class="pagination d-flex gap-3 align-items-center my-3">
        @if ($paginator->onFirstPage())
            <span class="text-muted">← Назад</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">← Назад</a>
        @endif

        <span class="info">
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
            з {{ $paginator->total() }}
        </span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Далі →</a>
        @else
            <span class="text-muted">Далі →</span>
        @endif
    </nav>
@endif
