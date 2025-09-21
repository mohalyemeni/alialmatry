<?php
    use Illuminate\Support\Str;
?>

<?php if(isset($sliders) && $sliders->count()): ?>
    <section class="">
        <div class="th-hero-wrapper hero-6 custom-hero-height" id="hero">
            <div class="swiper th-slider hero-slider-6"
                data-slider-options='{"effect":"fade","loop":true,"autoplay":{"delay":5000}}'>
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
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
                        ?>

                        <div class="swiper-slide">
                            <div class="hero-inner">
                                <div class="container th-container">
                                    <div class="th-hero-bg" data-bg-src="<?php echo e($imgPath); ?>" role="img"
                                        aria-label="<?php echo e(e($title ?? 'slider-image')); ?>"></div>

                                    <div class="row align-items-center">
                                        <div class="col-xl-9">
                                            <div class="hero-style6 text-end">
                                                <span class="sub-title" data-ani="slideindown" data-ani-delay="0.2s">
                                                    <img src="<?php echo e(asset('frontand/assets/img/theme-img/sub-title-2.svg')); ?>"
                                                        alt="">
                                                </span>

                                                <?php if(!empty($title)): ?>
                                                    <h2 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">
                                                        <?php echo e(\Illuminate\Support\Str::limit(e($title), 120)); ?>

                                                    </h2>
                                                <?php endif; ?>

                                                <?php if(!empty($description)): ?>
                                                    <p class="hero-text" data-ani="slideinup" data-ani-delay="0.6s">
                                                        <?php echo \Illuminate\Support\Str::limit(strip_tags($description), 200); ?>

                                                    </p>
                                                <?php endif; ?>

                                                <div class="btn-group" data-ani="slideinup" data-ani-delay="0.8s">
                                                    <?php if($showBtn && !empty(trim((string) $btnTitle)) && !empty(trim((string) $btnUrl))): ?>
                                                        <a href="<?php echo e(e($btnUrl)); ?>" class="th-btn"
                                                            target="<?php echo e(e($target)); ?>"
                                                            <?php if($target === '_blank'): ?> rel="noopener noreferrer" <?php endif; ?>>
                                                            <span class="btn-text" data-back="<?php echo e(e($btnTitle)); ?>"
                                                                data-front="<?php echo e(e($btnTitle)); ?>"></span>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if(!empty($playUrl)): ?>
                                                        <a href="<?php echo e(e($playUrl)); ?>"
                                                            class="th-btn border-btn popup-video">
                                                            <i class="fas fa-play"></i> استمع للقرآن الكريم
                                                        </a>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php else: ?>
    <section class="">
        <div class="th-hero-wrapper hero-6 custom-hero-height" id="hero">
            <div class="swiper th-slider hero-slider-6"
                data-slider-options='{"effect":"fade","loop":true,"autoplay":{"delay":5000}}'>
                <div class="swiper-wrapper">
                    <?php
                        $imgPath = asset('frontand/test.jpg');
                        $title = 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري';
                        $description = 'مرحبا';
                    ?>

                    <div class="swiper-slide">
                        <div class="hero-inner">
                            <div class="container th-container">
                                <div class="th-hero-bg th-hero-bg1" data-bg-src="<?php echo e($imgPath); ?>" role="img"
                                    aria-label="<?php echo e(e($title)); ?>"></div>

                                <div class="row align-items-center">
                                    <div class="col-xl-9">
                                        <div class="hero-style6 text-end">
                                            <span class="sub-title" data-ani="slideindown" data-ani-delay="0.2s">
                                                <img src="<?php echo e(asset('frontand/assets/img/theme-img/sub-title-2.svg')); ?>"
                                                    alt="">
                                            </span>

                                            <h2 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">
                                                <?php echo e(\Illuminate\Support\Str::limit(e($title), 120)); ?>

                                            </h2>

                                            <p class="hero-text" data-ani="slideinup" data-ani-delay="0.6s">
                                                <?php echo \Illuminate\Support\Str::limit(strip_tags($description), 200); ?>

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
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/sections/slider.blade.php ENDPATH**/ ?>