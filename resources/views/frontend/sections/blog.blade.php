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
                    @php
                        $latestBlogs = $blogs->take(4);
                    @endphp

                    <div class="list-group">
                        @foreach ($latestBlogs as $blog)
                            <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="me-3" style="flex:1;">
                                    <h5 class="mb-1">
                                        <i class="fa fa-newspaper me-2 text-primary"></i>
                                        <a href="{{ route('frontend.blogs.show', $blog->slug) }}">
                                            {{ e($blog->title) }}
                                        </a>
                                    </h5>

                                    @if (!empty($blog->excerpt ?? '') || !empty($blog->description ?? ''))
                                        <p class="mb-1 text-muted small">
                                            {{ e(\Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?? ($blog->description ?? '')), 120)) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="button-wrapp d-flex align-items-center">
                                    <a href="{{ route('frontend.blogs.show', $blog->slug) }}"
                                        class="th-btn style1 th-btn1">
                                        <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">لا توجد مقالات لعرضها حالياً.</p>
                @endif
            </div>

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
                                                <a href="{{ route('frontend.books.show', $bk->slug) }}">
                                                    {{ e(\Illuminate\Support\Str::limit($bk->title, 25)) }}
                                                </a>
                                            </h3>
                                        </div>

                                        <div class="box-content">
                                            <div class="box-wrapp">
                                                <div class="box-icon">
                                                    <img src="{{ asset('frontand/assets/img/icon/service_2_2.svg') }}"
                                                        alt="Icon">
                                                </div>
                                                <h3 class="box-title">
                                                    <a href="{{ route('frontend.books.show', $bk->slug) }}">
                                                        {{ e(\Illuminate\Support\Str::limit($bk->title, 20)) }}
                                                    </a>
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
