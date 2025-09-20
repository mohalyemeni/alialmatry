<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @if (View::hasSection('title'))
            @yield('title') |
        @endif
        {{ $siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME')) }}
    </title>


    <meta name="author" content="{{ config('app.APP_AUTHER') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="description"
        content="{{ $siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME')) }}">
    <meta name="keywords"
        content="{{ $siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? config('app.APP_KEYWORDS')) }}">
    <meta name="robots" content="INDEX,FOLLOW">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="country" content="YEMEN - اليمن">
    <meta name="resource-type" content="DOCUMENT" />
    <meta name="distribution" content="Global" />
    <meta name="robots" content="INDEX, FOLLOW" />
    <meta name="revisit-after" content="1 days" />
    <meta name="rating" content="General" />
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $siteSettings['site_link_meta']->value ?? url()->current() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57"
        href="{{ asset('assets/site_settings/' . ($siteSettings['site_favicon']->value ?? 'favicon.png')) }}">
    <link rel="shortcut icon"
        href="{{ asset('assets/site_settings/' . ($siteSettings['site_favicon']->value ?? 'favicon.png')) }}"
        type="image/x-icon">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/css/custom.css') }}">

    @yield('style')

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name"
        content="{{ $siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME')) }}">
    <meta property="og:title"
        content="{{ $siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME')) }}">
    <meta property="og:description"
        content="{{ $siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME')) }}">
    <meta property="og:image"
        content="{{ asset('assets/site_settings/' . ($siteSettings['site_logo_light']->value ?? 'logo.png')) }}">
    <meta property="og:url" content="{{ $siteSettings['site_link_meta']->value ?? url()->current() }}">
    <meta property="og:keywords"
        content="{{ $siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? '') }}">


    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain"
        content="{{ parse_url($siteSettings['site_link_meta']->value ?? url()->current(), PHP_URL_HOST) }}">
    <meta property="twitter:site_name"
        content="{{ $siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME')) }}">
    <meta name="twitter:title"
        content="{{ $siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME')) }}">
    <meta name="twitter:description"
        content="{{ $siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME')) }}">
    <meta name="twitter:image"
        content="{{ asset('assets/site_settings/' . ($siteSettings['site_logo_light']->value ?? 'logo.png')) }}">
    <meta property="twitter:keywords"
        content="{{ $siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? '') }}">

    <style>
        .wa-float {
            position: fixed;
            right: 20px;
            bottom: 28px;
            width: 56px;
            height: 56px;
            z-index: 11000;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: auto;
        }

        .wa-float__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            text-decoration: none;
            position: relative;
            overflow: visible;
        }

        .wa-progress-svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .wa-progress-path {
            fill: none;
            stroke: #25D366;
            stroke-width: 4;
            stroke-linecap: round;
            transition: stroke-dashoffset 10ms linear;
        }

        .wa-icon {
            position: absolute;
            font-size: 30px;
            color: #ffffff;
            width: 36px;
            height: 36px;
            background: linear-gradient(180deg, #25D366, #128C7E);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(2, 6, 23, 0.18);
            pointer-events: none;
        }

        @media (max-width: 576px) {
            .wa-float {
                left: 12px;
                bottom: 22px;
                width: 50px;
                height: 50px;
            }

            .wa-icon {
                font-size: 18px;
                width: 32px;
                height: 32px;
            }
        }
    </style>
</head>



<body class="page-holder {{ request()->routeIs('frontend.detail') ? 'bg-light' : '' }}">

    @include('partial.frontend.side_menu_and_preloader')

    @include('partial.frontend.mobile_menu')

    @include('partial.frontend.header')

    <div>
        @yield('content')
    </div>

    @include('partial.frontend.footer')

    <div class="popup-search-box d-none d-lg-block">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" placeholder="إبحث هنا...">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>

    <script src="{{ asset('frontand/assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/SplitText.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/lenis.min.js') }}"></script>
    <script src="{{ asset('frontand/assets/js/wow.min.js') }}"></script>

    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>

    <div id="wa-float-root" class="wa-float" role="link" aria-label="افتح واتساب" title="مراسلتنا عبر واتساب">
        <a id="wa-float-link" class="wa-float__link" href="https://wa.me/PHONE_NUMBER?text=مرحباً" target="_blank"
            rel="noopener noreferrer">
            <svg class="wa-progress-svg" width="100%" height="100%" viewBox="-1 -1 102 102" aria-hidden="true"
                focusable="false">
                <path id="wa-progress-path" class="wa-progress-path" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98">
                </path>
            </svg>
            <i class="fab fa-whatsapp wa-icon" aria-hidden="true"></i>
        </a>
    </div>

    <script src="{{ asset('frontand/assets/js/main.js') }}"></script>

    @yield('script')

    <script>
        (function() {
            function onReady(fn) {
                if (document.readyState !== 'loading') fn();
                else document.addEventListener('DOMContentLoaded', fn);
            }

            onReady(function() {
                var waPath = document.getElementById('wa-progress-path');
                var waRoot = document.getElementById('wa-float-root');
                var waLink = document.getElementById('wa-float-link');

                if (!waPath || !waRoot || !waLink) return;

                var waLen = 307.919;
                try {
                    waLen = waPath.getTotalLength();
                } catch (e) {}
                waPath.style.strokeDasharray = waLen;
                waPath.style.strokeDashoffset = waLen;
                waPath.getBoundingClientRect();

                function updateWaProgress() {
                    var scroll = window.scrollY || window.pageYOffset;
                    var docHeight = Math.max(document.documentElement.scrollHeight, document.body
                        .scrollHeight) - window.innerHeight;
                    var progress = docHeight > 0 ? Math.min(1, scroll / docHeight) : 0;
                    var offset = waLen - (waLen * progress);
                    waPath.style.strokeDashoffset = offset;
                }

                updateWaProgress();
                window.addEventListener('scroll', updateWaProgress, {
                    passive: true
                });
                window.addEventListener('resize', updateWaProgress);
            });
        })();
    </script>

    <script>
        (() => {
            const containerSelector = '#ajax-content';
            const linkSelector = 'a.ajax-link, .pagination a';
            const loadingClass = 'is-loading';

            const container = document.querySelector(containerSelector);
            if (!container) return;

            function showLoading() {
                container.classList.add(loadingClass);
            }

            function hideLoading() {
                container.classList.remove(loadingClass);
            }

            function isLocalVideoLink(url) {
                try {
                    const u = new URL(url, location.origin);
                    return u.origin === location.origin && u.pathname.startsWith('/Videos');
                } catch (e) {
                    return false;
                }
            }

            async function loadUrl(url, {
                replace = false
            } = {}) {
                showLoading();
                try {
                    const resp = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    });

                    if (!resp.ok) {
                        window.location.href = url;
                        return;
                    }
                    const data = await resp.json();
                    if (!data.html) {
                        window.location.href = url;
                        return;
                    }

                    container.innerHTML = data.html;

                    if (data.title) document.title = data.title;

                    if (data.url) {
                        if (replace) {
                            history.replaceState({
                                ajax: true
                            }, data.title || '', data.url);
                        } else {
                            history.pushState({
                                ajax: true
                            }, data.title || '', data.url);
                        }
                    } else if (!replace) {
                        history.pushState({
                            ajax: true
                        }, data.title || '', url);
                    }

                    const firstHeading = container.querySelector('h1, h2, h3');
                    if (firstHeading) {
                        firstHeading.setAttribute('tabindex', '-1');
                        firstHeading.focus();
                    }
                } catch (err) {
                    console.error('AJAX navigation failed', err);
                    window.location.href = url;
                } finally {
                    hideLoading();
                }
            }

            document.addEventListener('click', function(e) {
                const a = e.target.closest(linkSelector);
                if (!a) return;

                const href = a.getAttribute('href');
                if (!href) return;

                if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey || a.target === '_blank') return;

                if (!isLocalVideoLink(href)) return;

                e.preventDefault();
                loadUrl(href);
            });

            window.addEventListener('popstate', function(ev) {
                loadUrl(location.href, {
                    replace: true
                });
            });
        })();
    </script>
</body>

</html>
