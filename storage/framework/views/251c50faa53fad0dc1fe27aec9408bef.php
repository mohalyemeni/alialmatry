<?php $__env->startSection('title', e($video->title ?? 'المرئي')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row gx-4 gy-4 justify-content-center">
            <!-- main column -->
            <div class="col-xxl-9 col-lg-8 pt-4 pb-5">
                <div class="th-blog blog-single has-post-thumbnail">
                    <div class="blog-img position-relative mb-3">
                        <?php
                            $thumbnailSrc = null;
                            $thumb = $video->thumbnail ?? '';

                            if (!empty($thumb)) {
                                // جلب الصور فقط من public/upload
                                $candidate1 = 'upload/' . ltrim($thumb, '/');
                                $candidate2 = 'upload/' . basename($thumb);

                                if (file_exists(public_path($candidate1))) {
                                    $thumbnailSrc = asset($candidate1);
                                } elseif (file_exists(public_path($candidate2))) {
                                    $thumbnailSrc = asset($candidate2);
                                }
                            }

                            // fallback لليوتيوب أو صورة placeholder
                            if (empty($thumbnailSrc) && !empty($video->youtube_id)) {
                                $thumbnailSrc = "https://img.youtube.com/vi/{$video->youtube_id}/hqdefault.jpg";
                            }

                            if (empty($thumbnailSrc)) {
                                $thumbnailSrc = asset('frontand/assets/img/normal/counter-image.jpg');
                            }
                        ?>

                        <?php if(!empty($video->youtube_id)): ?>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/<?php echo e($video->youtube_id); ?>" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        <?php elseif(!empty($video->html)): ?>
                            <div class="video-oembed"><?php echo $video->html; ?></div>
                        <?php else: ?>
                            <img src="<?php echo e($thumbnailSrc); ?>" alt="<?php echo e(e($video->title)); ?>" class="img-fluid w-100">
                        <?php endif; ?>
                    </div>

                    <div class="blog-content mt-3">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-2">
                            <div class="blog-meta text-muted">
                                <span><i class="fa-solid fa-calendar-days"></i>
                                    <?php echo e(optional($video->published_on)->format('Y-m-d') ?? '-'); ?></span>
                                <span class="ms-3"><i class="fa-solid fa-eye"></i> <?php echo e($video->views ?? 0); ?> مشاهدة</span>
                            </div>

                            <?php if(!empty($video->category) && (!empty($video->category->title) || !empty($video->category->name))): ?>
                                <?php
                                    $catTitle = $video->category->title ?? ($video->category->name ?? null);
                                    $catSlug = $video->category->slug ?? null;
                                ?>
                                <div class="align-self-start">
                                    <a href="<?php echo e($catSlug ? route('frontend.videos.category', $catSlug) : '#'); ?>"
                                        class="recent-video-badge large-video-badge text-decoration-none"
                                        title="<?php echo e(e($catTitle)); ?>">
                                        <i class="fa-solid fa-layer-group me-1" aria-hidden="true"></i>
                                        <span
                                            class="recent-video-badge-text"><?php echo e(e(\Illuminate\Support\Str::limit($catTitle, 30))); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h3 class="blog-title mb-2"><?php echo e(e($video->title)); ?></h3>

                        <?php if($video->description): ?>
                            <p class="blog-text"><?php echo nl2br(e($video->description)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <aside class="col-xxl-3 col-lg-4 pt-4 pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">أحدث الفيديوهات </h5>

                        <?php if(isset($recentVideos) && $recentVideos->isNotEmpty()): ?>
                            <ul class="list-unstyled mb-0 pr-0">
                                <?php $__currentLoopData = $recentVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $rvThumb = $rv->thumbnail ?? '';
                                        $rvThumbnailSrc = null;

                                        if (!empty($rvThumb)) {
                                            $candidate1 = 'upload/' . ltrim($rvThumb, '/');
                                            $candidate2 = 'upload/' . basename($rvThumb);

                                            if (file_exists(public_path($candidate1))) {
                                                $rvThumbnailSrc = asset($candidate1);
                                            } elseif (file_exists(public_path($candidate2))) {
                                                $rvThumbnailSrc = asset($candidate2);
                                            }
                                        }

                                        if (empty($rvThumbnailSrc) && !empty($rv->youtube_id)) {
                                            $rvThumbnailSrc = "https://img.youtube.com/vi/{$rv->youtube_id}/hqdefault.jpg";
                                        }

                                        if (empty($rvThumbnailSrc)) {
                                            $rvThumbnailSrc = asset('frontand/assets/img/normal/counter-image.jpg');
                                        }
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.videos.show', $rv->slug)); ?>">
                                            <img src="<?php echo e($rvThumbnailSrc); ?>" alt="<?php echo e(e($rv->title)); ?>"
                                                class="recent-video-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1">
                                            <a href="<?php echo e(route('frontend.videos.show', $rv->slug)); ?>"
                                                class="d-block fw-bold text-dark small mb-1">
                                                <?php echo e(e(\Illuminate\Support\Str::limit($rv->title, 60))); ?>

                                            </a>
                                            <small class="text-muted d-block mb-1"><?php echo e($rv->published_on ?? ''); ?></small>

                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="fa-solid fa-eye me-1"></i> <?php echo e($rv->views ?? 0); ?>


                                                <?php if(!empty($rv->category) && !empty($rv->category->title)): ?>
                                                    <a href="<?php echo e($rv->category->slug ? route('frontend.videos.category', $rv->category->slug) : '#'); ?>"
                                                        class="recent-video-badge ms-2"
                                                        title="<?php echo e(e($rv->category->title)); ?>">
                                                        <i class="fa-solid fa-tag me-1" aria-hidden="true"></i>
                                                        <span
                                                            class="recent-video-badge-text"><?php echo e(e(\Illuminate\Support\Str::limit($rv->category->title, 16))); ?></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">لا توجد فيديوهات حديثة.</p>
                        <?php endif; ?>

                        <div class="mt-3 text-start">
                            <?php if($video->category && !empty($video->category->slug)): ?>
                                <a href="<?php echo e(route('frontend.videos.category', $video->category->slug)); ?>" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('frontend.videos.index')); ?>" class="th-btn">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/partials/show_partial.blade.php ENDPATH**/ ?>