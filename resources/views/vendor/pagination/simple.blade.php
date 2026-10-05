{{-- FILE BARU: resources/views/vendor/pagination/simple.blade.php
     Pagination sederhana (dipakai admin & publik). Didaftarkan di AppServiceProvider. --}}
@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Navigasi halaman">
  @if ($paginator->onFirstPage())
    <span class="dis">&laquo;</span>
  @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
  @endif

  @foreach ($elements as $element)
    @if (is_string($element))
      <span class="dis">{{ $element }}</span>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <span class="cur">{{ $page }}</span>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
  @else
    <span class="dis">&raquo;</span>
  @endif
</nav>
@endif
