@extends('layouts.app')
@section('title', e($video->title ?? 'المرئي'))

@section('content')
    <div class="container-fluid">
        <div class="row gx-4 gy-4 justify-content-center">
            <!-- main column -->
            <div class="col-xxl-9 col-lg-8 pt-4 pb-5">
                <div class="th-blog blog-single has-post-thumbnail">
                    <div class="blog-img position-relative mb-3">
                        @if (!empty($video->youtube_id))
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @elseif(!empty($video->html))
                            <div class="video-oembed">
                                {!! $video->html !!}
                            </div>
                        @elseif(!empty($video->thumbnail))
                            @php
                                $thumb = $video->thumbnail;
                                $thumbnailSrc = null;

                                // إذا كان رابط مطلق فاستعمله مباشرة
                                if (\Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://'])) {
                                    $thumbnailSrc = $thumb;
                                } else {
                                    // حاول تفضيل public/upload أولاً ثم نسخ متعددة كف fallback
                                    $candidates = [
                                        'upload/' . ltrim($thumb, '/'), // public/upload/...
                                        'upload/' . basename($thumb), // public/upload/<file>
                                        ltrim($thumb, '/'), // قد يكون مسار كامل أو نسبى
                                        'storage/' . ltrim($thumb, '/'), // storage symlink
                                        'videos/thumbnails/' . ltrim($thumb, '/'), // legacy public folder
                                        'assets/videos/thumbnails/' . ltrim($thumb, '/'),
                                        'assets/video_categories/' . ltrim($thumb, '/'),
                                    ];

                                    foreach ($candidates as $p) {
                                        if ($p && file_exists(public_path($p))) {
                                            $thumbnailSrc = asset($p);
                                            break;
                                        }
                                    }

                                    // كخيار أخير: لو لم نجد في public، جرّب Storage::disk('public')
                                    if (
                                        !$thumbnailSrc &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($thumb)
                                    ) {
                                        $thumbnailSrc = asset('storage/' . ltrim($thumb, '/'));
                                    }
                                }
                            @endphp

                            @if ($thumbnailSrc)
                                <img src="{{ $thumbnailSrc }}" alt="{{ e($video->title) }}" class="img-fluid w-100">
                            @else
                                <div class="d-flex align-items-center justify-content-center"
                                    style="height:360px; background:#eee;">
                                    <span class="text-muted">لا توجد معاينة</span>
                                </div>
                            @endif
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                style="height:360px; background:#eee;">
                                <span class="text-muted">لا توجد معاينة</span>
                            </div>
                        @endif
                    </div>

                    <div class="blog-content mt-3">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-2">
                            <div class="blog-meta text-muted">
                                <span><i class="fa-solid fa-calendar-days"></i>
                                    {{ optional($video->published_on)->format('Y-m-d') ?? '-' }}</span>
                                <span class="ms-3"><i class="fa-solid fa-eye"></i> {{ $video->views ?? 0 }} مشاهدة</span>
                            </div>

                            {{-- عرض تصنيف الفيديو الكبير كـ badge --}}
                            @if (!empty($video->category) && (!empty($video->category->title) || !empty($video->category->name)))
                                @php
                                    $catTitle = $video->category->title ?? ($video->category->name ?? null);
                                    $catSlug = $video->category->slug ?? null;
                                @endphp
                                <div class="align-self-start">
                                    <a href="{{ $catSlug ? route('frontend.videos.category', $catSlug) : '#' }}"
                                        class="recent-video-badge large-video-badge text-decoration-none"
                                        title="{{ e($catTitle) }}">
                                        <i class="fa-solid fa-layer-group me-1" aria-hidden="true"></i>
                                        <span
                                            class="recent-video-badge-text">{{ e(\Illuminate\Support\Str::limit($catTitle, 30)) }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <h3 class="blog-title mb-2">{{ e($video->title) }}</h3>

                        @if ($video->description)
                            <p class="blog-text">{!! nl2br(e($video->description)) !!}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <aside class="col-xxl-3 col-lg-4 pt-4 pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث الفيديوهات </h5>

                        @if (isset($recentVideos) && $recentVideos->isNotEmpty())
                            <ul class="list-unstyled mb-0 pr-0">
                                @foreach ($recentVideos as $rv)
                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="{{ route('frontend.videos.show', $rv->slug) }}">
                                            <img src="{{ $rv->thumbnail }}" alt="{{ e($rv->title) }}"
                                                class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1">
                                            <a href="{{ route('frontend.videos.show', $rv->slug) }}"
                                                class="d-block fw-bold text-dark small mb-1">
                                                {{ e(\Illuminate\Support\Str::limit($rv->title, 60)) }}
                                            </a>
                                            <small class="text-muted d-block mb-1">{{ $rv->published_on ?? '' }}</small>

                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="fa-solid fa-eye me-1"></i> {{ $rv->views ?? 0 }}

                                                @if (!empty($rv->category) && !empty($rv->category->title))
                                                    <a href="{{ $rv->category->slug ? route('frontend.videos.category', $rv->category->slug) : '#' }}"
                                                        class="recent-video-badge ms-2"
                                                        title="{{ e($rv->category->title) }}">
                                                        <i class="fa-solid fa-tag me-1" aria-hidden="true"></i>
                                                        <span
                                                            class="recent-video-badge-text">{{ e(\Illuminate\Support\Str::limit($rv->category->title, 16)) }}</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">لا توجد فيديوهات حديثة.</p>
                        @endif

                        <div class="mt-3 text-start">
                            @if ($video->category && !empty($video->category->slug))
                                <a href="{{ route('frontend.videos.category', $video->category->slug) }}" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            @else
                                <a href="{{ route('frontend.videos.index') }}" class="th-btn">
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
