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
            <!-- Sidebar -->
            <div class="col-md-4">
                <aside class="card p-3 sidebar-fatawa-card">
                    <div class="card-header d-flex align-items-center justify-content-between bg-transparent px-0 pb-2">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-gavel me-2 text-primary"></i>
                            أحدث الفتاوى
                        </h5>
                    </div>

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
                        <ul class="list-unstyled mb-0 recent-fatawas">
                            <?php $__currentLoopData = $recentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    // thumbnail resolution
                                    $thumb = null;
                                    if (!empty($item->img)) {
                                        if (\Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])) {
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
                                    $thumb = $thumb ?: asset('frontand/assets/img/normal/counter-image.jpg');

                                    $rDate = $item->published_on
                                        ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                        : '';
                                ?>

                                <li class="recent-fatawa-item d-flex align-items-start mb-3">
                                    <a href="<?php echo e(route('frontend.fatawas.show', $item->slug)); ?>"
                                        class="fatawa-thumb-link me-2">
                                        <img src="<?php echo e($thumb); ?>" alt="<?php echo e(e($item->title)); ?>" class="fatawa-thumb"
                                            style="width:72px; height:72px; object-fit:cover; border-radius:6px;">
                                    </a>

                                    <div class="fatawa-info flex-grow-1" style="min-width:0;">
                                        <div class="d-flex align-items-center justify-content-between mb-1"
                                            style="gap:8px;">
                                            <div class="recent-post-meta1 text-muted small"><?php echo e($rDate); ?></div>

                                            <div class="text-muted small d-flex align-items-center" style="gap:8px;">
                                                <span class="d-flex align-items-center"><i class="fa-solid fa-eye me-1"></i>
                                                    <?php echo e($item->views ?? 0); ?></span>

                                                <?php if(!empty($item->category)): ?>
                                                    <a href="<?php echo e(route('frontend.fatawas.category', $item->category->slug ?? '#')); ?>"
                                                        class="badge bg-light text-dark small text-decoration-none"
                                                        style="padding:4px 8px;border-radius:999px;">
                                                        <i class="fa-solid fa-folder-open me-1"
                                                            style="font-size:0.75rem;"></i>
                                                        <?php echo e(\Illuminate\Support\Str::limit($item->category->title, 18)); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <a href="<?php echo e(route('frontend.fatawas.show', $item->slug)); ?>"
                                            class="fatawa-title d-block mb-1 text-inherit" style="font-size:14px;">
                                            <?php echo e(\Illuminate\Support\Str::limit($item->title, 70)); ?>

                                        </a>

                                        <div class="fatawa-meta small text-muted mb-0">
                                            <p class="mb-0" style="line-height:1.2;">
                                                <?php echo e(e(\Illuminate\Support\Str::limit(strip_tags($item->excerpt ?? ($item->description ?? '')), 80))); ?>

                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="mt-3 text-start">
                            <a href="<?php echo e(route('frontend.fatawas.index')); ?>" class="th-btn new_pad">عرض المزيد <i
                                    class="fa-solid fa-arrow-left ms-1"></i></a>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">لا توجد فتاوى حديثة.</p>
                    <?php endif; ?>
                </aside>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/fatawas/category.blade.php ENDPATH**/ ?>