<?php $__env->startSection('title', __('panel.audios')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Breadcrumb Section -->
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(__('panel.audios')); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>"
                            class="text-white"><?php echo e(__('panel.home')); ?></a></li>
                    <li class="list-inline-item"><?php echo e(__('panel.audios')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="blog-area overflow-hidden bg-white space" id="audio-sec">
        <div class="container">

            <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s">
                التصنيفات</h3>

            
            <div class="container pt-30 pb-45">
                <?php if($categories->isEmpty()): ?>
                    <p class="text-muted">لا توجد تصنيفات حالياً.</p>
                <?php else: ?>
                    <div class="row gy-4">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // small animation delay for wow
                                $delay = 0.3 + $index * 0.04;

                                // image fallback resolution (محاولة عدة مسارات شائعة)
                                $img = null;
                                if (
                                    !empty($category->img) &&
                                    file_exists(public_path('assets/audio_categories/' . $category->img))
                                ) {
                                    $img = asset('assets/audio_categories/' . $category->img);
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

                                // count of audios (use precomputed count if available)
                                $audiosCount =
                                    $category->audios_count ?? ($category->audios()->where('status', 1)->count() ?? 0);
                            ?>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="blog-box style2 wow fadeInUp" data-wow-delay="<?php echo e($delay); ?>s">
                                    <div class="blog-img blog-img11 global-img" style="height:220px; overflow:hidden;">
                                        <a href="<?php echo e(route('frontend.audios.category', $category->slug ?? $category->id)); ?>"
                                            class="d-block">
                                            <img src="<?php echo e($img); ?>" alt="<?php echo e(e($title)); ?>"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        </a>
                                    </div>

                                    <div class="blog-wrapper p-3">
                                        
                                        <span class="date">
                                            <a
                                                href="<?php echo e(route('frontend.audios.category', $category->slug ?? $category->id)); ?>">
                                                <?php echo e($audiosCount); ?> <span>صوت</span>
                                            </a>
                                        </span>

                                        <div class="blog-content mt-2">
                                            <div class="blog-meta mb-1"></div>

                                            <h3 class="box-title mb-2" style="font-size:1rem;">
                                                <a
                                                    href="<?php echo e(route('frontend.audios.category', $category->slug ?? $category->id)); ?>">
                                                    <?php echo e(e(\Illuminate\Support\Str::limit($title, 70))); ?>

                                                </a>
                                            </h3>

                                            <a href="<?php echo e(route('frontend.audios.category', $category->slug ?? $category->id)); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/audios/index.blade.php ENDPATH**/ ?>