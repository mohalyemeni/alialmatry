<section class="blog-area overflow-hidden bg-white space" id="blog-sec">
    <div class="container">

        <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s">تصنيفات الفيديو</h3>

        <div class="container pt-30 pb-45">
            <?php if($categories->isEmpty()): ?>
                <p class="text-muted">لا توجد تصنيفات حالياً.</p>
            <?php else: ?>
                <div class="row gy-4">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $delay = 0.3 + $index * 0.04;

                            $img = null;
                            $rawImg = $category->img ?? '';

                            if (!empty($rawImg)) {
                                $path = 'assets/video_categories/' . basename($rawImg);
                                if (file_exists(public_path($path))) {
                                    $img = asset($path);
                                }
                            }

                            $title = $category->title ?? ($category->name ?? '');
                            $videosCount =
                                $category->videos_count ?? ($category->videos()->where('status', 1)->count() ?? 0);
                        ?>

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="blog-box style2 wow fadeInUp" data-wow-delay="<?php echo e($delay); ?>s">
                                <?php if($img): ?>
                                    <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                                        <a href="<?php echo e(route('frontend.videos.category', $category->slug ?? $category->id)); ?>"
                                            class="d-block">
                                            <img src="<?php echo e($img); ?>" alt="<?php echo e(e($title)); ?>"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="blog-wrapper p-3">
                                    <span class="date">
                                        <a
                                            href="<?php echo e(route('frontend.videos.category', $category->slug ?? $category->id)); ?>">
                                            <?php echo e($videosCount); ?> <span>فيديو</span>
                                        </a>
                                    </span>

                                    <div class="blog-content mt-2">
                                        <h3 class="box-title mb-2" style="font-size:1rem;">
                                            <a
                                                href="<?php echo e(route('frontend.videos.category', $category->slug ?? $category->id)); ?>">
                                                <?php echo e(e(\Illuminate\Support\Str::limit($title, 70))); ?>

                                            </a>
                                        </h3>

                                        <a href="<?php echo e(route('frontend.videos.category', $category->slug ?? $category->id)); ?>"
                                            class="th-btn border-btn">
                                            تصفح <i class="fa-solid fa-arrow-left ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/partials/index_partial.blade.php ENDPATH**/ ?>