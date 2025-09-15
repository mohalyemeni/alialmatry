<?php $__env->startSection('title', e($category->title)); ?>

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

    <div class="container py-4">
        <div class="row">
            <!-- Main list -->
            <div class="col-xxl-8 col-lg-8">
                <div class="list-group">
                    <?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $excerpt = !empty($audio->excerpt)
                                ? \Illuminate\Support\Str::limit(strip_tags($audio->excerpt), 120)
                                : \Illuminate\Support\Str::limit(strip_tags($audio->description ?? ''), 120);

                            $thumbSrc = null;
                            if (!empty($audio->img)) {
                                if (\Illuminate\Support\Str::startsWith($audio->img, ['http://', 'https://'])) {
                                    $thumbSrc = $audio->img;
                                } elseif (file_exists(public_path('assets/audios/images/' . $audio->img))) {
                                    $thumbSrc = asset('assets/audios/images/' . $audio->img);
                                } elseif (file_exists(public_path($audio->img))) {
                                    $thumbSrc = asset($audio->img);
                                } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($audio->img)) {
                                    $thumbSrc = asset('storage/' . ltrim($audio->img, '/'));
                                }
                            }
                            $thumbSrc = $thumbSrc ?: asset('frontand/assets/img/normal/counter-image.jpg');

                            $published = $audio->published_on
                                ? \Carbon\Carbon::parse($audio->published_on)->format('d M, Y')
                                : '';
                        ?>

                        <div class="list-group-item custom-audio-item d-flex align-items-start gap-3">
                            <div style="flex:0 0 120px;">
                                <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>">
                                    <img src="<?php echo e($thumbSrc); ?>" alt="<?php echo e(e($audio->title)); ?>">
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                        <?php
                            $recentList =
                                $recentAudios ??
                                \App\Models\Audio::with('category')
                                    ->where('status', 1)
                                    ->where(function ($q) {
                                        $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                    })
                                    ->orderByDesc('published_on')
                                    ->take(6)
                                    ->get();
                        ?>

                        <?php if($recentList->isNotEmpty()): ?>
                            <ul class="list-unstyled mb-0 pr-0">
                                <?php $__currentLoopData = $recentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $rThumb = null;
                                        if (!empty($item->img)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])
                                            ) {
                                                $rThumb = $item->img;
                                            } elseif (file_exists(public_path('assets/audios/images/' . $item->img))) {
                                                $rThumb = asset('assets/audios/images/' . $item->img);
                                            } elseif (file_exists(public_path($item->img))) {
                                                $rThumb = asset($item->img);
                                            } elseif (
                                                \Illuminate\Support\Facades\Storage::disk('public')->exists($item->img)
                                            ) {
                                                $rThumb = asset('storage/' . ltrim($item->img, '/'));
                                            }
                                        }
                                        $rThumb = $rThumb ?: asset('frontand/assets/img/normal/counter-image.jpg');

                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.audios.show', $item->slug)); ?>">
                                            <img src="<?php echo e($rThumb); ?>" alt="<?php echo e(e($item->title)); ?>"
                                                class="recent-video-thumb"
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

                <?php if($featuredCats->isNotEmpty()): ?>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">تصنيفات مميزة</h5>
                            <ul class="list-unstyled mb-0">
                                <?php $__currentLoopData = $featuredCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-2">
                                        <a href="<?php echo e(route('frontend.audios.category', $fc->slug)); ?>"
                                            class="text-decoration-none d-flex align-items-center" style="gap:10px;">
                                            <div style="flex:0 0 44px;">
                                                <?php
                                                    $cimg = null;
                                                    if (!empty($fc->img)) {
                                                        if (
                                                            \Illuminate\Support\Str::startsWith($fc->img, [
                                                                'http://',
                                                                'https://',
                                                            ])
                                                        ) {
                                                            $cimg = $fc->img;
                                                        } elseif (
                                                            file_exists(
                                                                public_path('assets/audio_categories/' . $fc->img),
                                                            )
                                                        ) {
                                                            $cimg = asset('assets/audio_categories/' . $fc->img);
                                                        }
                                                    }
                                                    $cimg =
                                                        $cimg ?: asset('frontand/assets/img/normal/counter-image.jpg');
                                                ?>
                                                <img src="<?php echo e($cimg); ?>" alt="<?php echo e($fc->title); ?>">
                                            </div>
                                            <div style="flex:1; min-width:0;">
                                                <strong
                                                    style="font-size:0.95rem;"><?php echo e(\Illuminate\Support\Str::limit($fc->title, 40)); ?></strong>
                                                <div class="text-muted small">
                                                    <?php echo e($fc->audios_count ?? $fc->audios()->where('status', 1)->count()); ?>

                                                    صوت
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/audios/category.blade.php ENDPATH**/ ?>