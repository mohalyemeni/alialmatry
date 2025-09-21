<footer class="footer-wrapper footer-layout1">
    <div class="container">
        <div class="footer-top">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="title-area mb-0 text-center text-lg-start">
                        <span class="subtitle"> هل الهمك المحتوى ؟ أنضم الينا الان</span>
                        <h2 class="sec-title">كن جزء من مجتمعنا</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-top-btn">
                        <div class="btn-group justify-content-center justify-content-lg-end">
                            <a href="contact.html" class="th-btn">
                                <span class="btn-text" data-back="انضم للمجتمع" data-front="انضم للمجتمع"></span>
                            </a>
                            <a href="contact.html" class="th-btn style2 th-btn12">
                                <span class="btn-text" data-back="تحميل التطبيق" data-front="تحميل التطبيق"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="line">
    </div>
    <div class="widget-area pt-0 pb-0">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xxl-4 col-xl-4">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="index.html">
                                    <?php if(isset($siteSettings['site_logo_dark']->value) && $siteSettings['site_logo_dark']->value): ?>
                                        <img src="<?php echo e(asset('assets/site_settings/' . $siteSettings['site_logo_dark']->value)); ?>"
                                            alt="<?php echo e($siteSettings['site_name']->value ?? 'شعار الموقع'); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('frontand/assets/img/top-logo.png')); ?>" alt="tawba">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <p class="about-text">
                                <?php echo e($siteSettings['site_description']->value ?? 'تاريخ الإسلام شاهد على مرونة الحضارة الإسلامية وتأثيرها العميق، وهو قصة إيمان وابتكار ومساهمات دائمة للبشرية.'); ?>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4 col-xl-4">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <h3 class="widget_title text-center"> وسائل التواصل</h3>
                            <div class="th-social text-center">
                                <?php if(isset($siteSettings['site_facebook']->value) && $siteSettings['site_facebook']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_facebook']->value); ?>"><i
                                            class="fab fa-facebook-f"></i></a>
                                <?php endif; ?>

                                <?php if(isset($siteSettings['site_twitter']->value) && $siteSettings['site_twitter']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_twitter']->value); ?>"><i
                                            class="fab fa-twitter"></i></a>
                                <?php endif; ?>

                                <?php if(isset($siteSettings['site_instagram']->value) && $siteSettings['site_instagram']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_instagram']->value); ?>"><i
                                            class="fab fa-instagram"></i></a>
                                <?php endif; ?>

                                <?php if(isset($siteSettings['site_whatsapp']->value) && $siteSettings['site_whatsapp']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_whatsapp']->value); ?>"><i
                                            class="fab fa-whatsapp"></i></a>
                                <?php endif; ?>

                                <?php if(isset($siteSettings['site_youtube']->value) && $siteSettings['site_youtube']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_youtube']->value); ?>" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(isset($siteSettings['site_linkedin']->value) && $siteSettings['site_linkedin']->value): ?>
                                    <a href="<?php echo e($siteSettings['site_linkedin']->value); ?>" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="row mb-4  pt-25">
                                <div class="col-lg-6 col-md-6 col-sm-6 footer-widget">
                                    <div class="counter-item text-center">
                                        <a href=""><img class="image"
                                                src="<?php echo e(asset('frontand/assets/img/google.png')); ?>" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 footer-widget">
                                    <div class="counter-item text-center">
                                        <a href=""> <img class="image"
                                                src="<?php echo e(asset('frontand/assets/img/apple.png')); ?>" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="widget widget_nav_menu footer-widget email">
                        <h3 class="widget_title"> كما يسعدنا تواصلكم معنا</h3>
                        <?php if(isset($siteSettings['site_mobile']->value) && $siteSettings['site_mobile']->value): ?>
                            <p class="about-text">للتواصل عبر الهاتف المحمول :
                                <?php echo e($siteSettings['site_mobile']->value); ?></p>
                        <?php endif; ?>

                        <?php if(isset($siteSettings['site_email']->value) && $siteSettings['site_email']->value): ?>
                            <p class="about-text"> ويسعدنا التواصل معكم عبر البريد الالكتروني :<a
                                    href="mailto:<?php echo e($siteSettings['site_email']->value); ?>">
                                    <?php echo e($siteSettings['site_email']->value); ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- حقوق النشر -->
    <div class="container">
        <div class="copyright-wrap">
            <div class="row gy-2 align-items-center">
                <div class="col-lg-6">
                    <p class="copyright-text">
                        حقوق النشر <i class="fal fa-copyright"></i> <?php echo e(date('Y')); ?>

                        <a
                            href="<?php echo e($siteSettings['site_link']->value ?? '#'); ?>"><?php echo e($siteSettings['site_name']->value ?? 'موقع فضيلة الشيخ ابو الحسن علي بن محمد بن عبده المطري'); ?></a>.
                        جميع الحقوق محفوظة.
                    </p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <div class="footer-links">
                        <ul>
                            <li><a href="#">شروط الخدمة</a></li>
                            <li><a href="#">سياسة الخصوصية</a></li>
                            <li><a href="#">ملفات تعريف الارتباط</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/partial/frontend/footer.blade.php ENDPATH**/ ?>