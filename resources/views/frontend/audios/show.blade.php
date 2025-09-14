{{-- resources/views/frontend/audios/show.blade.php --}}
@extends('layouts.app')
@section('title', e($audio->title))

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ e($audio->title) }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}"
                            class="text-white">{{ __('panel.home') }}</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.audios.index') }}"
                            class="text-white">{{ __('panel.audios') }}</a></li>
                    @if (!empty($audio->category))
                        <li class="list-inline-item"><a
                                href="{{ route('frontend.audios.category', $audio->category->slug) }}"
                                class="text-white">{{ e($audio->category->title) }}</a></li>
                    @endif
                    <li class="list-inline-item">{{ e(\Illuminate\Support\Str::limit($audio->title, 60)) }}</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        /* CSS محلي لتنسيق المشغل والـ sidebar (خاص بالصفحة) */
        .audio-player-row {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .audio-player-row audio {
            flex: 1 1 auto;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .audio-download-btn {
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .audio-download-btn .th-btn {
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        /* small screens: stack vertically so player is full width and download button below (or to the end) */
        @media (max-width: 576px) {
            .audio-player-row {
                flex-direction: column;
                align-items: stretch;
            }

            .audio-download-btn {
                align-self: flex-end;
            }
        }

        /* sidebar styles (keep namespaced) */
        .audio-sidebar .recent-thumb {
            width: 84px;
            height: 64px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
        }

        .audio-sidebar .recent-post {
            gap: 12px;
            align-items: flex-start;
            display: flex;
        }

        .audio-sidebar .audio-badge {
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 0.78rem;
            display: inline-flex;
            gap: 6px;
            align-items: center;
            text-decoration: none;
        }

        .audio-sidebar .post-title-small {
            font-size: 14px;
            margin: 0;
        }

        .audio-sidebar .post-title-small a {
            color: #0f172a;
            text-decoration: none;
        }

        .audio-sidebar .post-title-small a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>

    <div class="container py-4">
        <div class="row">
            <!-- main -->
            <div class="col-lg-8">
                <div class="card p-3 sermon-card">
                    <h3 class="mb-4 widget_title title-header-noline fadeInRight wow">{{ e($audio->title) }}</h3>

                    {{-- Audio player row: player + download button (responsive) --}}
                    <div class="audio-play-wrapp mb-3">
                        @php
                            $hasAudioFile =
                                !empty($audio->audio_file) &&
                                file_exists(public_path('assets/audios/files/' . $audio->audio_file));
                            $audioFileUrl = $hasAudioFile ? asset('assets/audios/files/' . $audio->audio_file) : null;
                        @endphp

                        @if ($hasAudioFile)
                            <div class="audio-download-btn ms-2">
                                <a href="{{ route('frontend.audios.download', $audio->id) }}" class="th-btn style2 th-btn1"
                                    aria-label="{{ __('panel.download') }} {{ e($audio->title) }}">
                                    <span class="btn-text" data-back="{{ __('panel.download') }}"
                                        data-front="{{ __('panel.download') }}"></span>
                                    <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                </a>
                            </div>
                            <div class="audio-player-row">
                                <audio controls preload="metadata" aria-label="{{ e($audio->title) }}">
                                    <source src="{{ $audioFileUrl }}" type="audio/mpeg">
                                    {{ __('panel.audio_not_supported') }}
                                </audio>


                            </div>
                        @else
                            <div class="alert alert-secondary mb-0">{{ __('panel.no_audio_file') }}</div>
                        @endif
                    </div>

                    {{-- other resource buttons (pdf/doc) kept below player, if any --}}
                    <div class="button-wrapp pt-15 d-flex flex-wrap gap-2 wow fadeInRight" data-wow-delay=".4s">
                        @if (!empty($audio->pdf_link))
                            <a href="{{ $audio->pdf_link }}" target="_blank" class="th-btn style2 th-btn1">
                                <span class="btn-text" data-back="{{ __('panel.pdf') }}"
                                    data-front="{{ __('panel.pdf') }}"></span>
                                <i class="fa-regular fa-file-pdf ms-2"></i>
                            </a>
                        @endif

                        @if (!empty($audio->doc_link))
                            <a href="{{ $audio->doc_link }}" target="_blank" class="th-btn style2 th-btn1">
                                <span class="btn-text" data-back="{{ __('panel.documents') }}"
                                    data-front="{{ __('panel.documents') }}"></span>
                                <i class="fa-solid fa-file ms-2"></i>
                            </a>
                        @endif
                    </div>

                    <div class="sermon-text mb-3">
                        {!! $audio->description ?? '' !!}
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <div class="col-lg-4">
                <div class="card p-3 audio-sidebar">
                    <h5 class="mb-3">{{ __('panel.recent_audios') }}</h5>

                    @php
                        // controller may pass $recentAudios; otherwise query here (with category eager-load)
                        $recent =
                            $recentAudios ??
                            \App\Models\Audio::with('category')
                                ->where('status', 1)
                                ->where(function ($q) {
                                    $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                })
                                ->orderByDesc('published_on')
                                ->limit(6)
                                ->get();
                    @endphp

                    @if ($recent->isNotEmpty())
                        <ul class="list-unstyled recent-list mb-0">
                            @foreach ($recent as $rd)
                                @php
                                    // image resolution
                                    $rd_img = null;
                                    if (!empty($rd->img)) {
                                        if (\Illuminate\Support\Str::startsWith($rd->img, ['http://', 'https://'])) {
                                            $rd_img = $rd->img;
                                        } elseif (file_exists(public_path('assets/audios/images/' . $rd->img))) {
                                            $rd_img = asset('assets/audios/images/' . $rd->img);
                                        } elseif (file_exists(public_path($rd->img))) {
                                            $rd_img = asset($rd->img);
                                        } elseif (
                                            \Illuminate\Support\Facades\Storage::disk('public')->exists($rd->img)
                                        ) {
                                            $rd_img = asset('storage/' . ltrim($rd->img, '/'));
                                        }
                                    }
                                    $rd_img = $rd_img ?: asset('frontand/assets/img/normal/counter-image.jpg');

                                    $rd_date = $rd->published_on
                                        ? \Carbon\Carbon::parse($rd->published_on)->format('d M, Y')
                                        : '';
                                @endphp

                                <li class="mb-3">
                                    <div class="recent-post">
                                        <div class="media-img me-2" style="flex:0 0 auto;">
                                            <a href="{{ route('frontend.audios.show', $rd->slug) }}">
                                                <img src="{{ $rd_img }}" alt="{{ e($rd->title) }}"
                                                    class="recent-thumb">
                                            </a>
                                        </div>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <div class="recent-post-meta1 text-muted small">{{ $rd_date }}</div>

                                                <div class="text-muted small d-flex align-items-center" style="gap:8px;">
                                                    <span class="d-flex align-items-center"><i
                                                            class="fa-solid fa-eye me-1"></i> {{ $rd->views ?? 0 }}</span>

                                                    @if (!empty($rd->category))
                                                        <a href="{{ route('frontend.audios.category', $rd->category->slug ?? '#') }}"
                                                            class="audio-badge bg-light text-dark text-decoration-none">
                                                            <i class="fa-solid fa-folder-open"
                                                                style="font-size:0.72rem;"></i>
                                                            <span>{{ \Illuminate\Support\Str::limit($rd->category->title, 18) }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <h4 class="post-title1 mb-0 post-title-small">
                                                <a class="text-inherit d-block"
                                                    href="{{ route('frontend.audios.show', $rd->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($rd->title, 70) }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">{{ __('panel.no_recent_audios') }}</p>
                    @endif

                    <div class="mt-3 text-start">
                        <a href="{{ route('frontend.audios.index') }}" class="th-btn new_pad">{{ __('panel.view_more') }}
                            <i class="fa-solid fa-arrow-left ms-1"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
