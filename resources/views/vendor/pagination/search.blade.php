@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item @if ($page == $paginator->currentPage()) active @endif" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
