<?php $__env->startSection('title', e($category->title)); ?>
<?php $__env->startSection('description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title)); ?>
<?php $__env->startSection('keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title)); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.audios.category', $category->slug ?? $category->id))); ?>
<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_title', e($category->title)); ?>
<?php $__env->startSection('og_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title)); ?>
<?php $__env->startSection('og_image', $category->img ? asset('assets/audio_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.audios.category', $category->slug ?? $category->id))); ?>
<?php $__env->startSection('og_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title)); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', e($category->title)); ?>
<?php $__env->startSection('twitter_description', $category->description ?? 'عرض الصوتيات ضمن تصنيف ' . e($category->title)); ?>
<?php $__env->startSection('twitter_image', $category->img ? asset('assets/audio_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>
<?php $__env->startSection('twitter_keywords', $category->meta_keywords ?? 'صوتيات, تصنيف, ' . e($category->title)); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(e($category->title)); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>"
                            class="text-white"><?php echo e(__('panel.home')); ?></a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.audios.index')); ?>"
                            class="text-white"><?php echo e(__('panel.audios')); ?></a></li>
                    <li class="list-inline-item"><?php echo e($category->title); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 576px) {
            .custom-audio-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .custom-audio-item>div:first-child {
                flex: 0 0 auto;
                width: 100%;
            }

            .custom-audio-item img {
                width: 100%;
                height: auto;
                object-fit: cover;
                border-radius: 5px;
            }

            .custom-audio-item>div:nth-child(2) {
                width: 100%;
            }

            .custom-audio-item .d-flex.align-items-center.justify-content-between {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .custom-audio-item .meta-buttons {
                width: 100%;
                display: flex;
                justify-content: flex-start;
                gap: 10px;
                margin-top: 5px;
            }
        }
    </style>

    <div class="container py-4">
        <div class="row">

            <div class="col-xxl-8 col-lg-8">
                <div class="list-group">

                    <?php $__empty_1 = true; $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $excerpt = $audio->excerpt ?? '';
                            $thumbSrc = $audio->img ?? null;

                            if (!$thumbSrc) {
                                if (!empty($audio->img)) {
                                    if (\Illuminate\Support\Str::startsWith($audio->img, ['http://', 'https://'])) {
                                        $thumbSrc = $audio->img;
                                    } elseif (file_exists(public_path('assets/audios/images/' . $audio->img))) {
                                        $thumbSrc = asset('assets/audios/images/' . $audio->img);
                                    } elseif (file_exists(public_path($audio->img))) {
                                        $thumbSrc = asset($audio->img);
                                    } elseif (
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($audio->img)
                                    ) {
                                        $thumbSrc = asset('storage/' . ltrim($audio->img, '/'));
                                    }
                                }
                                $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/normal/counter-image.jpg');
                            }

                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        ?>

                        <div class="list-group-item custom-audio-item d-flex align-items-start gap-3">
                            <div style="flex:0 0 120px;">
                                <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>">
                                    <img src="<?php echo e($thumbSrc); ?>" alt="">
                                </a>
                            </div>

                            <div style="flex:1; min-width:0;">
                                <h5 class="mb-1">
                                    <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>" class="d-block text-dark">
                                        <?php echo e(e(\Illuminate\Support\Str::limit($audio->title, 80))); ?>

                                    </a>
                                </h5>

                                <?php if(!empty($excerpt)): ?>
                                    <small class="text-muted d-block mb-2"
                                        style="line-height:1.2;"><?php echo e(e($excerpt)); ?></small>
                                <?php endif; ?>

                                <div class="d-flex align-items-center justify-content-between" style="gap:8px;">
                                    <div class="text-muted small d-flex align-items-center" style="gap:12px;">
                                        <span><i class="fa-solid fa-calendar-days me-1"></i> <?php echo e($published); ?></span>
                                        <span><i class="fa-solid fa-eye me-1"></i> <?php echo e($audio->views ?? 0); ?></span>
                                        <?php if(!empty($audio->category)): ?>
                                            <a href="<?php echo e(route('frontend.audios.category', $audio->category->slug ?? '#')); ?>"
                                                class="recent-video-badge" style="padding:4px 8px;border-radius:999px;">
                                                <i class="fa-solid fa-folder-open me-1" style="font-size:0.75rem;"></i>
                                                <?php echo e(\Illuminate\Support\Str::limit($audio->category->title, 20)); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="meta-buttons">
                                        <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>"
                                            class="th-btn style1 th-btn1">
                                            <span class="btn-text" data-back="<?php echo e(__('panel.play')); ?>"
                                                data-front="<?php echo e(__('panel.play')); ?>"></span>
                                            <i class="fa-solid fa-play me-1"></i>
                                        </a>

                                        <?php if(!empty($audio->audio_file)): ?>
                                            <a href="<?php echo e(route('frontend.audios.download', $audio->id)); ?>"
                                                class="th-btn style2 th-btn1">
                                                <span class="btn-text" data-back="<?php echo e(__('panel.download')); ?>"
                                                    data-front="<?php echo e(__('panel.download')); ?>"></span>
                                                <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted">لا توجد صوتيات في هذا التصنيف.</p>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <?php echo e($audios->links()); ?>

                </div>
            </div>

            <!-- Sidebar -->
            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث الصوتيات</h5>

                        <?php if(!empty($recentAudios) && $recentAudios->count()): ?>
                            <ul class="list-unstyled mb-0 pr-0">
                                <?php $__currentLoopData = $recentAudios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $rThumb = $item->img ?: asset('frontand/assets/img/normal/counter-image.jpg');
                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.audios.show', $item->slug)); ?>">
                                            <img src="<?php echo e($rThumb); ?>" alt="" class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="<?php echo e(route('frontend.audios.show', $item->slug)); ?>"
                                                class="d-block fw-bold text-dark small mb-1">
                                                <?php echo e(\Illuminate\Support\Str::limit($item->title, 70)); ?>

                                            </a>

                                            <small class="text-muted d-block mb-1"><?php echo e($rDate); ?></small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> <?php echo e($item->views ?? 0); ?>


                                                <?php if(!empty($item->category)): ?>
                                                    <a href="<?php echo e(route('frontend.audios.category', $item->category->slug ?? '#')); ?>"
                                                        class="recent-video-badge ms-2"
                                                        title="<?php echo e(e($item->category->title)); ?>">
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
                                                            style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            <?php echo e(\Illuminate\Support\Str::limit($item->category->title, 18)); ?>

                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted mb-0">لا توجد صوتيات حديثة.</p>
                        <?php endif; ?>

                        <div class="mt-3 text-start">
                            <?php if($category->slug): ?>
                                <a href="<?php echo e(route('frontend.audios.category', $category->slug)); ?>" class="th-btn">عرض
                                    المزيد <i class="fa-solid fa-arrow-left ms-1"></i></a>
                            <?php else: ?>
                                <a href="<?php echo e(route('frontend.audios.index')); ?>" class="th-btn">عرض المزيد <i
                                        class="fa-solid fa-arrow-left ms-1"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <?php
                    $featuredCats = \App\Models\Category::where('section', \App\Models\Category::SECTION_AUDIO)
                        ->where('status', 1)
                        ->where('featured', 1)
                        ->whereHas('audios', function ($q) {
                            $q->where('status', 1);
                        })
                        ->orderByDesc('id')
                        ->take(6)
                        ->get();
                ?>

            </aside>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/audios/category.blade.php ENDPATH**/ ?>