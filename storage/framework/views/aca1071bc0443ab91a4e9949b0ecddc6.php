<?php $__env->startSection('title', $category->title ?? 'المرئيات'); ?>
<?php $__env->startSection('description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات')); ?>
<?php $__env->startSection('keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? '')); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.videos.category', $category->slug ?? ''))); ?>

<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_title', $category->title ?? 'المرئيات'); ?>
<?php $__env->startSection('og_description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات')); ?>
<?php $__env->startSection('og_image', $category->img ? asset('assets/video_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.videos.category', $category->slug ?? ''))); ?>
<?php $__env->startSection('og_keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? '')); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', $category->title ?? 'المرئيات'); ?>
<?php $__env->startSection('twitter_description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات')); ?>
<?php $__env->startSection('twitter_image', $category->img ? asset('assets/video_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? '')); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e($category->title ?? 'المرئيات'); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.videos.index')); ?>"
                            class="text-white">المرئيات</a></li>
                    <?php if(isset($category)): ?>
                        <li class="list-inline-item"><?php echo e($category->title); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div id="ajax-content">
        <?php echo $__env->make('frontend.partials.category_partial', [
            'category' => $category,
            'videos' => $videos,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/videos/category.blade.php ENDPATH**/ ?>