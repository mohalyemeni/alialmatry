<?php $__env->startSection('title', 'نبذة عن الشيخ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(__('panel.sheikh_intro')); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>"
                            class="text-white"><?php echo e(__('panel.home')); ?></a></li>
                    <li class="list-inline-item"><?php echo e(__('panel.sheikh_intro')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="overflow-hidden bg-white position-relative pt-30 my-animation theme_overlay" id="sheikh-intro-sec">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <?php if($sheikhIntro): ?>
                    <div class="col-12">
                        <div class="blog-grid style2">
                            <div class="blog-img blog-img1 global-img wow fadeInLeft" data-wow-delay=".3s">
                                <img src="<?php echo e($sheikhIntro->img ? asset('assets/sheikh_intro/images/' . $sheikhIntro->img) : asset('frontand/assets/img/team/default.png')); ?>"
                                    alt="<?php echo e($sheikhIntro->title); ?>">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title wow fadeInRight" data-wow-delay=".4s">
                                    <?php echo e($sheikhIntro->title); ?>

                                </h3>
                                <p class="box-text wow fadeInUp" data-wow-delay=".6s">
                                    <?php echo $sheikhIntro->description; ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-12">
                        <p><?php echo e(__('panel.intro')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/sheikh_intro/index.blade.php ENDPATH**/ ?>