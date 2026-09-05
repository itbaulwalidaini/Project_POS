@if ($paginator->hasPages())
<span class="fs-15">
    Menampilkan no {{ $paginator->firstItem() }}
    sampai {{ $paginator->lastItem() }}
    dari {{ $paginator->total() }} entry
</span>
<nav aria-label="custom-pagination" class="custom-pagination">
    <ul class="pagination mb-0 justify-content-center">

        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <button aria-label="Previous" wire:click="previousPage" class="page-link icon">
                <i class="material-symbols-outlined">
                    west
                </i>
            </button>
        </li>

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                <li class="page-item">
                    <button class="page-link {{ $page == $paginator->currentPage() ? 'active' : '' }}" wire:click="gotoPage({{ $page }})">
                        {{ $page }}
                    </button>
                </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <button aria-label="Next" wire:click="nextPage" class="page-link icon">
                <i class="material-symbols-outlined">
                    east
                </i>
            </button>
        </li>
    </ul>
</nav>
@endif