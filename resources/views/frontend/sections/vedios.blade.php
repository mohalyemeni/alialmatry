@if ((isset($videos) && $videos instanceof \Illuminate\Support\Collection && $videos->count()) || isset($videosMain))
    @php
        $smartLimit = function ($text, $limit = 25) {
            $text = trim(strip_tags((string) $text));
            if (mb_strlen($text) <= $limit) {
                return $text;
            }
            $sub = mb_substr($text, 0, $limit);
            $pos = mb_strrpos($sub, ' ');
            if ($pos !== false) {
                return mb_substr($sub, 0, $pos) . '...';
            }
            return $sub . '...';
        };

        // Determine main (featured) and small items.
        // Prefer variables passed explicitly from controller ($videosMain, $videosSmall).
        $main = $videosMain ?? null;
        $smallItems = collect();

        if (isset($videosSmall) && $videosSmall instanceof \Illuminate\Support\Collection && $videosSmall->count()) {
            $smallItems = $videosSmall;
            // If main isn't set, try to set it from videos (first item)
            if (!$main && isset($videos) && $videos instanceof \Illuminate\Support\Collection && $videos->count()) {
                $main = $videos->first();
                // remove main from smallItems if it exists there
                $smallItems = $smallItems->reject(fn($v) => isset($v->id) && $main && $v->id == $main->id)->values();
            }
        } elseif (isset($videos) && $videos instanceof \Illuminate\Support\Collection) {
            // videos collection exists but videosSmall not provided — derive
            if ($main) {
                // main already provided, take next 4 excluding main
                $smallItems = $videos
                    ->reject(fn($v) => isset($v->id) && $main && $v->id == $main->id)
                    ->take(4)
                    ->values();
            } else {
                // no main provided — use first as main and next 4 as small
                $main = $videos->first();
                $smallItems = $videos->slice(1, 4)->values();
            }
        }
    @endphp

    <div class="space overflow-hidden">
        <div class="container">
            <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                <h3 class="widget_title mb-0">
                    الفيديوهات

                </h3>

                <div class="btn-group">
                    <a href="{{ isset($videoCategory) ? route('frontend.videos.index', ['category' => $videoCategory->slug ?? $videoCategory->id]) : route('frontend.videos.index') }}"
                        class="th-btn style1">
                        <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                    </a>
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-xl-6">
                    <div class="row gy-4">
                        @forelse ($smallItems as $v)
                            <div class="col-md-6">
                                <div class="mini-counter-image wow fadeInUp" data-wow-delay=".3s">
                                    <a href="{{ route('frontend.videos.show', $v->slug) }}"
                                        class="video-link d-block position-relative" aria-label="{{ e($v->title) }}">
                                        <div class="box-img global-img tow_height"
                                            style="position:relative; overflow:hidden;">
                                            <img src="{{ $v->thumbnail }}" alt="{{ e($v->title) }}" class="tow_height"
                                                style="width:100%; height:100%; object-fit:cover;">
                                            <button class="play-btn custom-center-play-btn btn-play-video"
                                                data-youtube-id="{{ e($v->youtube_id) }}"
                                                data-title="{{ e($v->title) }}"
                                                aria-label="تشغيل {{ e(\Illuminate\Support\Str::limit($v->title, 60)) }}"
                                                type="button"
                                                style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); border:none; background:transparent; font-size:28px; color:#fff;">
                                                <i class="fa-solid fa-play fa-flip-horizontal"></i>
                                            </button>
                                        </div>
                                    </a>

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('frontend.videos.show', $v->slug) }}"
                                                class="text-dark ellipsis-title" title="{{ e($v->title) }}">
                                                {{ e($smartLimit($v->title, 15)) }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <div class="col-xl-6">
                    @if ($main)
                        <div class="mini-counter-image wow fadeInUp global-img box-img" data-wow-delay=".3s">
                            <a href="{{ route('frontend.videos.show', $main->slug) }}"
                                class="video-link d-block position-relative" aria-label="{{ e($main->title) }}">
                                <div class="counter-image global-img box-img vedio_heigh"
                                    style="position:relative; overflow:hidden;">
                                    <img src="{{ $main->thumbnail }}" alt="{{ e($main->title) }}"
                                        style="width:100%; height:100%; object-fit:cover;">
                                    <button class="play-btn custom-center-play-btn btn-play-video"
                                        data-youtube-id="{{ e($main->youtube_id) }}"
                                        data-title="{{ e($main->title) }}"
                                        aria-label="تشغيل {{ e(\Illuminate\Support\Str::limit($main->title, 30)) }}"
                                        type="button"
                                        style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); border:none; background:transparent; font-size:40px; color:#fff;">
                                        <i class="fa-solid fa-play fa-flip-horizontal"></i>
                                    </button>
                                </div>
                            </a>

                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('frontend.videos.show', $main->slug) }}"
                                        class="text-dark ellipsis-title" title="{{ e($main->title) }}">
                                        {{ e($smartLimit($main->title, 15)) }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close btn-close-white position-absolute end-0 m-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="ratio ratio-16x9">
                        <iframe id="videoFrame" src="" title="Video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('videoModal');
                const videoFrame = document.getElementById('videoFrame');

                function openYouTube(yid) {
                    if (!yid) return;
                    videoFrame.src = 'https://www.youtube.com/embed/' + encodeURIComponent(yid) + '?rel=0&autoplay=1';
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    modalEl.addEventListener('hidden.bs.modal', function() {
                        videoFrame.src = '';
                    }, {
                        once: true
                    });
                }

                document.querySelectorAll('.btn-play-video').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const yid = btn.getAttribute('data-youtube-id');
                        if (yid) {
                            openYouTube(yid);
                        } else {
                            const parentLink = btn.closest('a.video-link');
                            if (parentLink && parentLink.href) {
                                window.location.href = parentLink.href;
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endif
