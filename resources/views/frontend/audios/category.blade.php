@extends('layouts.app')
@section('title', e($category->title))
@section('description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))
@section('canonical', urldecode(route('frontend.audios.category', $category->slug ?? $category->id)))
@section('og_type', 'website')
@section('og_title', e($category->title))
@section('og_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('og_image', $category->img ? asset('assets/audio_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', urldecode(route('frontend.audios.category', $category->slug ?? $category->id)))
@section('og_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))
@section('twitter_card', 'summary_large_image')
@section('twitter_title', e($category->title))
@section('twitter_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title))
@section('twitter_image', $category->img ? asset('assets/audio_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title))

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ e($category->title) }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}"
                            class="text-white">{{ __('panel.home') }}</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.audios.index') }}"
                            class="text-white">{{ __('panel.audios') }}</a></li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        /* ----- أيقونة الصوت بديل الصورة ----- */
        .audio-thumb,
        .recent-audio-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6; /* خلفية فاتحة */
            color: #0ea5a4; /* لون الأيقونة (يمكن تغييره) */
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 2px 8px rgba(2,6,23,0.03);
        }

        .audio-thumb {
            width: 120px;
            height: 120px;
            font-size: 42px;
        }

        .audio-thumb .fa-play,
        .audio-thumb .fa-circle-play {
            font-size: 42px;
        }

        .recent-audio-thumb {
            width: 88px;
            height: 64px;
            border-radius: 6px;
            font-size: 20px;
        }

        /* تأثير hover مشابه للأزرار */
        .audio-thumb:hover,
        .recent-audio-thumb:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(2,6,23,0.08);
            transition: transform .16s ease, box-shadow .18s ease;
            cursor: pointer;
        }

        /* استجابة للشاشات الصغيرة */
        @media (max-width: 576px) {
            .custom-audio-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .custom-audio-item>div:first-child {
                flex: 0 0 auto;
                width: 100%;
            }

            .audio-thumb {
                width: 100%;
                height: 180px;
                font-size: 48px;
                border-radius: 6px;
            }

            .custom-audio-item>div:nth-child(2) {
                width: 100%;
            }

            .custom-audio-item .d-flex.align-items-center.justify-content-between {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .custom-audio-item .meta-buttons {
                width: 100%;
                display: flex;
                justify-content: flex-start;
                gap: 10px;
                margin-top: 5px;
            }
        }

        /* ضبط الشريط الجانبي للعنصر الحديث */
        .recent-video-thumb {
            display: none; /* نخفي الصورة القديمة لو كانت موجودة عبر كلاس قديم */
        }
    </style>

    <div class="container py-4">
        <div class="row">

            <div class="col-xxl-8 col-lg-8">
                <div class="list-group">

                    @forelse ($audios as $audio)
                        @php
                            $excerpt = $audio->excerpt ?? '';
                            // نحتفظ بالthumbSrc لو احتجته لاحقاً
                            $thumbSrc = $audio->img ?? null;

                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        @endphp

                        <div class="list-group-item custom-audio-item d-flex align-items-start gap-3">
                            {{-- هنا استبدلنا الصورة بـ أيقونة صوت --}}
                            <div style="flex:0 0 120px;">
                                <a href="{{ route('frontend.audios.show', $audio->slug) }}" aria-label="تشغيل {{ e($audio->title) }}">
                                    <div class="audio-thumb" role="img" aria-hidden="true">
                                        <i class="fa-solid fa-circle-play" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>

                            <div style="flex:1; min-width:0;">
                                <h5 class="mb-1">
                                    <a href="{{ route('frontend.audios.show', $audio->slug) }}" class="d-block text-dark">
                                        {{ e(\Illuminate\Support\Str::limit($audio->title, 80)) }}
                                    </a>
                                </h5>

                                @if (!empty($excerpt))
                                    <small class="text-muted d-block mb-2"
                                        style="line-height:1.2;">{{ e($excerpt) }}</small>
                                @endif

                                <div class="d-flex align-items-center justify-content-between" style="gap:8px;">
                                    <div class="text-muted small d-flex align-items-center" style="gap:12px;">
                                        <span><i class="fa-solid fa-calendar-days me-1"></i> {{ $published }}</span>
                                        <span><i class="fa-solid fa-eye me-1"></i> {{ $audio->views ?? 0 }}</span>
                                        @if (!empty($audio->category))
                                            <a href="{{ route('frontend.audios.category', $audio->category->slug ?? '#') }}"
                                                class="recent-video-badge" style="padding:4px 8px;border-radius:999px;">
                                                <i class="fa-solid fa-folder-open me-1" style="font-size:0.75rem;"></i>
                                                {{ \Illuminate\Support\Str::limit($audio->category->title, 20) }}
                                            </a>
                                        @endif
                                    </div>

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

            <!-- Sidebar -->
            <aside class="col-xxl-4 col-lg-4  pb-5">
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

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="{{ route('frontend.audios.show', $item->slug) }}">
                                            {{-- استبدلنا الصورة المصغرة بأيقونة --}}
                                            <div class="recent-audio-thumb" aria-hidden="true">
                                                <i class="fa-solid fa-play"></i>
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
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
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
                                <a href="{{ route('frontend.audios.category', $category->slug) }}" class="th-btn">عرض
                                    المزيد <i class="fa-solid fa-arrow-left ms-1"></i></a>
                            @else
                                <a href="{{ route('frontend.audios.index') }}" class="th-btn">عرض المزيد <i
                                        class="fa-solid fa-arrow-left ms-1"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $featuredCats = \App\Models\Category::where('section', \App\Models\Category::SECTION_AUDIO)
                        ->where('status', 1)
                        ->where('featured', 1)
                        ->whereHas('audios', function ($q) {
                            $q->where('status', 1);
                        })
                        ->orderByDesc('id')
                        ->take(6)
                        ->get();
                @endphp

            </aside>
        </div>
    </div>
@endsection
