@extends('layouts.app')
@section('title', $blog->title)

@section('content')

    <!-- Breadcrumb Section -->
    <div class="breadcumb-wrapper" style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}')">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ e($blog->title) }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.blogs.index') }}"
                            class="text-white">المقالات</a></li>
                    @if ($blog->category)
                        <li class="list-inline-item"><a href="{{ route('frontend.blogs.category', $blog->category->slug) }}"
                                class="text-white">{{ e($blog->category->title) }}</a></li>
                    @endif
                    <li class="list-inline-item">{{ e($blog->title) }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container py-4 mt-5">
        <div class="row">
            <!-- Blog Content Column -->
            <div class="col-xxl-8 col-lg-8">
                @include('frontend.blogs.partials.show_partial', ['blog' => $blog])
            </div>

            <!-- Sidebar Column -->
            <div class="col-xxl-4 col-lg-4">
                <div class="widget1 footer-widget1">
                    <h3 class="widget_title1">أحدث المقالات</h3>
                    <div class="recent-post-wrap">
                        @php
                            // استخدم recentBlogs الممرّر من الكنترولر إن وُجد، وإذا لم يوجد نفّذ استعلاماً مع eager load للتصنيف
                            $recentList =
                                $recentBlogs ??
                                \App\Models\Blog::with('category')
                                    ->where('status', 1)
                                    ->orderByDesc('published_on')
                                    ->take(5)
                                    ->get();
                        @endphp

                        @forelse($recentList as $item)
                            @php
                                // Resolve thumbnail robustly
                                $thumbSrc = null;
                                if (!empty($item->img)) {
                                    // stored in assets/blogs/images/
                                    if (file_exists(public_path('assets/blogs/images/' . $item->img))) {
                                        $thumbSrc = asset('assets/blogs/images/' . $item->img);
                                    } elseif (
                                        \Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])
                                    ) {
                                        $thumbSrc = $item->img;
                                    } elseif (file_exists(public_path($item->img))) {
                                        $thumbSrc = asset($item->img);
                                    } elseif (file_exists(public_path('storage/' . ltrim($item->img, '/')))) {
                                        $thumbSrc = asset('storage/' . ltrim($item->img, '/'));
                                    }
                                }
                                $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/blog/default.jpg');

                                // published date (safe parse)
                                try {
                                    $publishedFormatted = $item->published_on
                                        ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                        : '';
                                } catch (\Throwable $e) {
                                    $publishedFormatted = '';
                                }

                                // ensure category exists and has title/slug
                                $catTitle = $item->category->title ?? null;
                                $catSlug = $item->category->slug ?? null;
                            @endphp

                            <div class="recent-post d-flex mb-3 align-items-start">
                                <div class="media-img me-2" style="flex:0 0 auto;">
                                    <a href="{{ route('frontend.blogs.show', $item->slug) }}">
                                        <img src="{{ $thumbSrc }}" alt="{{ e($item->title) }}" ">
                                                </a>
                                            </div>

                                            <div class="media-body1" style="min-width:0;">
                                                <h4 class="post-title1 mb-0" style="font-size: 14px;">
                                                    <a class="text-inherit d-block"
                                                        href="{{ route('frontend.blogs.show', $item->slug) }}">
                                                        {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                                                    </a>
                                                </h4>
                                                <div class="d-flex align-items-center justify-content-between mb-1" style="gap:8px;">
                                                    <div class="recent-post-meta1 text-muted small">
                                                        {{ $publishedFormatted }}
                                                    </div>

                                                    <div class="text-muted small d-flex align-items-center" style="gap:8px;">
                                                        <span class="d-flex align-items-center">
                                                            <i class="fa-solid fa-eye me-1"></i> {{ $item->views ?? 0 }}
                                                        </span>

                                                           @if (!empty($catTitle))
                                        {{-- badge ثابت فوق المحتوى حتى لا يتأثر بالـ :hover --}}
                                        <a href="{{ $catSlug ? route('frontend.blogs.category', $catSlug) : '#' }}"
                                            class="badge bg-light text-dark small text-decoration-none recent-category-badge"
                                            style="padding:4px 8px;border-radius:999px; position:relative; z-index:2;">
                                            <i class="fa-solid fa-folder-open me-1" style="font-size:0.75rem;"></i>
                                            {{ e(\Illuminate\Support\Str::limit($catTitle, 20)) }}
                                        </a>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    @empty
        <p class="text-muted">لا توجد مقالات حديثة.</p>
        @endforelse
    </div>

    <div class="mt-5 text-start">
        @if ($blog->category && !empty($blog->category->slug))
            <a href="{{ route('frontend.blogs.category', $blog->category->slug) }}" class="th-btn">
                عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
            </a>
        @else
            <a href="{{ route('frontend.blogs.index') }}" class="th-btn">
                عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
            </a>
        @endif
    </div>
    </div>
    </div>

    </div>
    </div>

@endsection
