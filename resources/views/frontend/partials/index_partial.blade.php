<section class="blog-area overflow-hidden bg-white space" id="blog-sec">
    <div class="container">

        <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s"> التنصيفات</h3>
        س
        <div class="container pt-30 pb-45">
            @if ($categories->isEmpty())
                <p class="text-muted">لا توجد تصنيفات حالياً.</p>
            @else
                <div class="row gy-4">
                    @foreach ($categories as $index => $category)
                        @php
                            $delay = 0.3 + $index * 0.04;

                            $img = null;
                            $rawImg = $category->img ?? '';

                            if (!empty($rawImg)) {
                                $path = 'assets/video_categories/' . basename($rawImg);
                                if (file_exists(public_path($path))) {
                                    $img = asset($path);
                                }
                            }

                            $title = $category->title ?? ($category->name ?? '');
                            $videosCount =
                                $category->videos_count ?? ($category->videos()->where('status', 1)->count() ?? 0);
                        @endphp

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="blog-box style2 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                @if ($img)
                                    <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                                        <a href="{{ route('frontend.videos.category', $category->slug ?? $category->id) }}"
                                            class="d-block">
                                            <img src="{{ $img }}" alt="{{ e($title) }}"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        </a>
                                    </div>
                                @endif

                                <div class="blog-wrapper p-3">
                                    <span class="date">
                                        <a
                                            href="{{ route('frontend.videos.category', $category->slug ?? $category->id) }}">
                                            {{ $videosCount }} <span>فيديو</span>
                                        </a>
                                    </span>

                                    <div class="blog-content mt-2">
                                        <h3 class="box-title mb-2" style="font-size:1rem;">
                                            <a
                                                href="{{ route('frontend.videos.category', $category->slug ?? $category->id) }}">
                                                {{ e(\Illuminate\Support\Str::limit($title, 70)) }}
                                            </a>
                                        </h3>

                                        <a href="{{ route('frontend.videos.category', $category->slug ?? $category->id) }}"
                                            class="th-btn border-btn">
                                            تصفح <i class="fa-solid fa-arrow-left ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
