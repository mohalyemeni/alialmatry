<?php $__env->startSection('title', e($category->title)); ?>
<?php $__env->startSection('description', "عرض المقالات ضمن تصنيف {$category->title}"); ?>
<?php $__env->startSection('keywords', "مقالات, {$category->title}, مدونة"); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.blogs.category', $category->slug))); ?>

<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_title', e($category->title)); ?>
<?php $__env->startSection('og_description', "عرض المقالات ضمن تصنيف {$category->title}"); ?>
<?php $__env->startSection('og_image', $category->img ? asset('assets/blog_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.blogs.category', $category->slug))); ?>
<?php $__env->startSection('og_keywords', "مقالات, {$category->title}, مدونة"); ?>

<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', e($category->title)); ?>
<?php $__env->startSection('twitter_description', "عرض المقالات ضمن تصنيف {$category->title}"); ?>
<?php $__env->startSection('twitter_image', $category->img ? asset('assets/blog_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', "مقالات, {$category->title}, مدونة"); ?>

<?php $__env->startSection('content'); ?>

    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e($category->title); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.blogs.index')); ?>"
                            class="text-white">المقالات</a></li>
                    <li class="list-inline-item"><?php echo e($category->title); ?></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container py-4">
        <div class="row">

            <div class="col-12 col-xl-8">
                <h3 class="widget_title mb-0 fadeInRight wow title-header-noline" data-wow-delay=".3s">
                    المقالات
                </h3>

                <div class="list-group mt-3">

                    <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div class="me-3" style="flex:1;">
                                <h5 class="mb-1">
                                    <i class="fa fa-newspaper me-2 text-primary"></i>
                                    <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>">
                                        <?php echo e(e($blog->title)); ?>

                                    </a>
                                </h5>

                                <?php if(!empty($blog->excerpt)): ?>
                                    <p class="mb-1 text-muted small">
                                        <?php echo e(e($blog->excerpt)); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="button-wrapp d-flex align-items-center">
                                <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>" class="th-btn style1 th-btn1">
                                    <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                    <i class="fa-solid fa-eye me-1"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted">لا توجد مقالات في هذا التصنيف.</p>
                    <?php endif; ?>
                </div>

                
                <div class="mt-4">
                    <?php echo e($blogs->links()); ?>

                </div>
            </div>

            
            <aside class="col-12 col-xl-4">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-newspaper me-2 text-primary"></i>
                            أحدث المقالات
                        </h5>

                        <?php if(!empty($recentBlogs) && $recentBlogs->count()): ?>
                            <ul class="list-group list-unstyled mb-0">
                                <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                        <div class="me-3" style="flex:1;">
                                            <h6 class="mb-1">
                                                <a href="<?php echo e(route('frontend.blogs.show', $item->slug)); ?>">
                                                    <?php echo e(e(\Illuminate\Support\Str::limit($item->title, 50))); ?>

                                                </a>
                                            </h6>

                                            <?php if(!empty($item->excerpt)): ?>
                                                <p class="mb-1 text-muted small">
                                                    <?php echo e(e($item->excerpt)); ?>

                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="button-wrapp d-flex align-items-center">
                                            <a href="<?php echo e(route('frontend.blogs.show', $item->slug)); ?>"
                                                class="th-btn style1 th-btn1">
                                                <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                                <i class="fa-solid fa-eye me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted mb-0">لا توجد مقالات حديثة.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/blogs/category.blade.php ENDPATH**/ ?>