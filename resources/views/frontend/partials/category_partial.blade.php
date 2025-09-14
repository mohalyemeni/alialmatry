<div class="container  pt-45 pb-45">
    <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s"> الفيديوهات </h3>
    @if ($videos->isEmpty())
        <p>لا توجد فيديوهات في هذا التصنيف بعد.</p>
    @else
        <div class="row gy-4">
            @foreach ($videos as $index => $video)
                @php
                    $delay = 0.3 + $index * 0.05;

                    $thumbField = $video->thumbnail;
                    $thumbnailSrc = null;

                    if (!empty($thumbField)) {
                        // absolute URL -> use it
                        if (\Illuminate\Support\Str::startsWith($thumbField, ['http://', 'https://'])) {
                            $thumbnailSrc = $thumbField;
                        } else {
                            // prefer public/upload first (new location)
                            $candidates = [
                                'upload/' . ltrim($thumbField, '/'),
                                'upload/' . basename($thumbField),
                                // if DB stored relative path already
                                ltrim($thumbField, '/'),
                                // storage disk public (storage/app/public/...)
                                'storage/' . ltrim($thumbField, '/'),
                                // legacy fallback inside public
                                'videos/thumbnails/' . ltrim($thumbField, '/'),
                                'assets/videos/thumbnails/' . ltrim($thumbField, '/'),
                            ];

                            foreach ($candidates as $p) {
                                if ($p && file_exists(public_path($p))) {
                                    $thumbnailSrc = asset($p);
                                    break;
                                }
                            }

                            // if not found in public paths, check Storage::disk('public') as last resort
                            if (
                                !$thumbnailSrc &&
                                \Illuminate\Support\Facades\Storage::disk('public')->exists($thumbField)
                            ) {
                                $thumbnailSrc = asset('storage/' . ltrim($thumbField, '/'));
                            } elseif (!$thumbnailSrc) {
                                // also check a possible storage path variant (videos/thumbnails inside storage)
                                $attempt = 'videos/thumbnails/' . ltrim($thumbField, '/');
                                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($attempt)) {
                                    $thumbnailSrc = asset('storage/' . $attempt);
                                }
                            }
                        }
                    }

                    // fallback to youtube thumbnail if still empty
                    if (empty($thumbnailSrc) && !empty($video->youtube_id)) {
                        $thumbnailSrc = "https://img.youtube.com/vi/{$video->youtube_id}/hqdefault.jpg";
                    }

                    // final fallback placeholder
                    $thumbnailSrc = $thumbnailSrc ?: asset('frontand/assets/img/normal/counter-image.jpg');

                @endphp

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="mini-counter-image wow fadeInUp vc-card" data-wow-delay="{{ $delay }}s">
                        <a href="{{ route('frontend.videos.show', $video->slug) }}"
                            class="ajax-link text-decoration-none">
                            <div class="box-img global-img tow_height position-relative vc-img">
                                @if ($thumbnailSrc)
                                    <img src="{{ $thumbnailSrc }}" alt="{{ $video->title }}" class="tow_height w-100">
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="height:160px; background:#eee;">
                                        <span class="text-muted">لا صورة</span>
                                    </div>
                                @endif

                                <span class="play-btn custom-center-play-btn vc-play" aria-hidden="true">
                                    <i class="fa-solid fa-play fa-flip-horizontal"></i>
                                </span>
                            </div>

                            <div class="card-body text-center vc-body">
                                <h5 class="card-title vc-title">{{ \Illuminate\Support\Str::limit($video->title, 70) }}
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {!! $videos->links() !!}
        </div>
    @endif
</div>
