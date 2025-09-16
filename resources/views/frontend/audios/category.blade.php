@extends('layouts.app')
@section('title', e($category->title))

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

            .custom-audio-item img {
                width: 100%;
                height: auto;
                object-fit: cover;
                border-radius: 5px;
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
    </style>

    <div class="container py-4">
        <div class="row">

            <div class="col-xxl-8 col-lg-8">
                <div class="list-group">

                    @forelse ($audios as $audio)
                        @php
                            $excerpt = $audio->excerpt ?? '';
                            $thumbSrc = $audio->img ?? null;

                            if (!$thumbSrc) {
                                if (!empty($audio->img)) {
                                    if (\Illuminate\Support\Str::startsWith($audio->img, ['http://', 'https://'])) {
                                        $thumbSrc = $audio->img;
                                    } elseif (file_exists(public_path('assets/audios/images/' . $audio->img))) {
                                        $thumbSrc = asset('assets/audios/images/' . $audio->img);
                                    } elseif (file_exists(public_path($audio->img))) {
                                        $thumbSrc = asset($audio->img);
                                    } elseif (
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($audio->img)
                                    ) {
                                        $thumbSrc = asset('storage/' . ltrim($audio->img, '/'));
                                    }
                                }
                                $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/normal/counter-image.jpg');
                            }

                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        @endphp

                        <div class="list-group-item custom-audio-item d-flex align-items-start gap-3">
                            <div style="flex:0 0 120px;">
                                <a href="{{ route('frontend.audios.show', $audio->slug) }}">
                                    <img src="{{ $thumbSrc }}" alt="">
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
                                            class="th-btn style1 th-btn1">
                                            <span class="btn-text" data-back="{{ __('panel.play') }}"
                                                data-front="{{ __('panel.play') }}"></span>
                                            <i class="fa-solid fa-play me-1"></i>
                                        </a>

                                        @if (!empty($audio->audio_file))
                                            <a href="{{ route('frontend.audios.download', $audio->id) }}"
                                                class="th-btn style2 th-btn1">
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

                <div class="mt-4">
                    {{ $audios->links() }}
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
                                        $rThumb = $item->img ?: asset('frontand/assets/img/normal/counter-image.jpg');
                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    @endphp

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="{{ route('frontend.audios.show', $item->slug) }}">
                                            <img src="{{ $rThumb }}" alt="" class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
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
