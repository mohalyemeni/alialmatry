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
                                    <a
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
                                        ];
                                    @endphp

                                    @foreach ($socials as $key => $icon)
                                        @if (isset($siteSettings[$key]->value) && $siteSettings[$key]->value)
                                            <a href="{{ $siteSettings[$key]->value }}" target="_blank">
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
                <div class="row align-items-center justify-content-between">
                    <div class="col-9 col-md-10 col-lg-3 new_colore">
                        <div class="header-logo">
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
                    <div class="col-3 col-md-2 col-lg-9">
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
                                        <li><a href="contact.html"> اتصل بنا</a></li>
                                    </ul>
                                </nav>
                                <button type="button" class="th-menu-toggle d-inline-block d-lg-none">
                                    <i class="far fa-bars"></i>
                                </button>
                            </div>
                            <div class="col-2 d-none d-xxl-block d-xl-block">
                                <div class="header-button">
                                    <button type="button" class="icon-style2 searchBoxToggler">
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
