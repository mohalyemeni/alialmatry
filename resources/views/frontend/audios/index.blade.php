@extends('layouts.app')

@section('title', 'الصوتيات')
@section('description', 'عرض آخر التصنيفات الصوتية والصوتيات المتاحة على الموقع')
@section('keywords', 'صوتيات, مرئيات, موقعنا')
@section('canonical', urldecode(route('frontend.audios.index')))
@section('og_type', 'website')
@section('og_title', 'الصوتيات')
@section('og_description', 'عرض آخر التصنيفات الصوتية والصوتيات المتاحة على الموقع')
@section('og_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', route('frontend.audios.index'))
@section('og_keywords', 'صوتيات, مرئيات, موقعنا')
@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'الصوتيات')
@section('twitter_description', 'عرض آخر التصنيفات الصوتية والصوتيات المتاحة على الموقع')
@section('twitter_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', 'صوتيات, مرئيات, موقعنا')

@section('content')

    <!-- Breadcrumb Section -->
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ __('panel.audios') }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}"
                            class="text-white">{{ __('panel.home') }}</a></li>
                    <li class="list-inline-item">{{ __('panel.audios') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="blog-area overflow-hidden bg-white space" id="audio-sec">
        <div class="container">

            <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s">
                التصنيفات</h3>

            {{-- Grid (static, non-swiper) --}}
            <div class="container pt-30 pb-45">
                @if ($categories->isEmpty())
                    <p class="text-muted">لا توجد تصنيفات حالياً.</p>
                @else
                    <div class="row gy-4">
                        @foreach ($categories as $index => $category)
                            @php
                                $delay = 0.3 + $index * 0.04;

                                $img = $category->img ? asset('assets/audio_categories/' . $category->img) : null;
                                $title = $category->title ?? ($category->name ?? ($category->slug ?? 'تصنيف'));
                                $audiosCount =
                                    $category->audios_count ?? ($category->audios()->where('status', 1)->count() ?? 0);
                            @endphp

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="blog-box style2 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                    @if ($img)
                                        <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                                            <a href="{{ route('frontend.audios.category', $category->slug ?? $category->id) }}"
                                                class="d-block">
                                                <img src="{{ $img }}" alt="{{ e($title) }}"
                                                    style="width:100%; height:100%; object-fit:cover;">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="blog-wrapper p-3">
                                        <span class="date">
                                            <a
                                                href="{{ route('frontend.audios.category', $category->slug ?? $category->id) }}">
                                                {{ $audiosCount }} <span>صوت</span>
                                            </a>
                                        </span>

                                        <div class="blog-content mt-2">
                                            <h3 class="box-title mb-2" style="font-size:1rem;">
                                                <a
                                                    href="{{ route('frontend.audios.category', $category->slug ?? $category->id) }}">
                                                    {{ e(\Illuminate\Support\Str::limit($title, 70)) }}
                                                </a>
                                            </h3>

                                            <a href="{{ route('frontend.audios.category', $category->slug ?? $category->id) }}"
                                                class="th-btn border-btn">
                                                تصفح <i class="fa-solid fa-arrow-left ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
