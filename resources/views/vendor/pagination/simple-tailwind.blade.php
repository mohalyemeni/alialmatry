@if ($paginator->hasPages())
    <nav role="navigation"
         aria-label="Pagination Navigation"
         class="pagination-nav w-full flex items-center justify-between px-4 flex-row-reverse"
         dir="rtl">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="th-btn style1 th-btn1 prev-btn disabled relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5 rounded-md"
                  aria-disabled="true" style="pointer-events:none; opacity:0.6;">
                <span class="btn-text" data-back=" السابق" data-front=" السابق">{!! __('pagination.previous') !!}</span>
                <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="th-btn style1 th-btn1 prev-btn relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md focus:outline-none"
               aria-label="{{ __('pagination.previous') }}">
                <span class="btn-text" data-back=" السابق" data-front=" السابق">{!! __('pagination.previous') !!}</span>
                <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="th-btn style1 th-btn1 next-btn relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md focus:outline-none"
               aria-label="{{ __('pagination.next') }}">
                <i class="fa-solid fa-arrow-left me-1" aria-hidden="true"></i>
                <span class="btn-text" data-back=" التالي" data-front=" التالي"> </span>
            </a>
        @else
            <span class="th-btn style1 th-btn1 next-btn disabled relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5 rounded-md"
                  aria-disabled="true" style="pointer-events:none; opacity:0.6;">
                <i class="fa-solid fa-arrow-left me-1" aria-hidden="true"></i>
                <span class="btn-text" data-back=" التالي" data-front=" التالي"> </span>
            </span>
        @endif
    </nav>
@endif
