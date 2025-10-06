<div class="container pt-45 pb-45 pt-60">
    <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
        <h3 class="widget_title mb-0 wow fadeInRight" data-wow-delay=".3s">
            الفيديوهات
        </h3>
        <div class="btn-group">
            <a href="{{ route('frontend.videos.index') }}" class="th-btn style1 fadeInRight wow" data-wow-delay=".3s">
                <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
            </a>
        </div>
    </div>

    @if ($videos->isEmpty())
        <p class="text-muted text-center">لا توجد فيديوهات في هذا التصنيف بعد.</p>
    @else
        <div class="row gy-4">
            @foreach ($videos as $index => $video)
                @php
                    $delay = 0.3 + $index * 0.05;
                    $thumbnailSrc = $video->thumbnail ?? asset('frontand/assets/img/normal/counter-image.jpg');
                @endphp

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!-- نفس تصميم البطاقات في قسم المرئيات -->
                    <div class="mini-counter-image wow fadeInUp st-video-card" data-wow-delay="{{ $delay }}s">
                        <a href="{{ route('frontend.videos.show', $video->slug) }}"
                            class="video-link d-block position-relative" aria-label="{{ e($video->title) }}">
                            <div class="box-img global-img tow_height st-vc-img"
                                style="position:relative; overflow:hidden;">
                                <img src="{{ $thumbnailSrc }}" alt="{{ e($video->title) }}"
                                    style="width:100%; height:100%; object-fit:cover;">
                                <button class="st-play-btn btn-play-video"
                                    data-youtube-id="{{ e($video->youtube_id ?? '') }}"
                                    data-title="{{ e($video->title) }}"
                                    aria-label="تشغيل {{ e(\Illuminate\Support\Str::limit($video->title, 60)) }}"
                                    type="button">
                                    <i class="fa-solid fa-play fa-flip-horizontal"></i>
                                </button>
                            </div>
                        </a>
                        <div class="card-body st-card-body">
                            <h5 class="card-title st-title text-end">
                                <a href="{{ route('frontend.videos.show', $video->slug) }}"
                                    class="text-dark ellipsis-title a_style" title="{{ e($video->title) }}">
                                    {{ e(\Illuminate\Support\Str::limit($video->title, 25)) }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5 mb-5">
            {{ $videos->links('pagination::simple-tailwind') }}
        </div>
    @endif
</div>
