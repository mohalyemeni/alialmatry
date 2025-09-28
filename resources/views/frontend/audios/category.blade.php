@extends('layouts.app')

@section('title', e($category->title))
@section('description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))
@section('canonical', urldecode(route('frontend.audios.category', $category->slug ?? $category->id)))

@section('og_type', 'website')
@section('og_title', e($category->title))
@section('og_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('og_image', $category->img ? asset('assets/audio_categories/' . $category->img) : asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', urldecode(route('frontend.audios.category', $category->slug ?? $category->id)))
@section('og_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))

@section('twitter_card', 'summary_large_image')
@section('twitter_title', e($category->title))
@section('twitter_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('twitter_image', $category->img ? asset('assets/audio_categories/' . $category->img) : asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}');
               background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ e($category->title) }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item">
                        <a href="{{ route('frontend.index') }}" class="text-white">{{ __('panel.home') }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('frontend.audios.index') }}" class="text-white">{{ __('panel.audios') }}</a>
                    </li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .audio-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            font-size: 22px;
            flex-shrink: 0;
        }

        .recent-audio-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 88px;
            height: 64px;
            border-radius: 6px;
            font-size: 20px;
            flex-shrink: 0;
        }
    </style>

    <div class="container py-4">
        <div class="row">

            <!-- القائمة الرئيسية -->
            <div class="col-xxl-8 col-lg-8">
                <div class="list-group">
                    @forelse ($audios as $audio)
                        @php
                            $excerpt = $audio->excerpt ?? '';
                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        @endphp

                        <div class="list-group-item d-flex justify-content-between align-items-start py-3 flex-wrap">
                            <!-- الأيقونة -->

                            <!-- العنوان + الأزرار -->
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <div class="audio-thumb me-3">
                                        <i class="fa fa-volume-up icon_color"></i>
                                    </div>
                                    <h5 class="mb-1">
                                        <a href="{{ route('frontend.audios.show', $audio->slug) }}"
                                           class="text-dark text-decoration-none">
                                            {{ e(\Illuminate\Support\Str::limit($audio->title, 50)) }}
                                        </a>
                                    </h5>

                                    <div class="meta-buttons">
                                        <a href="{{ route('frontend.audios.show', $audio->slug) }}"
                                           class="th-btn style1 th-btn1" aria-label="تشغيل {{ e($audio->title) }}">
                                            <span class="btn-text" data-back="{{ __('panel.play') }}"
                                                  data-front="{{ __('panel.play') }}"></span>
                                            <i class="fa-solid fa-play me-1"></i>
                                        </a>

                                        @if (!empty($audio->audio_file))
                                            <a href="{{ route('frontend.audios.download', $audio->id) }}"
                                               class="th-btn style2 th-btn1" aria-label="تحميل {{ e($audio->title) }}">
                                                <span class="btn-text" data-back="{{ __('panel.download') }}"
                                                      data-front="{{ __('panel.download') }}"></span>
                                                <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                    @empty
                        <p class="text-muted">لا توجد صوتيات في هذا التصنيف.</p>
                    @endforelse
                </div>

                <div class="mt-4 d-flex justify-content-center mb-5">
                    {{ $audios->links('pagination::simple-tailwind') }}
                </div>
            </div>

            <!-- الشريط الجانبي -->
            <aside class="col-xxl-4 col-lg-4 pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث الصوتيات</h5>

                        @if (!empty($recentAudios) && $recentAudios->count())
                            <ul class="list-unstyled mb-0 pr-0">
                                @foreach ($recentAudios as $item)
                                    @php
                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    @endphp

                                    <li class="d-flex align-items-start mb-3 gap-3">
                                        <a href="{{ route('frontend.audios.show', $item->slug) }}">
                                            <div class="recent-audio-thumb">
                                                <i class="fa fa-volume-up ms-2 icon_color"></i>
                                            </div>
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="{{ route('frontend.audios.show', $item->slug) }}"
                                               class="d-block fw-bold text-dark small mb-1">
                                                {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                                            </a>

                                            <small class="text-muted d-block mb-1">{{ $rDate }}</small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> {{ $item->views ?? 0 }}
                                                @if (!empty($item->category))
                                                    <a href="{{ route('frontend.audios.category', $item->category->slug ?? '#') }}"
                                                       class="recent-video-badge ms-2"
                                                       title="{{ e($item->category->title) }}">
                                                        <i class="fa-solid fa-folder-open"
                                                           style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            {{ \Illuminate\Support\Str::limit($item->category->title, 18) }}
                                                        </span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">لا توجد صوتيات حديثة.</p>
                        @endif

                        <div class="mt-3 text-start">
                            @if ($category->slug)
                                <a href="{{ route('frontend.audios.category', $category->slug) }}" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            @else
                                <a href="{{ route('frontend.audios.index') }}" class="th-btn">
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
