<div class="container  pt-45 pb-45">
    <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s"> الفيديوهات </h3>
    <?php if($videos->isEmpty()): ?>
        <p>لا توجد فيديوهات في هذا التصنيف بعد.</p>
    <?php else: ?>
        <div class="row gy-4">
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $delay = 0.3 + $index * 0.05;

                    $thumbField = $video->thumbnail;

                    $thumbnailSrc = null;

                    if (!empty($thumbField)) {
                        if (\Illuminate\Support\Str::startsWith($thumbField, ['http://', 'https://'])) {
                            $thumbnailSrc = $thumbField;
                        } else {
                            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($thumbField)) {
                                $thumbnailSrc = asset('storage/' . $thumbField);
                            } else {
                                $attempt = 'videos/thumbnails/' . ltrim($thumbField, '/');
                                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($attempt)) {
                                    $thumbnailSrc = asset('storage/' . $attempt);
                                }
                            }
                        }
                    }

                    if (empty($thumbnailSrc) && !empty($video->youtube_id)) {
                        $thumbnailSrc = "https://img.youtube.com/vi/{$video->youtube_id}/hqdefault.jpg";
                    }

                ?>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="mini-counter-image wow fadeInUp vc-card" data-wow-delay="<?php echo e($delay); ?>s">
                        <a href="<?php echo e(route('frontend.videos.show', $video->slug)); ?>"
                            class="ajax-link text-decoration-none">
                            <div class="box-img global-img tow_height position-relative vc-img">
                                <?php if($thumbnailSrc): ?>
                                    <img src="<?php echo e($thumbnailSrc); ?>" alt="<?php echo e($video->title); ?>" class="tow_height w-100">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="height:160px; background:#eee;">
                                        <span class="text-muted">لا صورة</span>
                                    </div>
                                <?php endif; ?>

                                <span class="play-btn custom-center-play-btn vc-play" aria-hidden="true">
                                    <i class="fa-solid fa-play fa-flip-horizontal"></i>
                                </span>
                            </div>

                            <div class="card-body text-center vc-body">
                                <h5 class="card-title vc-title"><?php echo e(\Illuminate\Support\Str::limit($video->title, 70)); ?>

                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <?php echo $videos->links(); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/partials/category_partial.blade.php ENDPATH**/ ?>