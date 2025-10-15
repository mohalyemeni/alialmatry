{{-- partial/frontend/header.blade.php --}}
@php
    // تأكد أن $siteSettings متاحة في الـ view
    // مثال: ['site_logo_light' => (object)['value'=>'...'], ...]
@endphp

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
                                    <a class="css_for_phone" href="tel:{{ $siteSettings['site_mobile']->value }}">
                                        {{ $siteSettings['site_mobile']->value }}
                                    </a>
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

    {{-- الشريط الرئيسي: نضع زر القائمة + زر البحث (للأجهزة الصغيرة) قبل الشعار --}}
    <div class="sticky-wrapper">
        <div class="menu-area" data-bg-src="{{ asset('frontand/assets/img/bg/pattern_bg_2.png') }}">
            <div class="container">
                <div class="row align-items-center justify-content-between back_spec_c">

                    {{-- عمود الأزرار (زر القائمة + زر البحث) يظهر قبل الشعار على الموبايل --}}
                    <div class="col-auto header-left d-flex align-items-center">
                        <!-- زر فتح القائمة (يظهر في الهواتف فقط) -->
                        <button type="button" class="th-menu-toggle d-inline-block d-lg-none me-2" aria-label="قائمة">
                            <i class="far fa-bars"></i>
                        </button>

                        <!-- زر البحث للجوال — يظهر فقط في الشاشات الصغيرة -->
                        <button type="button" class="mobile-search-header d-inline-block d-lg-none searchBoxToggler"
                            aria-label="بحث">
                            <i class="far fa-search"></i>
                        </button>
                    </div>

                    {{-- شعار الموقع --}}
                    <div class="col new_colore header-logo-col d-flex justify-content-center justify-content-lg-start">
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

                    {{-- القائمة الرئيسية (تظهر على الشاشات الكبيرة) --}}
                    <div class="col-auto ms-auto d-none d-lg-block header-menu-col">
                        <nav class="main-menu">
                            <ul>
                                <li><a href="{{ route('frontend.sheikh-intro') }}">نبذة الشيخ</a></li>
                                <li><a href="{{ route('frontend.videos.index') }}" class="ajax-link">المرئيات</a></li>
                                <li><a href="{{ route('frontend.audios.index') }}">الصوتيات</a></li>
                                <li><a href="{{ route('frontend.fatawas.index') }}">الفتاوى</a></li>
                                <li><a href="{{ route('frontend.blogs.index') }}" class="ajax-link">المقالات</a></li>
                                <li><a href="{{ route('frontend.books.index') }}">الكتب والمؤلفات</a></li>
                                <li><a href="{{ route('frontend.contact.form') }}">اتصل بنا</a></li>
                            </ul>
                        </nav>
                    </div>

                    {{-- أي أزرار إضافية على الجهة اليُمنى في الشاشات الكبيرة --}}
                    <div class="col-auto d-none d-xxl-block d-xl-block">
                        <div class="header-button">
                            <button type="button" class="icon-style2 searchBoxToggler d-none d-lg-inline-block"
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
            <div class="logo-shape"></div>
        </div>
    </div>
</header>

{{-- CSS محلي بسيط لصرف ترتيب العناصر على الموبايل وإخفاء البحث داخل الـ mobile menu --}}
<style>
    /* reorder on small screens: bring menu-toggle & search before logo */
    @media (max-width: 991.98px) {
        .header-left {
            order: 1;
        }

        .header-logo-col {
            order: 2;
        }

        .header-menu-col {
            order: 3;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .mobile-search-header {
            background: transparent;
            border: none;
            font-size: 1.05rem;
            padding: 6px;
        }
    }

    /* أخفوا عنصر البحث داخل الـ mobile menu لأنه الآن في الهيدر */
    @media (max-width: 991.98px) {
        .th-mobile-menu .mobile-search-item {
            display: none !important;
        }
    }
</style>
