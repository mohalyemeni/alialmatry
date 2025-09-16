<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">المرئيات</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">المرئيات</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow" data-wow-delay=".3s">
            الدرر السنية
        </h3>

        <?php if($durars->count()): ?>
            <div class="row gy-4">
                <?php $__currentLoopData = $durars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="event-card event-card1 wow fadeInUp" data-wow-delay=".3s">
                            <div class="box-img global-img box-img1">
                                <?php
                                    $img =
                                        $d->img && file_exists(public_path('assets/durar_diniya/images/' . $d->img))
                                            ? asset('assets/durar_diniya/images/' . $d->img)
                                            : asset('frontand/assets/img/normal/counter-image.jpg');
                                ?>
                                <a href="<?php echo e(route('frontend.durars.show', $d->slug)); ?>">
                                    <img src="<?php echo e($img); ?>" alt="<?php echo e(e($d->title)); ?>" class="durar-img">
                                </a>
                            </div>

                            <div class="box-content">
                                <h3 class="box-title">
                                    <a href="<?php echo e(route('frontend.durars.show', $d->slug)); ?>">
                                        <?php echo e(e(\Illuminate\Support\Str::limit($d->title, 60))); ?>

                                    </a>
                                </h3>

                                <div class="event-meta">
                                    <?php if($d->published_on): ?>
                                        <a href="<?php echo e(route('frontend.durars.show', $d->slug)); ?>">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <?php echo e(\Carbon\Carbon::parse($d->published_on)->format('M d, Y')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>

                                <p class="text-muted mb-3">
                                    <?php echo e(e(\Illuminate\Support\Str::limit(strip_tags($d->excerpt), 120))); ?>

                                </p>

                                <a href="<?php echo e(route('frontend.durars.show', $d->slug)); ?>" class="th-btn">
                                    <span class="btn-text" data-back="قراءة" data-front="قراءة"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-4">
                <?php echo e($durars->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-muted">لا توجد درر لعرضها حالياً.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/durars/index.blade.php ENDPATH**/ ?>