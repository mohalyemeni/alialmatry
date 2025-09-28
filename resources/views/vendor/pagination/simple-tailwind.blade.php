@if ($paginator->hasPages())
    <nav role="navigation"
         aria-label="Pagination Navigation"
         class="pagination-nav w-full flex items-center justify-between px-4 flex-row-reverse"
         dir="rtl">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="prev-btn relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="prev-btn relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="next-btn relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="next-btn relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
