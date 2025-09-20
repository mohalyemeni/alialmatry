<?php $__env->startSection('title', e($blog->title)); ?>
<?php $__env->startSection('description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 160))); ?>
<?php $__env->startSection('keywords', "مقالات, {$blog->title}, مدونة"); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.blogs.show', $blog->slug))); ?>

<?php $__env->startSection('og_type', 'article'); ?>
<?php $__env->startSection('og_title', e($blog->title)); ?>
<?php $__env->startSection('og_description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''),
    160))); ?>
<?php $__env->startSection('og_image', $blog->img ? asset('assets/blogs/images/' . $blog->img) :
    asset('frontand/assets/img/blog/default.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.blogs.show', $blog->slug))); ?>
<?php $__env->startSection('og_keywords', "مقالات, {$blog->title}, مدونة"); ?>

<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', e($blog->title)); ?>
<?php $__env->startSection('twitter_description', e($blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''),
    160))); ?>
<?php $__env->startSection('twitter_image', $blog->img ? asset('assets/blogs/images/' . $blog->img) :
    asset('frontand/assets/img/blog/default.jpg')); ?>
<?php $__env->startSection('twitter_keywords', "مقالات, {$blog->title}, مدونة"); ?>


<?php $__env->startSection('content'); ?>

    <!-- Breadcrumb Section -->
    <div class="breadcumb-wrapper" style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>')">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(e($blog->title)); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.blogs.index')); ?>"
                            class="text-white">المقالات</a></li>
                    <?php if($blog->category): ?>
                        <li class="list-inline-item"><a href="<?php echo e(route('frontend.blogs.category', $blog->category->slug)); ?>"
                                class="text-white"><?php echo e(e($blog->category->title)); ?></a></li>
                    <?php endif; ?>
                    <li class="list-inline-item"><?php echo e(e($blog->title)); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container py-4 mt-5">
        <div class="row">

            <div class="col-xxl-8 col-lg-8">
                <?php echo $__env->make('frontend.blogs.partials.show_partial', ['blog' => $blog], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- Sidebar Column -->
            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث المقالات</h5>

                        <?php
                            $recentList =
                                $recentBlogs ??
                                \App\Models\Blog::with('category')
                                    ->where('status', 1)
                                    ->orderByDesc('published_on')
                                    ->take(5)
                                    ->get();
                        ?>

                        <?php if($recentList->isNotEmpty()): ?>
                            <ul class="list-unstyled mb-0 pr-0">
                                <?php $__currentLoopData = $recentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $thumbSrc = null;
                                        if (!empty($item->img)) {
                                            if (file_exists(public_path('assets/blogs/images/' . $item->img))) {
                                                $thumbSrc = asset('assets/blogs/images/' . $item->img);
                                            } elseif (
                                                \Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])
                                            ) {
                                                $thumbSrc = $item->img;
                                            } elseif (file_exists(public_path($item->img))) {
                                                $thumbSrc = asset($item->img);
                                            } elseif (file_exists(public_path('storage/' . ltrim($item->img, '/')))) {
                                                $thumbSrc = asset('storage/' . ltrim($item->img, '/'));
                                            }
                                        }
                                        $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/blog/default.jpg');

                                        try {
                                            $publishedFormatted = $item->published_on
                                                ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                                : '';
                                        } catch (\Throwable $e) {
                                            $publishedFormatted = '';
                                        }

                                        $catTitle = $item->category->title ?? null;
                                        $catSlug = $item->category->slug ?? null;
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.blogs.show', $item->slug)); ?>">
                                            <img src="<?php echo e($thumbSrc); ?>" alt="" class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="<?php echo e(route('frontend.blogs.show', $item->slug)); ?>"
                                                class="d-block fw-bold text-dark small mb-1">
                                                <?php echo e(\Illuminate\Support\Str::limit($item->title, 70)); ?>

                                            </a>

                                            <small class="text-muted d-block mb-1"><?php echo e($publishedFormatted); ?></small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> <?php echo e($item->views ?? 0); ?>


                                                <?php if(!empty($catTitle)): ?>
                                                    <a href="<?php echo e($catSlug ? route('frontend.blogs.category', $catSlug) : '#'); ?>"
                                                        class="recent-video-badge ms-2" title="<?php echo e(e($catTitle)); ?>">
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
                                                            style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            <?php echo e(\Illuminate\Support\Str::limit($catTitle, 20)); ?>

                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted mb-0">لا توجد مقالات حديثة.</p>
                        <?php endif; ?>

                        <div class="mt-3 text-start">
                            <?php if($blog->category && !empty($blog->category->slug)): ?>
                                <a href="<?php echo e(route('frontend.blogs.category', $blog->category->slug)); ?>" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('frontend.blogs.index')); ?>" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/blogs/show.blade.php ENDPATH**/ ?>