@php
    use Illuminate\Support\Str;
@endphp

@if (isset($sliders) && $sliders->count())
    <section class="">
        <div class="th-hero-wrapper hero-6 custom-hero-height" id="hero">
            <div class="swiper th-slider hero-slider-6"
                data-slider-options='{"effect":"fade","loop":true,"autoplay":{"delay":5000}}'>
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slide)
                        @php
                            $defaultBg = asset('frontand/assets/img/hero/hero_5_1.jpg');

                            $imgPath = $defaultBg;
                            if (!empty($slide->img)) {
                                if (\Illuminate\Support\Str::startsWith($slide->img, ['http://', 'https://'])) {
                                    $imgPath = $slide->img;
                                } elseif (file_exists(public_path($slide->img))) {
                                    $imgPath = asset($slide->img);
                                } elseif (file_exists(public_path('assets/main_sliders/' . $slide->img))) {
                                    $imgPath = asset('assets/main_sliders/' . $slide->img);
                                } else {
                                    $imgPath = $slide->img;
                                }
                            }

                            $title = $slide->title ?? null;
                            $description = $slide->description ?? null;
                            $btnTitle = $slide->btn_title ?? null;
                            $btnUrl = $slide->url ?? null;
                            $target = $slide->target ?? '_self';
                            $showBtn = isset($slide->show_btn_title) ? (bool) $slide->show_btn_title : true;
                            $playUrl = $slide->play_url ?? null;
                        @endphp

                        <div class="swiper-slide">
                            <div class="hero-inner">
                                <div class="container th-container">
                                    <div class="th-hero-bg" data-bg-src="{{ $imgPath }}" role="img"
                                        aria-label="{{ e($title ?? 'slider-image') }}"></div>

                                    <div class="row align-items-center">
                                        <div class="col-xl-9">
                                            <div class="hero-style6 text-end">
                                                <span class="sub-title" data-ani="slideindown" data-ani-delay="0.2s">
                                                    <img src="{{ asset('frontand/assets/img/theme-img/sub-title-2.svg') }}"
                                                        alt="">
                                                </span>

                                                @if (!empty($title))
                                                    <h2 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">
                                                        {{ \Illuminate\Support\Str::limit(e($title), 120) }}
                                                    </h2>
                                                @endif

                                                @if (!empty($description))
                                                    <p class="hero-text" data-ani="slideinup" data-ani-delay="0.6s">
                                                        {!! \Illuminate\Support\Str::limit(strip_tags($description), 200) !!}
                                                    </p>
                                                @endif

                                                <div class="btn-group" data-ani="slideinup" data-ani-delay="0.8s">
                                                    @if ($showBtn && !empty(trim((string) $btnTitle)) && !empty(trim((string) $btnUrl)))
                                                        <a href="{{ e($btnUrl) }}" class="th-btn"
                                                            target="{{ e($target) }}"
                                                            @if ($target === '_blank') rel="noopener noreferrer" @endif>
                                                            <span class="btn-text" data-back="{{ e($btnTitle) }}"
                                                                data-front="{{ e($btnTitle) }}"></span>
                                                        </a>
                                                    @endif

                                                    @if (!empty($playUrl))
                                                        <a href="{{ e($playUrl) }}"
                                                            class="th-btn border-btn popup-video">
                                                            <i class="fas fa-play"></i> استمع للقرآن الكريم
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="slider-controller">
                    <div class="slider-pagination"></div>
                </div>

                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="">
        <div class="th-hero-wrapper hero-6 custom-hero-height" id="hero">
            <div class="swiper th-slider hero-slider-6"
                data-slider-options='{"effect":"fade","loop":true,"autoplay":{"delay":5000}}'>
                <div class="swiper-wrapper">
                    @php
                        $imgPath = asset('frontand/test.jpg');
                        $title = 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري';
                        $description = 'مرحبا';
                    @endphp

                    <div class="swiper-slide">
                        <div class="hero-inner">
                            <div class="container th-container">
                                <div class="th-hero-bg th-hero-bg1" data-bg-src="{{ $imgPath }}" role="img"
                                    aria-label="{{ e($title) }}"></div>

                                <div class="row align-items-center">
                                    <div class="col-xl-9">
                                        <div class="hero-style6 text-end">
                                            <span class="sub-title" data-ani="slideindown" data-ani-delay="0.2s">
                                                <img src="{{ asset('frontand/assets/img/theme-img/sub-title-2.svg') }}"
                                                    alt="">
                                            </span>

                                            <h2 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">
                                                {{ \Illuminate\Support\Str::limit(e($title), 120) }}
                                            </h2>

                                            <p class="hero-text" data-ani="slideinup" data-ani-delay="0.6s">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($description), 200) !!}
                                            </p>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="slider-controller">
                    <div class="slider-pagination"></div>
                </div>


            </div>
        </div>
    </section>
@endif

@push('scripts')
    <script>
        (function() {

            document.querySelectorAll('.th-hero-bg').forEach(function(el) {
                const bg = el.getAttribute('data-bg-src');
                if (bg) {
                    el.style.backgroundImage = 'url(' + bg + ')';
                    el.style.backgroundSize = 'cover';
                    el.style.backgroundPosition = 'center center';
                    el.style.minHeight = '300px';
                }
            });

            if (typeof Swiper !== 'undefined') {

                new Swiper('.th-slider.hero-slider-6', {
                    effect: 'fade',
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.slider-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },

                });
            } else {
                console.warn("Swiper not loaded - slider won't be initialized.");
            }
        })();
    </script>
@endpush
