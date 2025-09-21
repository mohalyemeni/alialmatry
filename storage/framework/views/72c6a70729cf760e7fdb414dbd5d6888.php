<?php if(isset($intro) && $intro): ?>
    <section class="overflow-hidden bg-white position-relative pt-30 my-animation theme_overlay_new" id="blog-sec">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12">
                    <div class="blog-grid style2">
                        <div class="blog-img blog-img1 global-img wow fadeInLeft" data-wow-delay=".3s">
                            <?php
                                $img = $intro->img ?? asset('frontand/assets/img/team/nobtha.jpg');
                            ?>
                            <img src="<?php echo e($img); ?>" alt="<?php echo e(e($intro->title ?? 'sheikh')); ?>">
                        </div>
                        <div class="box-content">
                            <?php if(!empty($intro->title)): ?>
                                <h3 class="box-title wow fadeInRight" data-wow-delay=".4s">
                                    <a href="<?php echo e(route('frontend.sheikh-intro', $intro->slug ?? $intro->id)); ?>">
                                        <?php echo e(\Illuminate\Support\Str::limit(e($intro->title), 50)); ?>

                                    </a>
                                </h3>
                            <?php endif; ?>

                            <h6 class="box-who wow fadeInRight" data-wow-delay=".5s">من نحن</h6>

                            <?php if(!empty($intro->excerpt)): ?>
                                <p class="box-text wow fadeInUp color" data-wow-delay=".6s">
                                    <?php echo $intro->excerpt; ?>

                                </p>
                            <?php endif; ?>

                            <a href="<?php echo e(route('frontend.sheikh-intro', $intro->slug ?? $intro->id)); ?>"
                                class="th-btn wow fadeInUp" data-wow-delay=".7s">
                                <span class="btn-text" data-back="اقرأ المزيد" data-front="اقرأ المزيد"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/sections/description.blade.php ENDPATH**/ ?>