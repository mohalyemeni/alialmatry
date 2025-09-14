@if (isset($intro) && $intro)
    <section class="overflow-hidden bg-white position-relative pt-30 my-animation theme_overlay_new" id="blog-sec">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12">
                    <div class="blog-grid style2">
                        <div class="blog-img blog-img1 global-img wow fadeInLeft" data-wow-delay=".3s">
                            @php
                                $img = $intro->img ?? asset('frontand/assets/img/team/nobtha.jpg');
                            @endphp
                            <img src="{{ $img }}" alt="{{ e($intro->title ?? 'sheikh') }}">
                        </div>
                        <div class="box-content">
                            @if (!empty($intro->title))
                                <h3 class="box-title wow fadeInRight" data-wow-delay=".4s">
                                    <a href="{{ route('frontend.sheikh-intro', $intro->slug ?? $intro->id) }}">
                                        {{ \Illuminate\Support\Str::limit(e($intro->title), 50) }}
                                    </a>
                                </h3>
                            @endif

                            <h6 class="box-who wow fadeInRight" data-wow-delay=".5s">من نحن</h6>

                            @if (!empty($intro->excerpt))
                                <p class="box-text wow fadeInUp color" data-wow-delay=".6s">
                                    {!! $intro->excerpt !!}
                                </p>
                            @endif

                            <a href="{{ route('frontend.sheikh-intro', $intro->slug ?? $intro->id) }}"
                                class="th-btn wow fadeInUp" data-wow-delay=".7s">
                                <span class="btn-text" data-back="اقرأ المزيد" data-front="اقرأ المزيد"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
