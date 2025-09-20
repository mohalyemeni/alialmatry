<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        <?php echo e(trim(strip_tags($siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME'))))); ?>

        <?php if(View::hasSection('title')): ?>
            | <?php echo $__env->yieldContent('title'); ?>
        <?php endif; ?>
    </title>

    <meta name="author" content="<?php echo $__env->yieldContent('author', config('app.APP_AUTHER')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="description" content="<?php echo $__env->yieldContent('description', trim(strip_tags($siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME'))))); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', trim(strip_tags($siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? config('app.APP_KEYWORDS'))))); ?>">

    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="country" content="YEMEN - اليمن">
    <meta name="resource-type" content="DOCUMENT" />
    <meta name="distribution" content="Global" />
    <meta name="robots" content="INDEX, FOLLOW" />
    <meta name="revisit-after" content="1 days" />
    <meta name="rating" content="General" />

    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:site_name" content="<?php echo $__env->yieldContent('og_site_name', trim(strip_tags($siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME'))))); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', trim(strip_tags($siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME'))))); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', trim(strip_tags($siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME'))))); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('assets/site_settings/' . ($siteSettings['site_logo_light']->value ?? 'logo.png'))); ?>">
    <meta property="og:url" content="<?php echo $__env->yieldContent('og_url', url()->current()); ?>">
    <meta property="og:keywords" content="<?php echo $__env->yieldContent('og_keywords', trim(strip_tags($siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? '')))); ?>">

    <meta name="twitter:card" content="<?php echo $__env->yieldContent('twitter_card', 'summary_large_image'); ?>">
    <meta property="twitter:domain" content="<?php echo $__env->yieldContent('twitter_domain', parse_url(url()->current(), PHP_URL_HOST)); ?>">
    <meta property="twitter:site_name" content="<?php echo $__env->yieldContent('twitter_site_name', trim(strip_tags($siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME'))))); ?>">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', trim(strip_tags($siteSettings['site_name_meta']->value ?? ($siteSettings['site_name']->value ?? config('app.APP_NAME'))))); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', trim(strip_tags($siteSettings['site_description_meta']->value ?? ($siteSettings['site_description']->value ?? config('app.APP_NAME'))))); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', asset('assets/site_settings/' . ($siteSettings['site_logo_light']->value ?? 'logo.png'))); ?>">
    <meta property="twitter:keywords" content="<?php echo $__env->yieldContent('twitter_keywords', trim(strip_tags($siteSettings['site_keywords_meta']->value ?? ($siteSettings['site_keywords']->value ?? '')))); ?>">

    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
    <link rel="apple-touch-icon" sizes="57x57"
        href="<?php echo e(asset('assets/site_settings/' . ($siteSettings['site_favicon']->value ?? 'favicon.png'))); ?>">
    <link rel="shortcut icon"
        href="<?php echo e(asset('assets/site_settings/' . ($siteSettings['site_favicon']->value ?? 'favicon.png'))); ?>"
        type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/magnific-popup.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/swiper-bundle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/fonts/feather-font/css/iconfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/css/custom.css')); ?>">

    <?php echo $__env->yieldContent('style'); ?>


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

<body class="page-holder <?php echo e(request()->routeIs('frontend.detail') ? 'bg-light' : ''); ?>">

    <?php echo $__env->make('partial.frontend.side_menu_and_preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partial.frontend.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partial.frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('partial.frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="popup-search-box d-none d-lg-block">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" placeholder="إبحث هنا...">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>

    <script src="<?php echo e(asset('frontand/assets/js/vendor/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/circle-progress.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/imagesloaded.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/gsap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/ScrollTrigger.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/SplitText.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/lenis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontand/assets/js/wow.min.js')); ?>"></script>

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

    <script src="<?php echo e(asset('frontand/assets/js/main.js')); ?>"></script>

    <?php echo $__env->yieldContent('script'); ?>

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
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/layouts/app.blade.php ENDPATH**/ ?>