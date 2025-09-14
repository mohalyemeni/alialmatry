
<section class="blog-area overflow-hidden bg-white space" id="blog-sec">
    <div class="container">

        <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s">تصنيفات المقالات</h3>
        
        <div class="container pt-30 pb-45">
            <?php if($categories->isEmpty()): ?>
                <p class="text-muted">لا توجد تصنيفات حالياً.</p>
            <?php else: ?>
                <div class="row gy-4">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            // small animation delay for wow
                            $delay = 0.3 + $index * 0.04;

                            // image fallback resolution
                            $img = null;
                            if (
                                !empty($category->img) &&
                                file_exists(public_path('assets/blog_categories/' . $category->img))
                            ) {
                                $img = asset('assets/blog_categories/' . $category->img);
                            } elseif (
                                !empty($category->img) &&
                                \Illuminate\Support\Str::startsWith($category->img, ['http://', 'https://'])
                            ) {
                                $img = $category->img;
                            } elseif (!empty($category->img) && file_exists(public_path($category->img))) {
                                $img = asset($category->img);
                            } else {
                                $img = asset('frontand/assets/img/normal/counter-image.jpg');
                            }

                            // title field: prefer title then name then slug
                            $title = $category->title ?? ($category->name ?? ($category->slug ?? 'تصنيف'));

                            // count of articles (use precomputed count if available)
                            $articlesCount =
                                $category->blogs_count ?? ($category->blogs()->where('status', 1)->count() ?? 0);
                        ?>

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="blog-box style2 wow fadeInUp" data-wow-delay="<?php echo e($delay); ?>s">
                                <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                                    <a href="<?php echo e(route('frontend.blogs.category', $category->slug ?? $category->id)); ?>"
                                        class="d-block">
                                        <img src="<?php echo e($img); ?>" alt="<?php echo e(e($title)); ?>"
                                            style="width:100%; height:100%; object-fit:cover;">
                                    </a>
                                </div>

                                <div class="blog-wrapper p-3">
                                    
                                    <span class="date">
                                        <a
                                            href="<?php echo e(route('frontend.blogs.category', $category->slug ?? $category->id)); ?>">
                                            <?php echo e($articlesCount); ?> <span>مقال</span>
                                        </a>
                                    </span>

                                    <div class="blog-content mt-2">
                                        <div class="blog-meta mb-1"></div>

                                        <h3 class="box-title mb-2" style="font-size:1rem;">
                                            <a
                                                href="<?php echo e(route('frontend.blogs.category', $category->slug ?? $category->id)); ?>">
                                                <?php echo e(e(\Illuminate\Support\Str::limit($title, 70))); ?>

                                            </a>
                                        </h3>

                                        <a href="<?php echo e(route('frontend.blogs.category', $category->slug ?? $category->id)); ?>"
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
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/blogs/partials/index_partial.blade.php ENDPATH**/ ?>