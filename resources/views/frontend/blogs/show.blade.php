@extends('layouts.app')
@section('title', e($blog->title))
@section('description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 160)))
@section('keywords', "مقالات, {$blog->title}, مدونة")
@section('canonical', urldecode(route('frontend.blogs.show', $blog->slug)))

@section('og_type', 'article')
@section('og_title', e($blog->title))
@section('og_description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''),
    160)))
@section('og_image', $blog->img ? asset('assets/blogs/images/' . $blog->img) :
    asset('frontand/assets/img/blog/default.jpg'))
@section('og_url', urldecode(route('frontend.blogs.show', $blog->slug)))
@section('og_keywords', "مقالات, {$blog->title}, مدونة")

@section('twitter_card', 'summary_large_image')
@section('twitter_title', e($blog->title))
@section('twitter_description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''),
    160)))
@section('twitter_image', $blog->img ? asset('assets/blogs/images/' . $blog->img) :
    asset('frontand/assets/img/blog/default.jpg'))
@section('twitter_keywords', "مقالات, {$blog->title}, مدونة")


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

            <div class="col-xxl-8 col-lg-8">
                @include('frontend.blogs.partials.show_partial', ['blog' => $blog])
            </div>

            <!-- Sidebar Column -->
            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث المقالات</h5>

                        @php
                            $recentList =
                                $recentBlogs ??
                                \App\Models\Blog::with('category')
                                    ->where('status', 1)
                                    ->orderByDesc('published_on')
                                    ->take(5)
                                    ->get();
                        @endphp

                        @if ($recentList->isNotEmpty())
                            <ul class="list-unstyled mb-0 pr-0">
                                @foreach ($recentList as $item)
                                    @php
                                        $thumbSrc = null;
                                        if (!empty($item->img)) {
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

                                        try {
                                            $publishedFormatted = $item->published_on
                                                ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                                : '';
                                        } catch (\Throwable $e) {
                                            $publishedFormatted = '';
                                        }

                                        $catTitle = $item->category->title ?? null;
                                        $catSlug = $item->category->slug ?? null;
                                    @endphp

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="{{ route('frontend.blogs.show', $item->slug) }}">
                                            <img src="{{ $thumbSrc }}" alt="" class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="{{ route('frontend.blogs.show', $item->slug) }}"
                                                class="d-block fw-bold text-dark small mb-1">
                                                {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                                            </a>

                                            <small class="text-muted d-block mb-1">{{ $publishedFormatted }}</small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> {{ $item->views ?? 0 }}

                                                @if (!empty($catTitle))
                                                    <a href="{{ $catSlug ? route('frontend.blogs.category', $catSlug) : '#' }}"
                                                        class="recent-video-badge ms-2" title="{{ e($catTitle) }}">
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
                                                            style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            {{ \Illuminate\Support\Str::limit($catTitle, 20) }}
                                                        </span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">لا توجد مقالات حديثة.</p>
                        @endif

                        <div class="mt-3 text-start">
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
            </aside>
        </div>
    </div>

@endsection
