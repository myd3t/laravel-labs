@if ($paginator->hasPages())
    <nav class="pagination">
        @if ($paginator->onFirstPage())
            <span>Назад</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Назад</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Вперёд</a>
        @else
            <span>Вперёд</span>
        @endif
    </nav>
@endif
