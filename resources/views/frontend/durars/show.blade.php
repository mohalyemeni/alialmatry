@extends('layouts.app')
@section('title', e($durar->title ?? 'الدرر السنية'))
@section('description', e($durar->excerpt ?? strip_tags(Str::limit($durar->description ?? '', 160))))
@section('keywords', "درر, {$durar->title}, إسلام, حديث")
@section('canonical', urldecode(route('frontend.durars.show', $durar->slug ?? '')))

@section('og_type', 'article')
@section('og_title', e($durar->title ?? 'الدرر السنية'))
@section('og_description', e($durar->excerpt ?? strip_tags(Str::limit($durar->description ?? '', 160))))
@section('og_image', $durar->img && file_exists(public_path('assets/durar_diniya/images/' . $durar->img)) ?
    asset('assets/durar_diniya/images/' . $durar->img) : asset('frontand/assets/img/normal/counter-image.jpg'))
@section('og_url', urldecode(route('frontend.durars.show', $durar->slug ?? '')))
@section('og_keywords', "درر, {$durar->title}, إسلام, حديث")

@section('twitter_card', 'summary_large_image')
@section('twitter_title', e($durar->title ?? 'الدرر السنية'))
@section('twitter_description', e($durar->excerpt ?? strip_tags(Str::limit($durar->description ?? '', 160))))
@section('twitter_image', $durar->img && file_exists(public_path('assets/durar_diniya/images/' . $durar->img)) ?
    asset('assets/durar_diniya/images/' . $durar->img) : asset('frontand/assets/img/normal/counter-image.jpg'))
@section('twitter_keywords', "درر, {$durar->title}, إسلام, حديث")
@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $durar->title ?? 'الدرر السنية' }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.durars.index') }}" class="text-white">الدرر
                            السنية</a></li>
                    @if (!empty($durar->title))
                        <li class="list-inline-item text-white-50">
                            {{ e(\Illuminate\Support\Str::limit($durar->title, 60)) }}
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row gy-4">
            <!-- main -->
            <main class="col-12 col-lg-8">
                <article class="durar-article">
                    <h3 class=" widget_title title-header-noline fadeInRight wow mb-4  text-wrap">
                        {{ e($durar->title ?? '') }}</h3>

                    <div class="mb-4 blog-single-img-wrapper blog-img">
                        <img src="{{ $img ?? asset('frontand/assets/img/normal/counter-image.jpg') }}"
                            alt="{{ e($durar->title ?? 'صورة') }}" class="blog-single-img" loading="lazy">
                    </div>

                    <p class="text-muted mb-3">
                        تاريخ النشر:
                        {{ optional($durar->published_on) ? \Carbon\Carbon::parse($durar->published_on)->format('Y-m-d') : '' }}

                        <span class="ms-3 d-inline-flex align-items-center">
                            <i class="fa-solid fa-eye me-1" aria-hidden="true"></i>
                            {{ $durar->views ?? 0 }}
                        </span>
                    </p>

                    <div class="durar-description mb-4">
                        {!! $durar->description ?? '' !!}
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('frontend.durars.index') }}" class="th-btn">عودة إلى الدرر السنية</a>
                    </div>
                </article>
            </main>


            <aside class="col-12 col-lg-4">
                <div class="sticky-sidebar">
                    <div class="card mb-4 shadow-sm">
                        <h3 class="widget_title title-header-noline mb-4">أحدث الدرر</h3>
                        <div class="card-body">

                            @php
                                $recent = collect($recentDurars ?? []);
                            @endphp

                            @if ($recent->isNotEmpty())
                                <ul class="list-unstyled mb-0 recent-durars">
                                    @foreach ($recent as $rd)
                                        @php
                                            $rd_img = $rd->img ?? null;
                                            if ($rd_img && file_exists(public_path(parse_url($rd_img, PHP_URL_PATH)))) {
                                                $rd_img = asset($rd_img);
                                            } elseif (!$rd_img) {
                                                $rd_img = asset('frontand/assets/img/normal/counter-image.jpg');
                                            }
                                        @endphp

                                        <li class="d-flex align-items-start mb-3 max_width">
                                            <a href="{{ route('frontend.durars.show', $rd->slug) }}" class="me-2"
                                                aria-label="عرض {{ e($rd->title ?? '') }}">
                                                <img src="{{ $rd_img }}" alt="{{ e($rd->title ?? '') }}"
                                                    class="recent-thumb" loading="lazy" width="80" height="60"
                                                    style="object-fit:cover; border-radius:4px;">
                                            </a>

                                            <div class="flex-grow-1">
                                                <a href="{{ route('frontend.durars.show', $rd->slug) }}"
                                                    class="d-block fw-bold text-dark mb-1">
                                                    {{ e(\Illuminate\Support\Str::limit($rd->title ?? '', 60)) }}
                                                </a>

                                                <div class="d-flex align-items-center justify-content-between mb-1"
                                                    style="gap:8px;">
                                                    <small class="text-muted d-block mb-1">
                                                        {{ $rd->published_on ?? '' }}
                                                    </small>

                                                    <div class="text-muted small d-flex align-items-center"
                                                        style="gap:8px;">
                                                        <span class="d-flex align-items-center">
                                                            <i class="fa-solid fa-eye me-1" aria-hidden="true"></i>
                                                            {{ $rd->views ?? 0 }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <p class="mb-0 text-muted small">
                                                    {{ e(\Illuminate\Support\Str::limit(strip_tags($rd->excerpt ?? ($rd->description ?? '')), 80)) }}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0 me-2">لا توجد درر حديثة.</p>
                            @endif

                        </div>
                    </div>


                </div>
            </aside>
        </div>
    </div>
@endsection
