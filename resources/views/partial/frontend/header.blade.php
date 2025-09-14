<!--==============================
منطقة الرأس (الهيدر)
==============================-->
<header class="th-header  header-layout5">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-md-between align-items-center gy-2">
                <div class="col-auto d-none d-md-block">
                    <div class="header-links">
                        <ul>
                            <li><i class="far fa-phone"></i><a href="tel:+1044123456789">+967779531500</a></li>
                            <li class="d-none d-xl-inline-block"><i class="far fa-location-dot"></i>اليمن - اب - ذي السفال
                            </li>
                            <li><i class="far fa-envelope"></i><a
                                    href="mailto:infomail123@domain.com">contact@sh-alialmatry.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li class="d-none d-lg-inline-block">

                            </li>
                            <li>
                                <div class="header-social">
                                    <span class="social-title">تابعنا:</span>
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
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
                    <div class="col-9 col-md-10 col-lg-3">
                        <div class="header-logo">
                            <a href="{{ route('frontend.index') }}" class="logo_img">
                                <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="توبة">
                            </a>
                        </div>
                    </div>
                    <div class="col-3 col-md-2 col-lg-9">
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-xl-10">
                                <nav class="main-menu d-none d-lg-inline-block ml-10">
                                    <ul>
                                        <li><a href="{{ route('frontend.sheikh-intro') }}"> نبذة الشيخ</a></li>
                                        <li><a href="{{ route('frontend.videos.index') }}" class="ajax-link">
                                                المرئيات</a></li>
                                        <li><a href="{{ route('frontend.audios.index') }}"> الصوتيات</a></li>
                                        <li><a href="{{ route('frontend.fatawas.index') }}"> الفتاوى</a></li>

                                        <li><a href="{{ route('frontend.blogs.index') }}" class="ajax-link">
                                                المقالات</a></li>
                                        <li><a href="{{ route('frontend.books.index') }}"> الكتب والؤلفات</a></li>
                                        <li><a href="contact.html"> اتصل بنا</a></li>
                                    </ul>
                                </nav>
                                <button type="button" class="th-menu-toggle  d-inline-block d-lg-none">
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
