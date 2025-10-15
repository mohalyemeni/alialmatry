<!--==============================
منطقة الرأس (الهيدر)
==============================-->
<header class="th-header header-layout5">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-md-between align-items-center gy-2">
                <div class="col-auto d-none d-md-block">
                    <div class="header-links">
                        <ul>
                            @if (isset($siteSettings['site_mobile']->value) && $siteSettings['site_mobile']->value)
                                <li>
                                    <i class="far fa-phone"></i>
                                    <a class="css_for_phone"
                                        href="tel:{{ $siteSettings['site_mobile']->value }}">{{ $siteSettings['site_mobile']->value }}</a>
                                </li>
                            @endif

                            @if (isset($siteSettings['site_address']->value) && $siteSettings['site_address']->value)
                                <li class="d-none d-xl-inline-block">
                                    <i class="far fa-location-dot"></i>{{ $siteSettings['site_address']->value }}
                                </li>
                            @endif

                            @if (isset($siteSettings['site_email']->value) && $siteSettings['site_email']->value)
                                <li>
                                    <i class="far fa-envelope"></i>
                                    <a
                                        href="mailto:{{ $siteSettings['site_email']->value }}">{{ $siteSettings['site_email']->value }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li class="d-none d-lg-inline-block"></li>
                            <li>
                                <div class="header-social">
                                    <span class="social-title">تابعنا:</span>

                                    @php
                                        $socials = [
                                            'site_facebook' => 'fab fa-facebook-f',
                                            'site_twitter' => 'fab fa-twitter',
                                            'site_instagram' => 'fab fa-instagram',
                                            'site_snapchat' => 'fab fa-snapchat-ghost',
                                            'site_youtube' => 'fab fa-youtube',
                                            'site_whatsapp' => 'fab fa-whatsapp',
                                            'site_linkedin' => 'fab fa-linkedin',
                                        ];
                                    @endphp

                                    @foreach ($socials as $key => $icon)
                                        @php
                                            $url = isset($siteSettings[$key])
                                                ? trim($siteSettings[$key]->value ?? '')
                                                : '';
                                        @endphp

                                        @if ($url && $url !== '#' && $url !== '0')
                                            <a href="{{ $url }}" target="_blank">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <div class="menu-area" data-bg-src="{{ asset('frontand/assets/img/bg/pattern_bg_2.png') }}">
            <div class="container">
                <div class="row align-items-center justify-content-between back_spec_c">
                    <div class="col-8 col-md-10 col-lg-3 new_colore order-2 order-lg-1">
                        <div class="header-logo d-flex align-items-center justify-content-end">
                            <!-- Mobile search button (visible on mobile only) -->


                            <a href="{{ route('frontend.index') }}" class="logo_img">
                                @if (isset($siteSettings['site_logo_light']->value) && $siteSettings['site_logo_light']->value)
                                    <img src="{{ asset('assets/site_settings/' . $siteSettings['site_logo_light']->value) }}"
                                        alt="{{ $siteSettings['site_name']->value ?? 'شعار الموقع' }}">
                                @else
                                    <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="شعار الموقع">
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="col-4 col-md-2 col-lg-9 order-1 order-lg-2">
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-xl-10">
                                <nav class="main-menu d-none d-lg-inline-block ml-10">
                                    <ul>
                                        <li><a href="{{ route('frontend.sheikh-intro') }}"> نبذة الشيخ</a></li>
                                        <li><a href="{{ route('frontend.videos.index') }}"
                                                class="ajax-link">المرئيات</a></li>
                                        <li><a href="{{ route('frontend.audios.index') }}"> الصوتيات</a></li>
                                        <li><a href="{{ route('frontend.fatawas.index') }}"> الفتاوى</a></li>
                                        <li><a href="{{ route('frontend.blogs.index') }}"
                                                class="ajax-link">المقالات</a></li>
                                        <li><a href="{{ route('frontend.books.index') }}"> الكتب والؤلفات</a></li>
                                        <li><a href="{{ route('frontend.contact.form') }}">اتصل بنا</a></li>
                                    </ul>
                                </nav>
                                <!-- mobile hamburger (visible on mobile) -->
                                <div class="header-button">
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none">
                                        <i class="far fa-bars"></i>
                                    </button>
                                    <button type="button"
                                        class="icon-style2 searchBoxToggler d-inline-flex d-lg-none mobile-header-search me-2"
                                        aria-label="بحث">
                                        <i class="far fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-2 d-none d-xxl-block d-xl-block">
                                <div class="header-button">
                                    <!-- Desktop search button (visible on lg and up) -->
                                    <button type="button"
                                        class="icon-style2 searchBoxToggler d-none d-lg-inline-block search-on-desktop"
                                        aria-label="بحث">
                                        <i class="far fa-search"></i>
                                    </button>

                                    <a href="#" class="icon-btn sideMenuToggler d-none d-lg-block">
                                        <img src="{{ asset('frontand/assets/img/icon/grid.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-shape"></div>
        </div>
    </div>
</header>

<style>
    .mobile-header-search {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.06);
        background: transparent;
        font-weight: 600;
        gap: 8px;
    }
</style>
