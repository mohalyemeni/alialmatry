<?php $__env->startSection('title', 'الفتاوى'); ?>
<?php $__env->startSection('description', 'عرض آخر الفتاوى المتاحة على الموقع'); ?>
<?php $__env->startSection('keywords', 'فتاوى, أسئلة شرعية, موقعنا'); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.fatawas.index'))); ?>
<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_title', 'الفتاوى'); ?>
<?php $__env->startSection('og_description', 'عرض آخر الفتاوى المتاحة على الموقع'); ?>
<?php $__env->startSection('og_image', asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', route('frontend.fatawas.index')); ?>
<?php $__env->startSection('og_keywords', 'فتاوى, أسئلة شرعية, موقعنا'); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', 'الفتاوى'); ?>
<?php $__env->startSection('twitter_description', 'عرض آخر الفتاوى المتاحة على الموقع'); ?>
<?php $__env->startSection('twitter_image', asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', 'فتاوى, أسئلة شرعية, موقعنا'); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">الفتاوى</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">الفتاوى</li>
                </ul>
            </div>
        </div>
    </div>

    <?php echo $__env->make('frontend.fatawas.partials.index_partial', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/fatawas/index.blade.php ENDPATH**/ ?>