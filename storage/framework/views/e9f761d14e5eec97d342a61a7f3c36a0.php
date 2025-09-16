<div class="pb_80 pt-60 overflow-hidden positive-relative my-animation theme_overlay_new">
    <div class="container">
        <div class="row gap_mine">

            
            <div class="col-12 col-xl-6">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 fadeInRight wow" data-wow-delay=".3s">
                        المقالات
                        <?php if(isset($blogCategory) && !empty($blogCategory->name)): ?>
                            - <?php echo e(e($blogCategory->name)); ?>

                        <?php endif; ?>
                    </h3>

                    <div class="btn-group">
                        <a href="<?php echo e(route('frontend.blogs.index') ?? '#'); ?>" class="th-btn style1 fadeInRight wow"
                            data-wow-delay=".3s">
                            <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                        </a>
                    </div>
                </div>

                <?php if(isset($blogs) && $blogs->count()): ?>
                    <?php
                        $latestBlogs = $blogs->take(4);
                    ?>

                    <div class="list-group">
                        <?php $__currentLoopData = $latestBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="me-3" style="flex:1;">
                                    <h5 class="mb-1">
                                        <i class="fa fa-newspaper me-2 text-primary"></i>
                                        <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>">
                                            <?php echo e(e($blog->title)); ?>

                                        </a>
                                    </h5>

                                    <?php if(!empty($blog->excerpt ?? '') || !empty($blog->description ?? '')): ?>
                                        <p class="mb-1 text-muted small">
                                            <?php echo e(e(\Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?? ($blog->description ?? '')), 120))); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="button-wrapp d-flex align-items-center">
                                    <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>"
                                        class="th-btn style1 th-btn1">
                                        <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">لا توجد مقالات لعرضها حالياً.</p>
                <?php endif; ?>
            </div>

            <div class="col-12 col-xl-6">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 fadeInRight wow" data-wow-delay=".3s">
                        الكتب والمؤلفات
                        <?php if(isset($bookCategory) && !empty($bookCategory->name)): ?>
                            - <?php echo e(e($bookCategory->name)); ?>

                        <?php endif; ?>
                    </h3>

                    <div class="btn-group">
                        <a href="<?php echo e(route('frontend.books.index') ?? '#'); ?>" class="th-btn style1 fadeInRight wow"
                            data-wow-delay=".3s">
                            <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                        </a>
                    </div>
                </div>

                <?php if(isset($books) && $books->count()): ?>
                    <?php
                        $displayBooks = $books;
                        if ($books instanceof \Illuminate\Pagination\AbstractPaginator) {
                            $displayBooks = $books->getCollection();
                        }
                    ?>

                    <div class="services-replace">
                        <div class="row">
                            <?php $__currentLoopData = $displayBooks->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-sm-6">
                                    <div class="service-box2 wow fadeInUp mb-2" data-wow-delay=".3s">
                                        <?php
                                            $img = $bk->img ?? asset('frontand/assets/img/normal/counter-image.jpg');
                                            if (
                                                !empty($bk->img) &&
                                                file_exists(public_path('assets/books/images/' . $bk->img))
                                            ) {
                                                $img = asset('assets/books/images/' . $bk->img);
                                            }
                                        ?>

                                        <div class="box-img">
                                            <a href="<?php echo e(route('frontend.books.show', $bk->slug)); ?>">
                                                <img src="<?php echo e($img); ?>" alt="<?php echo e(e($bk->title)); ?>">
                                            </a>
                                        </div>

                                        <div class="box-info">
                                            <div class="box-icon">
                                                <img src="<?php echo e(asset('frontand/assets/img/icon/service_2_2.svg')); ?>"
                                                    alt="Icon">
                                            </div>

                                            <h3 class="box-title">
                                                <a href="<?php echo e(route('frontend.books.show', $bk->slug)); ?>">
                                                    <?php echo e(e(\Illuminate\Support\Str::limit($bk->title, 25))); ?>

                                                </a>
                                            </h3>
                                        </div>

                                        <div class="box-content">
                                            <div class="box-wrapp">
                                                <div class="box-icon">
                                                    <img src="<?php echo e(asset('frontand/assets/img/icon/service_2_2.svg')); ?>"
                                                        alt="Icon">
                                                </div>
                                                <h3 class="box-title">
                                                    <a href="<?php echo e(route('frontend.books.show', $bk->slug)); ?>">
                                                        <?php echo e(e(\Illuminate\Support\Str::limit($bk->title, 20))); ?>

                                                    </a>
                                                </h3>
                                                <?php if(!empty($bk->excerpt ?? $bk->description)): ?>
                                                    <p class="small text-muted mt-2">
                                                        <?php echo e(e(\Illuminate\Support\Str::limit(strip_tags($bk->excerpt ?? $bk->description), 120))); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="service-btn">
                                                <?php if(!empty($bk->file_url)): ?>
                                                    <a href="<?php echo e($bk->file_url); ?>" target="_blank" class="simple-btn"
                                                        download>
                                                        تحميل <i class="fa-solid fa-download ms-2"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('frontend.books.show', $bk->slug)); ?>"
                                                        class="simple-btn">
                                                        عرض التفاصيل
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted">لا توجد كتب لعرضها حالياً.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/sections/blog.blade.php ENDPATH**/ ?>