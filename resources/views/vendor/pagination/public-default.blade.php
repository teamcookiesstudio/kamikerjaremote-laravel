@if ($paginator->hasPages())
<div class="pagination center-xs start-md">
    <a class="arrows" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ion-ios-arrow-back"></i></a>
    <ul class="pages">
        {{-- Previous Page Link --}}
        {{-- @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lsaquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
        @endif --}}

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">{{ $page }}</li>
                    @else
                        <li><a href="{{ $url }}" style="text-decoration:none; color:dimgrey"><span>{{ $page }}</span></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        {{-- @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
        @else
            <li class="disabled"><span>&rsaquo;</span></li>
        @endif --}}
    </ul> 
    @if ($paginator->hasMorePages())
        <a class="arrows" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ion-ios-arrow-forward"></i></a>
    @endif
</div>
@endif
