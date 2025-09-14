<div class="th-blog blog-single">
    @php

        $mainImage =
            $blogImage ??
            (!empty($blog->img) && file_exists(public_path('assets/blogs/images/' . $blog->img))
                ? asset('assets/blogs/images/' . $blog->img)
                : (!empty($blog->img) && \Illuminate\Support\Str::startsWith($blog->img, ['http://', 'https://'])
                    ? $blog->img
                    : asset('frontand/assets/img/blog/default.jpg')));
    @endphp

    @if ($mainImage)
        <div class="blog-single-img-wrapper blog-img">
            <img class="blog-single-img" src="{{ $mainImage }}" alt="{{ e($blog->title) }}">
        </div>
    @endif

    <div class="blog-content">
        <div class="blog-meta mb-3 d-flex flex-wrap align-items-center gap-3">
            <span class="text-muted"><i class="fa-solid fa-eye me-1"></i> {{ $blog->views ?? 0 }}</span>

            <span class="text-muted"><i class="fa-sharp fa-solid fa-clock me-1"></i>
                {{ optional($blog->published_on)->format('F d, Y') }}</span>

            @if (!empty($blog->category))
                <a href="{{ route('frontend.blogs.category', $blog->category->slug) }}"
                    class="d-inline-flex align-items-center text-muted small">
                    <img src="{{ asset('frontand/assets/img/icon/light2.svg') }}" alt="" class="me-1">
                    {{ $blog->category->title ?? __('panel.category_default') }}
                </a>
            @endif
        </div>

        <h3 class="mb-3">{{ e($blog->title) }}</h3>

        <div class="blog-body">
            {!! $blog->description !!}
        </div>
    </div>
</div>
