<?php $__env->startSection('title', e($fatawa->title)); ?>
<?php $__env->startSection('description', $fatawa->excerpt ?? strip_tags(Str::limit($fatawa->description ?? '', 160))); ?>
<?php $__env->startSection('keywords', 'فتاوى, أسئلة شرعية, ' . e($fatawa->title)); ?>
<?php $__env->startSection('canonical', urldecode(route('frontend.fatawas.show', $fatawa->slug))); ?>
<?php $__env->startSection('og_type', 'article'); ?>
<?php $__env->startSection('og_title', e($fatawa->title)); ?>
<?php $__env->startSection('og_description', $fatawa->excerpt ?? strip_tags(Str::limit($fatawa->description ?? '', 160))); ?>
<?php $__env->startSection('og_image', $fatawa->img ?? asset('frontand/assets/img/normal/counter-image.jpg')); ?>
<?php $__env->startSection('og_url', urldecode(route('frontend.fatawas.show', $fatawa->slug))); ?>
<?php $__env->startSection('og_keywords', 'فتاوى, أسئلة شرعية, ' . e($fatawa->title)); ?>
<?php $__env->startSection('twitter_card', 'summary_large_image'); ?>
<?php $__env->startSection('twitter_title', e($fatawa->title)); ?>
<?php $__env->startSection('twitter_description', $fatawa->excerpt ?? strip_tags(Str::limit($fatawa->description ?? '', 160))); ?>
<?php $__env->startSection('twitter_image', $fatawa->img ?? asset('frontand/assets/img/normal/counter-image.jpg')); ?>
<?php $__env->startSection('twitter_keywords', 'فتاوى, أسئلة شرعية, ' . e($fatawa->title)); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(e($fatawa->title ?? '')); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>"
                            class="text-white"><?php echo e(__('panel.home') ?? 'الرئيسية'); ?></a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.fatawas.index')); ?>"
                            class="text-white"><?php echo e(__('panel.fatawas') ?? 'الفتاوى'); ?></a></li>
                    <?php if(!empty($fatawa->category)): ?>
                        <li class="list-inline-item"><a
                                href="<?php echo e(route('frontend.fatawas.category', $fatawa->category->slug)); ?>"
                                class="text-white"><?php echo e(e($fatawa->category->title ?? $fatawa->category->name)); ?></a></li>
                    <?php endif; ?>
                    <li class="list-inline-item"><?php echo e(e(\Illuminate\Support\Str::limit($fatawa->title ?? '', 60))); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .audio-player-row {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            height: 40px !important;
        }

        .audio-player-row audio {
            flex: 1 1 auto;
            width: 100%;
            max-width: 100%;
            min-width: 0;

        }

        .audio-play-wrapp audio {

            border: 3px solid var(--theme-color) !important;

        }

        .audio-download-btn {
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .audio-download-btn .th-btn {
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .audio-player-row {
                flex-direction: column;
                align-items: stretch;
            }

            .audio-download-btn {
                align-self: flex-end;
            }

            .audio-player-row {

                height: 90px !important;
            }
        }

        .audio-sidebar .recent-thumb {
            width: 84px;
            height: 64px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
        }

        .audio-sidebar .recent-post {
            gap: 12px;
            align-items: flex-start;
            display: flex;
        }

        .audio-sidebar .audio-badge {
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 0.78rem;
            display: inline-flex;
            gap: 6px;
            align-items: center;
            text-decoration: none;
        }

        .audio-sidebar .post-title-small {
            font-size: 14px;
            margin: 0;
        }

        .audio-sidebar .post-title-small a {
            color: #0f172a;
            text-decoration: none;
        }

        .audio-sidebar .post-title-small a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>

    <div class="container py-4">
        <div class="row">
            <!-- main -->
            <div class="col-lg-8">
                <div class="card p-3 sermon-card">
                    <h3 class="mb-4 mt- widget_title title-header-noline fadeInRight wow text-wrap"><?php echo e(e($fatawa->title)); ?>

                    </h3>

                    <div class="audio-play-wrapp mb-3">
                        <?php
                            $hasAudioFile =
                                !empty($fatawa->audio_file) &&
                                file_exists(public_path('assets/fatawa/files/' . $fatawa->audio_file));
                            $audioFileUrl = $hasAudioFile ? asset('assets/fatawa/files/' . $fatawa->audio_file) : null;
                        ?>

                        <?php if($hasAudioFile): ?>
                            <div class="audio-player-row">
                                <div class="audio-download-btn">
                                    <a href="<?php echo e(route('frontend.fatawas.download', $fatawa->id)); ?>"
                                        class="th-btn style2 th-btn1"
                                        aria-label="<?php echo e(__('panel.download') ?? 'تحميل'); ?> <?php echo e(e($fatawa->title)); ?>">
                                        <span class="btn-text" data-back="<?php echo e(__('panel.download') ?? 'تحميل'); ?>"
                                            data-front="<?php echo e(__('panel.download') ?? 'تحميل'); ?>"></span>
                                        <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                    </a>
                                </div>

                                <audio controls preload="metadata" aria-label="<?php echo e(e($fatawa->title)); ?>">
                                    <source src="<?php echo e($audioFileUrl); ?>" type="audio/mpeg">
                                    <?php echo e(__('panel.audio_not_supported') ?? 'متصفحك لا يدعم تشغيل الصوت.'); ?>

                                </audio>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-secondary mb-0">
                                <?php echo e(__('panel.no_audio_file') ?? 'لا يوجد ملف صوتي متاح لهذه الفتوى.'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="button-wrapp pt-15 d-flex flex-wrap gap-2 wow fadeInRight" data-wow-delay=".4s">
                        <?php if(!empty($fatawa->pdf_link)): ?>
                            <a href="<?php echo e($fatawa->pdf_link); ?>" target="_blank" class="th-btn style2 th-btn1">
                                <span class="btn-text" data-back="<?php echo e(__('panel.pdf') ?? 'PDF'); ?>"
                                    data-front="<?php echo e(__('panel.pdf') ?? 'PDF'); ?>"></span>
                                <i class="fa-regular fa-file-pdf ms-2"></i>
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($fatawa->doc_link)): ?>
                            <a href="<?php echo e($fatawa->doc_link); ?>" target="_blank" class="th-btn style2 th-btn1">
                                <span class="btn-text" data-back="<?php echo e(__('panel.documents') ?? 'Documents'); ?>"
                                    data-front="<?php echo e(__('panel.documents') ?? 'Documents'); ?>"></span>
                                <i class="fa-solid fa-file ms-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="sermon-text mb-3">
                        <?php echo $fatawa->description ?? ''; ?>

                    </div>
                </div>
            </div>

            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><?php echo e(__('panel.recent_fatawas') ?? 'أحدث الفتاوى'); ?></h5>

                        <?php
                            $recent =
                                $recentFatawas ??
                                \App\Models\Fatwa::with('category')
                                    ->where('status', 1)
                                    ->where(function ($q) {
                                        $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                    })
                                    ->orderByDesc('published_on')
                                    ->limit(6)
                                    ->get();
                        ?>

                        <?php if($recent->isNotEmpty()): ?>
                            <ul class="list-unstyled mb-0 pr-0">
                                <?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $rd_img = null;
                                        if (!empty($rd->img)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($rd->img, ['http://', 'https://'])
                                            ) {
                                                $rd_img = $rd->img;
                                            } elseif (file_exists(public_path('assets/fatawa/images/' . $rd->img))) {
                                                $rd_img = asset('assets/fatawa/images/' . $rd->img);
                                            } elseif (file_exists(public_path($rd->img))) {
                                                $rd_img = asset($rd->img);
                                            } elseif (
                                                \Illuminate\Support\Facades\Storage::disk('public')->exists($rd->img)
                                            ) {
                                                $rd_img = asset('storage/' . ltrim($rd->img, '/'));
                                            }
                                        }
                                        $rd_img = $rd_img ?: asset('frontand/assets/img/normal/counter-image.jpg');

                                        $rd_date = $rd->published_on
                                            ? \Carbon\Carbon::parse($rd->published_on)->format('d M, Y')
                                            : '';
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.fatawas.show', $rd->slug)); ?>">
                                            <img src="<?php echo e($rd_img); ?>" loading="lazy" class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="<?php echo e(route('frontend.fatawas.show', $rd->slug)); ?>"
                                                class="d-block fw-bold text-dark small mb-1">
                                                <?php echo e(\Illuminate\Support\Str::limit($rd->title, 72)); ?>

                                            </a>

                                            <small class="text-muted d-block mb-1"><?php echo e($rd_date); ?></small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> <?php echo e($rd->views ?? 0); ?>


                                                <?php if(!empty($rd->category)): ?>
                                                    <a href="<?php echo e(route('frontend.fatawas.category', $rd->category->slug ?? '#')); ?>"
                                                        class="recent-video-badge ms-2"
                                                        title="<?php echo e(e($rd->category->title)); ?>">
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
                                                            style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            <?php echo e(\Illuminate\Support\Str::limit($rd->category->title, 18)); ?>

                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <div class="rv-excerpt small text-muted mb-0 mt-1">
                                                <?php echo e(e(\Illuminate\Support\Str::limit(strip_tags($rd->excerpt ?? ($rd->description ?? '')), 80))); ?>

                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="mt-3 text-start">
                                <a href="<?php echo e(route('frontend.fatawas.index')); ?>" class="th-btn">
                                    <?php echo e(__('panel.view_more') ?? 'عرض المزيد'); ?> <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0"><?php echo e(__('panel.no_recent_fatawas') ?? 'لا توجد فتاوى حديثة.'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>



        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/fatawas/show.blade.php ENDPATH**/ ?>