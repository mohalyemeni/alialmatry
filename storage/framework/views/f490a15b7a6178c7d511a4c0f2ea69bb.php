<?php $__env->startSection('title', 'المرئيات'); ?>
<?php $__env->startSection('description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع'); ?>
<?php $__env->startSection('keywords', 'فيديوهات, مرئيات, موقعنا'); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.videos.index'))); ?>
<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_title', 'المرئيات'); ?>
<?php $__env->startSection('og_description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع'); ?>
<?php $__env->startSection('og_image', asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', route('frontend.videos.index')); ?>
<?php $__env->startSection('og_keywords', 'فيديوهات, مرئيات, موقعنا'); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', 'المرئيات'); ?>
<?php $__env->startSection('twitter_description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع'); ?>
<?php $__env->startSection('twitter_image', asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', 'فيديوهات, مرئيات, موقعنا'); ?>

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

    <div id="ajax-content">
        <?php echo $__env->make('frontend.partials.index_partial', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/videos/index.blade.php ENDPATH**/ ?>