<?php $__env->startSection('title', $category->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e($category->title); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.fatawas.index')); ?>"
                            class="text-white">الفتاوى</a></li>
                    <li class="list-inline-item"><?php echo e($category->title); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="list-group">
                    <?php $__currentLoopData = $fatawas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatawa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('frontend.fatawas.partials.category_partial', ['fatawa' => $fatawa], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-4">
                    <?php echo e($fatawas->links()); ?>

                </div>
            </div>
            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-gavel me-2 text-primary"></i>
                            أحدث الفتاوى
                        </h5>

                        <?php
                            $recentList =
                                $recentFatawas ??
                                \App\Models\Fatwa::with('category')
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
                                        $thumb = null;
                                        if (!empty($item->img)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])
                                            ) {
                                                $thumb = $item->img;
                                            } elseif (file_exists(public_path('assets/fatawa/images/' . $item->img))) {
                                                $thumb = asset('assets/fatawa/images/' . $item->img);
                                            } elseif (file_exists(public_path($item->img))) {
                                                $thumb = asset($item->img);
                                            } elseif (
                                                \Illuminate\Support\Facades\Storage::disk('public')->exists($item->img)
                                            ) {
                                                $thumb = asset('storage/' . ltrim($item->img, '/'));
                                            }
                                        }
                                        $thumb = $thumb ?: null;

                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    ?>

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="<?php echo e(route('frontend.fatawas.show', $item->slug)); ?>">
                                            <img src="<?php echo e($thumb); ?>" alt=""
                                                class="recent-video-thumb recent-fatawa-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="<?php echo e(route('frontend.fatawas.show', $item->slug)); ?>"
                                                class="d-block fw-bold text-dark small mb-1">
                                                <?php echo e(\Illuminate\Support\Str::limit($item->title, 72)); ?>

                                            </a>

                                            <small class="text-muted d-block mb-1"><?php echo e($rDate); ?></small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> <?php echo e($item->views ?? 0); ?>


                                                <?php if(!empty($item->category)): ?>
                                                    <a href="<?php echo e(route('frontend.fatawas.category', $item->category->slug ?? '#')); ?>"
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

                            <div class="mt-3 text-start">
                                <a href="<?php echo e(route('frontend.fatawas.index')); ?>" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">لا توجد فتاوى حديثة.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>



        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/fatawas/category.blade.php ENDPATH**/ ?>