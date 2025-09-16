<div class="container pt-45 pb-45">
    <h3 class="widget_title title-header-noline mb-5 wow fadeInRight mt-5" data-wow-delay=".3s"> التنصيفات</h3>
    @if ($categories->isEmpty())
        <p class="text-muted">لا توجد تصنيفات حالياً.</p>
    @else
        <div class="row gy-4">
            @foreach ($categories as $index => $category)
                @php
                    $delay = 0.3 + $index * 0.04;
                    $img = null;
                    if (
                        !empty($category->img) &&
                        file_exists(public_path('assets/fatawa_categories/' . $category->img))
                    ) {
                        $img = asset('assets/fatawa_categories/' . $category->img);
                    } elseif (
                        !empty($category->img) &&
                        \Illuminate\Support\Str::startsWith($category->img, ['http://', 'https://'])
                    ) {
                        $img = $category->img;
                    } elseif (!empty($category->img) && file_exists(public_path($category->img))) {
                        $img = asset($category->img);
                    } else {
                        $img = asset('frontand/assets/img/normal/counter-image.jpg');
                    }

                    $title = $category->title ?? ($category->name ?? ($category->slug ?? 'تصنيف'));
                    $desc = $category->excerpt ?? ($category->description ?? '');

                    $count = $category->fatawas_count ?? ($category->fatawas()->where('status', 1)->count() ?? 0);
                    $countLabel = $count == 1 ? 'فتوى' : 'فتاوى';
                @endphp

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="blog-box style2 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                            <a href="{{ route('frontend.fatawas.category', $category->slug ?? $category->id) }}"
                                class="d-block">
                                <img src="{{ $img }}" alt="{{ e($title) }}"
                                    style="width:100%; height:100%; object-fit:cover;">
                            </a>
                        </div>

                        <div class="blog-wrapper p-3 ">
                            <span class="date">
                                <a href="{{ route('frontend.fatawas.category', $category->slug ?? $category->id) }}">
                                    {{ $count }} <span>{{ $countLabel }}</span>
                                </a>
                            </span>

                            <div class="blog-content mt-2">
                                <h3 class="box-title mb-2" style="font-size:1rem;">
                                    <a
                                        href="{{ route('frontend.fatawas.category', $category->slug ?? $category->id) }}">
                                        {{ e(\Illuminate\Support\Str::limit($title, 70)) }}
                                    </a>
                                </h3>


                                <a href="{{ route('frontend.fatawas.category', $category->slug ?? $category->id) }}"
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
