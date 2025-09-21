<?php $__env->startSection('title', $video->title ?? 'المرئيات'); ?>
<?php $__env->startSection('description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات')); ?>
<?php $__env->startSection('keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? '')); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.videos.show', $video->slug ?? ''))); ?>
<?php $__env->startSection('og_type', 'video'); ?>
<?php $__env->startSection('og_title', $video->title ?? 'المرئيات'); ?>
<?php $__env->startSection('og_description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات')); ?>
<?php $__env->startSection('og_image', $video->thumbnail ? asset('upload/' . $video->thumbnail) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.videos.show', $video->slug ?? ''))); ?>
<?php $__env->startSection('og_keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? '')); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', $video->title ?? 'المرئيات'); ?>
<?php $__env->startSection('twitter_description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات')); ?>
<?php $__env->startSection('twitter_image', $video->thumbnail ? asset('upload/' . $video->thumbnail) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? '')); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e($video->title ?? 'المرئيات'); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.videos.index')); ?>"
                            class="text-white">المرئيات</a></li>
                    <?php if(isset($video->category)): ?>
                        <li class="list-inline-item"><a
                                href="<?php echo e(route('frontend.videos.category', $video->category->slug)); ?>"
                                class="text-white"><?php echo e($video->category->title); ?></a></li>
                    <?php endif; ?>
                    <li class="list-inline-item"><?php echo e($video->title); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="ajax-content">
        <?php echo $__env->make('frontend.partials.show_partial', [
            'video' => $video,
            'recentVideos' => $recentVideos,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/videos/show.blade.php ENDPATH**/ ?>