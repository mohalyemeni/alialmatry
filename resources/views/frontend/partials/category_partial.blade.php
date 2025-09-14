<div class="container pt-45 pb-45">
    <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s"> الفيديوهات </h3>
    @if ($videos->isEmpty())
        <p>لا توجد فيديوهات في هذا التصنيف بعد.</p>
    @else
        <div class="row gy-4">
            @foreach ($videos as $index => $video)
                @php
                    $delay = 0.3 + $index * 0.05;

                    $thumbField = $video->thumbnail ?? '';
                    $thumbnailSrc = null;

                    if (!empty($thumbField)) {
                        $candidate1 = 'upload/' . ltrim($thumbField, '/');
                        $candidate2 = 'upload/' . basename($thumbField);

                        if (file_exists(public_path($candidate1))) {
                            $thumbnailSrc = asset($candidate1);
                        } elseif (file_exists(public_path($candidate2))) {
                            $thumbnailSrc = asset($candidate2);
                        }
                    }

                    if (empty($thumbnailSrc) && !empty($video->youtube_id)) {
                        $thumbnailSrc = "https://img.youtube.com/vi/{$video->youtube_id}/hqdefault.jpg";
                    }

                    if (empty($thumbnailSrc)) {
                        $thumbnailSrc = asset('frontand/assets/img/normal/counter-image.jpg');
                    }
                @endphp

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="mini-counter-image wow fadeInUp vc-card" data-wow-delay="{{ $delay }}s">
                        <a href="{{ route('frontend.videos.show', $video->slug) }}"
                            class="ajax-link text-decoration-none">
                            <div class="box-img global-img tow_height position-relative vc-img">
                                <img src="{{ $thumbnailSrc }}" alt="{{ $video->title }}" class="tow_height w-100">

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
