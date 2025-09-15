<?php $__env->startSection('title', e($book->title ?? 'الكتاب')); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title"><?php echo e(e($book->title)); ?></h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.books.index')); ?>" class="text-white">الكتب
                            والمؤلفات</a></li>
                    <li class="list-inline-item text-white-50"><?php echo e(e(\Illuminate\Support\Str::limit($book->title, 60))); ?>

                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="product-details overflow-hidden space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-4 gy-4">
                <!-- MAIN -->
                <main class="col-12 col-lg-8 order-2 order-lg-1">
                    <div class="sermon-card product-about p-4">
                        <div class="d-flex align-items-start gap-3 flex-column flex-md-row">
                            <div class="book-cover-wrap">
                                <img src="<?php echo e($img); ?>" alt="<?php echo e(e($book->title)); ?>" class="book-cover shadow-sm">
                            </div>


                            <div class="flex-grow-1">
                                <h2 class="product-title mb-2"><?php echo e(e($book->title)); ?></h2>

                                <div class="product-meta mb-3 text-muted small">
                                    <span>تاريخ النشر: <?php echo e(optional($book->published_on)->format('d M, Y') ?? '—'); ?></span>
                                    <span class="mx-2">|</span>
                                    <span>المشاهدات: <?php echo e($book->views ?? 0); ?></span>
                                </div>

                                <div class="mb-3">
                                    <?php echo $book->description; ?>

                                </div>

                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <?php if($book->file && file_exists(public_path('assets/books/files/' . $book->file))): ?>
                                        <a href="<?php echo e(route('frontend.books.download', $book->slug)); ?>"
                                            class="th-btn style1 th-btn11">
                                            تحميل الكتاب <i class="fa-solid fa-download ms-2"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="th-btn disabled">لا يوجد ملف</span>
                                    <?php endif; ?>

                                    <a href="<?php echo e(route('frontend.books.index')); ?>" class="th-btn new_pad">عودة للكتب</a>


                                </div>

                                <?php if(!empty($book->meta_keywords) || !empty($book->meta_description)): ?>
                                    <div class="book-meta-info mt-3 small text-muted">
                                        <?php if(!empty($book->meta_keywords)): ?>
                                            <div><strong>كلمات مفتاحية:</strong> <?php echo e(e($book->meta_keywords)); ?></div>
                                        <?php endif; ?>
                                        <?php if(!empty($book->meta_description)): ?>
                                            <div><strong>وصف الميتا:</strong> <?php echo e(e($book->meta_description)); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                    </div>
                </main>

                <!-- SIDEBAR -->
                <aside class="col-12 col-lg-4 order-1 order-lg-2">
                    <div class="sermon-card   p-3">
                        <h3 class="mb-3 widget_title title-header-noline fadeInRight wow">أحدث الكتب</h3>

                        <?php
                            $recentList =
                                $recentBooks ??
                                \App\Models\Book::where('status', true)
                                    ->where(function ($q) {
                                        $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                    })
                                    ->orderByDesc('published_on')
                                    ->take(6)
                                    ->get();
                        ?>

                        <?php if($recentList->isNotEmpty()): ?>
                            <div class="recent-books-list">
                                <?php $__currentLoopData = $recentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        // rb->img is expected to be a resolved URL if controller passed recentBooks
                                        $thumb =
                                            $rb->img ??
                                            (!empty($rb->img) &&
                                            file_exists(public_path('assets/books/images/' . $rb->img))
                                                ? asset('assets/books/images/' . $rb->img)
                                                : asset('frontand/assets/img/normal/counter-image.jpg'));
                                    ?>

                                    <a href="<?php echo e(route('frontend.books.show', $rb->slug)); ?>"
                                        class="recent-book-item d-flex mb-3 text-decoration-none">
                                        <div style="flex:0 0 72px;">
                                            <img src="<?php echo e($thumb); ?>" alt="<?php echo e(e($rb->title)); ?>" class="recent-thumb"
                                                style="width:72px;height:72px;object-fit:cover;border-radius:6px;">
                                        </div>
                                        <div class="flex-grow-1 ps-3">
                                            <h6 class="mb-1 recent-title">
                                                <?php echo e(e(\Illuminate\Support\Str::limit($rb->title, 60))); ?></h6>

                                            <div class="d-flex align-items-center justify-content-between mb-1"
                                                style="gap:8px;">
                                                <small class="text-muted"><?php echo e($rb->published_on ?? ''); ?></small>

                                                <div class="text-muted small d-flex align-items-center" style="gap:6px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                    <span><?php echo e($rb->views ?? 0); ?></span>
                                                </div>
                                            </div>


                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="mt-3 text-end">
                                <a href="<?php echo e(route('frontend.books.index')); ?>" class="th-btn new_pad">عرض المزيد <i
                                        class="fa-solid fa-arrow-left ms-1"></i></a>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">لا توجد كتب حديثة حالياً.</p>
                        <?php endif; ?>
                    </div>
                </aside>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/books/show.blade.php ENDPATH**/ ?>