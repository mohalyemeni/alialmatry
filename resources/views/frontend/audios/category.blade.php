{{-- resources/views/frontend/audios/category.blade.php --}}
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

    <div class="container py-4">
        <div class="row">
            <!-- Main list -->
            <div class="col-md-6 col-lg-8 col-xl-8">
                <div class="list-group">
                    @foreach ($audios as $audio)
                        @php
                            // safe excerpt
                            $excerpt = !empty($audio->excerpt)
                                ? \Illuminate\Support\Str::limit(strip_tags($audio->excerpt), 120)
                                : \Illuminate\Support\Str::limit(strip_tags($audio->description ?? ''), 120);

                            // determine thumbnail (try multiple locations)
                            $thumbSrc = null;
                            if (!empty($audio->img)) {
                                if (\Illuminate\Support\Str::startsWith($audio->img, ['http://', 'https://'])) {
                                    $thumbSrc = $audio->img;
                                } elseif (file_exists(public_path('assets/audios/images/' . $audio->img))) {
                                    $thumbSrc = asset('assets/audios/images/' . $audio->img);
                                } elseif (file_exists(public_path($audio->img))) {
                                    $thumbSrc = asset($audio->img);
                                } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($audio->img)) {
                                    $thumbSrc = asset('storage/' . ltrim($audio->img, '/'));
                                }
                            }
                            $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/normal/counter-image.jpg');

                            // published date
                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        @endphp

                        <div class="list-group-item custom-audio-item d-flex align-items-start gap-3">
                            <div style="flex:0 0 120px;">
                                <a href="{{ route('frontend.audios.show', $audio->slug) }}">
                                    <img src="{{ $thumbSrc }}" alt="{{ e($audio->title) }}">
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
                                                class="badge bg-light text-dark small text-decoration-none"
                                                style="padding:4px 8px;border-radius:999px;">
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
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $audios->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="widget1 footer-widget1 mb-4 p-3">
                    <h3 class="widget_title1">أحدث الصوتيات</h3>

                    @php
                        // use $recentAudios if controller passed it; otherwise query with eager load for category
                        $recentList =
                            $recentAudios ??
                            \App\Models\Audio::with('category')
                                ->where('status', 1)
                                ->where(function ($q) {
                                    $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                })
                                ->orderByDesc('published_on')
                                ->take(6)
                                ->get();
                    @endphp

                    @if ($recentList->isNotEmpty())
                        <div class="recent-post-wrap">
                            @foreach ($recentList as $item)
                                @php
                                    // thumb resolution similar to above
                                    $rThumb = null;
                                    if (!empty($item->img)) {
                                        if (\Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])) {
                                            $rThumb = $item->img;
                                        } elseif (file_exists(public_path('assets/audios/images/' . $item->img))) {
                                            $rThumb = asset('assets/audios/images/' . $item->img);
                                        } elseif (file_exists(public_path($item->img))) {
                                            $rThumb = asset($item->img);
                                        } elseif (
                                            \Illuminate\Support\Facades\Storage::disk('public')->exists($item->img)
                                        ) {
                                            $rThumb = asset('storage/' . ltrim($item->img, '/'));
                                        }
                                    }
                                    $rThumb = $rThumb ?: asset('frontand/assets/img/normal/counter-image.jpg');

                                    $rDate = $item->published_on
                                        ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                        : '';
                                @endphp

                                <div class="recent-post d-flex mb-3">
                                    <div class="media-img me-2" style="flex:0 0 auto;">
                                        <a href="{{ route('frontend.audios.show', $item->slug) }}">
                                            <img src="{{ $rThumb }}" alt="{{ e($item->title) }}" ">
                                                                </a>
                                                            </div>

                                                            <div class="media-body1" style="min-width:0;">
                                                                  <h4 class="post-title1 mb-0" style="font-size: 14px;">
                            <a class="text-inherit d-block" href="{{ route('frontend.audios.show', $item->slug) }}">
                                {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                            </a>
                        </h4>
                                                                <div class="d-flex align-items-center justify-content-between mb-1"
                                                                    style="gap:8px;">
                                                                    <div class="recent-post-meta1 text-muted small">{{ $rDate }}</div>

                                                                    <div class="text-muted small d-flex align-items-center" style="gap:8px;">
                                                                        <span class="d-flex align-items-center"><i class="fa-solid fa-eye me-1"></i>
                                                                            {{ $item->views ?? 0 }}</span>

                                                                              @if (!empty($item->category))
                                            <a href="{{ route('frontend.audios.category', $item->category->slug ?? '#') }}"
                                                class="badge bg-light text-dark small text-decoration-none"
                                                style="padding:4px 8px;border-radius:999px;">
                                                <i class="fa-solid fa-folder-open me-1" style="font-size:0.75rem;"></i>
                                                {{ \Illuminate\Support\Str::limit($item->category->title, 18) }}
                                            </a>
                            @endif
                        </div>
                </div>


            </div>
        </div>
        @endforeach
    </div>
@else
    <p class="text-muted">لا توجد صوتيات حديثة.</p>
    @endif

    <div class="mt-3 text-end">
        @if ($category->slug)
            <a href="{{ route('frontend.audios.category', $category->slug) }}" class="th-btn">عرض المزيد <i
                    class="fa-solid fa-arrow-left ms-1"></i></a>
        @else
            <a href="{{ route('frontend.audios.index') }}" class="th-btn">عرض المزيد <i
                    class="fa-solid fa-arrow-left ms-1"></i></a>
        @endif
    </div>
    </div>

    {{-- Featured categories (optional) --}}
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

    @if ($featuredCats->isNotEmpty())
        <div class="widget1 footer-widget1 p-3">
            <h3 class="widget_title1">تصنيفات مميزة</h3>
            <ul class="list-unstyled mb-0">
                @foreach ($featuredCats as $fc)
                    <li class="mb-2">
                        <a href="{{ route('frontend.audios.category', $fc->slug) }}"
                            class="text-decoration-none d-flex align-items-center" style="gap:10px;">
                            <div style="flex:0 0 44px;">
                                @php
                                    $cimg = null;
                                    if (!empty($fc->img)) {
                                        if (\Illuminate\Support\Str::startsWith($fc->img, ['http://', 'https://'])) {
                                            $cimg = $fc->img;
                                        } elseif (file_exists(public_path('assets/audio_categories/' . $fc->img))) {
                                            $cimg = asset('assets/audio_categories/' . $fc->img);
                                        }
                                    }
                                    $cimg = $cimg ?: asset('frontand/assets/img/normal/counter-image.jpg');
                                @endphp
                                <img src="{{ $cimg }}" alt="{{ $fc->title }}">
                            </div>
                            <div style="flex:1; min-width:0;">
                                <strong
                                    style="font-size:0.95rem;">{{ \Illuminate\Support\Str::limit($fc->title, 40) }}</strong>
                                <div class="text-muted small">
                                    {{ $fc->audios_count ?? $fc->audios()->where('status', 1)->count() }} صوت
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    </div>
    </div>
    </div>
@endsection
