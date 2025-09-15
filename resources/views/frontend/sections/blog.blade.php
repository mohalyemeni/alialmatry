<div class="pb_80 pt-60 overflow-hidden positive-relative my-animation theme_overlay_new">
    <div class="container">
        <div class="row gap_mine">

            {{-- المقالات --}}
            <div class="col-12 col-xl-6">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 fadeInRight wow" data-wow-delay=".3s">
                        المقالات
                        @if (isset($blogCategory) && !empty($blogCategory->name))
                            - {{ e($blogCategory->name) }}
                        @endif
                    </h3>

                    <div class="btn-group">
                        <a href="{{ route('frontend.blogs.index') ?? '#' }}" class="th-btn style1 fadeInRight wow"
                            data-wow-delay=".3s">
                            <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                        </a>
                    </div>
                </div>

                @if (isset($blogs) && $blogs->count())
                    <div class="slider-area">
                        <div class="swiper th-slider has-shadow background-image_privet" id="cousrseSlide"
                            data-slider-options='{"loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2},"768":{"slidesPerView":2},"992":{"slidesPerView":2},"1300":{"slidesPerView":2}}}'>
                            <div class="swiper-wrapper">
                                @foreach ($blogs as $b)
                                    <div class="swiper-slide wow fadeInUp" data-wow-delay=".3s">
                                        <div class="cousrse-card cousrse-card2">
                                            <div class="box-img global-img tow_height">
                                                @php
                                                    // صورة افتراضية
                                                    $img = asset('frontand/assets/img/normal/counter-image.jpg');

                                                    // إذا تم تخزين اسم الملف في الحقل img وكان موجودًا داخل public/assets/blogs/images/
                                                    if (
                                                        !empty($b->img) &&
                                                        file_exists(public_path('assets/blogs/images/' . $b->img))
                                                    ) {
                                                        $img = asset('assets/blogs/images/' . $b->img);
                                                    } elseif (
                                                        !empty($b->img) &&
                                                        \Illuminate\Support\Str::startsWith($b->img, [
                                                            'http://',
                                                            'https://',
                                                        ])
                                                    ) {
                                                        $img = $b->img;
                                                    }
                                                @endphp

                                                <a href="{{ route('frontend.blogs.show', $b->slug) }}"
                                                    aria-label="عرض المقال {{ e($b->title) }}">
                                                    <img src="{{ $img }}" alt="{{ e($b->title) }}"
                                                        class="tow_height"
                                                        style="width:100%; height:100%; object-fit:cover;">
                                                </a>
                                            </div>

                                            <div class="hei">
                                                <h3 class="box-title">
                                                    <a href="{{ route('frontend.blogs.show', $b->slug) }}">
                                                        {{ e(\Illuminate\Support\Str::limit($b->title, 15)) }}
                                                    </a>
                                                </h3>

                                                @if (!empty($b->excerpt))
                                                    <p class="small text-muted mb-2">
                                                        {{ e(\Illuminate\Support\Str::limit(strip_tags($b->excerpt), 35)) }}
                                                    </p>
                                                @endif

                                                <p class="tags text-muted mb-2">
                                                    {{ $b->category->name ?? '' }}
                                                </p>

                                                <div class="btn-group justify-content-between">

                                                    <a class="th-btn border-btn2 new_pad"
                                                        href="{{ route('frontend.blogs.index', ['category' => $b->category->slug ?? ($b->category->id ?? '')]) }}">
                                                        {{ $b->category->name ?? 'التصنيف' }}
                                                    </a>

                                                    <a class="th-btn border-btn2 read-btn-custom new_pad"
                                                        href="{{ route('frontend.blogs.show', $b->slug) }}">
                                                        قراءة <i class="fa-solid fa-arrow-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                @else
                    <p class="text-muted">لا توجد مقالات لعرضها حالياً.</p>
                @endif
            </div>



            {{-- الكتب والمؤلفات --}}
            <div class="col-12 col-xl-6">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 fadeInRight wow" data-wow-delay=".3s">
                        الكتب والمؤلفات
                        @if (isset($bookCategory) && !empty($bookCategory->name))
                            - {{ e($bookCategory->name) }}
                        @endif
                    </h3>

                    <div class="btn-group">
                        <a href="{{ route('frontend.books.index') ?? '#' }}" class="th-btn style1 fadeInRight wow"
                            data-wow-delay=".3s">
                            <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                        </a>
                    </div>
                </div>

                @if (isset($books) && $books->count())
                    @php
                        // if $books is a Paginator, extract the underlying collection so we can use ->take()
                        $displayBooks = $books;
                        if ($books instanceof \Illuminate\Pagination\AbstractPaginator) {
                            $displayBooks = $books->getCollection();
                        }
                    @endphp

                    <div class="services-replace">
                        <div class="row">

                            @foreach ($displayBooks->take(2) as $bk)
                                <div class="col-12 col-sm-6">
                                    <div class="service-box2 wow fadeInUp mb-2" data-wow-delay=".3s">
                                        @php
                                            $img = $bk->img ?? asset('frontand/assets/img/normal/counter-image.jpg');
                                            if (
                                                !empty($bk->img) &&
                                                file_exists(public_path('assets/books/images/' . $bk->img))
                                            ) {
                                                $img = asset('assets/books/images/' . $bk->img);
                                            }
                                        @endphp

                                        <div class="box-img">
                                            <a href="{{ route('frontend.books.show', $bk->slug) }}">
                                                <img src="{{ $img }}" alt="{{ e($bk->title) }}">
                                            </a>
                                        </div>

                                        <div class="box-info">
                                            <div class="box-icon">
                                                <img src="{{ asset('frontand/assets/img/icon/service_2_2.svg') }}"
                                                    alt="Icon">
                                            </div>

                                            <h3 class="box-title">
                                                <a
                                                    href="{{ route('frontend.books.show', $bk->slug) }}">{{ e(\Illuminate\Support\Str::limit($bk->title, 25)) }}</a>
                                            </h3>
                                        </div>

                                        <div class="box-content">
                                            <div class="box-wrapp">
                                                <div class="box-icon">
                                                    <img src="{{ asset('frontand/assets/img/icon/service_2_2.svg') }}"
                                                        alt="Icon">
                                                </div>
                                                <h3 class="box-title">
                                                    <a
                                                        href="{{ route('frontend.books.show', $bk->slug) }}">{{ e(\Illuminate\Support\Str::limit($bk->title, 20)) }}</a>
                                                </h3>
                                                @if (!empty($bk->excerpt ?? $bk->description))
                                                    <p class="small text-muted mt-2">
                                                        {{ e(\Illuminate\Support\Str::limit(strip_tags($bk->excerpt ?? $bk->description), 120)) }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="service-btn">
                                                @if (!empty($bk->file_url))
                                                    <a href="{{ $bk->file_url }}" target="_blank" class="simple-btn"
                                                        download>
                                                        تحميل <i class="fa-solid fa-download ms-2"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('frontend.books.show', $bk->slug) }}"
                                                        class="simple-btn">
                                                        عرض التفاصيل
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-muted">لا توجد كتب لعرضها حالياً.</p>
                @endif
            </div>


        </div>
    </div>
</div>
