@extends('layouts.app')
@section('title', $category->title)

@section('content')
    {{-- Breadcrumb --}}
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $category->title }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.blogs.index') }}"
                            class="text-white">المقالات</a></li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container py-4">
        <div class="row">
            {{-- مقالات --}}
            <div class="col-12 col-xl-6">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 fadeInRight wow" data-wow-delay=".3s">
                        المقالات
                        @if (isset($blogCategory) && !empty($blogCategory->name))
                            - {{ e($blogCategory->name) }}
                        @endif
                    </h3>

                    <div class="btn-group">
                        <a href="{{ route('frontend.blogs.index') ?? '#' }}" class="th-btn style1 fadeInRight wow"
                            data-wow-delay=".3s">
                            <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                        </a>
                    </div>
                </div>

                @if (isset($blogs) && $blogs->count())
                    <div class="list-group">
                        @foreach ($blogs as $blog)
                            <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="me-3" style="flex:1;">
                                    <h5 class="mb-1">
                                        <i class="fa fa-newspaper me-2 text-primary"></i>
                                        <a href="{{ route('frontend.blogs.show', $blog->slug) }}">
                                            {{ e($blog->title) }}
                                        </a>
                                    </h5>

                                    @if (!empty($blog->excerpt ?? '') || !empty($blog->description ?? ''))
                                        <p class="mb-1 text-muted small">
                                            {{ e(\Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?? ($blog->description ?? '')), 120)) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="button-wrapp d-flex align-items-center">
                                    <a href="{{ route('frontend.blogs.show', $blog->slug) }}"
                                        class="th-btn style1 th-btn1">
                                        <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">لا توجد مقالات لعرضها حالياً.</p>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="col-md-4">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-newspaper me-2 text-primary"></i>
                            أحدث المقالات
                        </h5>

                        @php
                            $recentBlogs =
                                $recentBlogs ?? $category->blogs()->where('status', 1)->latest()->take(6)->get();
                        @endphp

                        @if ($recentBlogs->isNotEmpty())
                            <ul class="list-group list-unstyled mb-0">
                                @foreach ($recentBlogs as $item)
                                    <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                        <div class="me-3" style="flex:1;">
                                            <h6 class="mb-1">
                                                <a href="{{ route('frontend.blogs.show', $item->slug) }}">
                                                    {{ e(\Illuminate\Support\Str::limit($item->title, 50)) }}
                                                </a>
                                            </h6>

                                            @if (!empty($item->excerpt ?? '') || !empty($item->description ?? ''))
                                                <p class="mb-1 text-muted small">
                                                    {{ e(\Illuminate\Support\Str::limit(strip_tags($item->excerpt ?? ($item->description ?? '')), 80)) }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="button-wrapp d-flex align-items-center">
                                            <a href="{{ route('frontend.blogs.show', $item->slug) }}"
                                                class="th-btn style1 th-btn1">
                                                <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                                <i class="fa-solid fa-eye me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">لا توجد مقالات حديثة.</p>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
