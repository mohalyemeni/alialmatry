<?php $__env->startSection('title', 'الكتب والمؤلفات'); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcumb-wrapper"
        style="background-image: url('<?php echo e(asset('frontand/assets/img/hero/hero_5_3.jpg')); ?>'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">الكتب والمؤلفات</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="<?php echo e(route('frontend.index')); ?>" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">الكتب والمؤلفات</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 575.98px) {
            .service-box2 {
                margin-bottom: 1rem;
            }
        }

        .service-box2 .box-img img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>

    <div class="container py-4">
        <div class="col-12 col-xl-12">

            <h3 class="title-header-noline widget_title  mb-5 fadeInRight wow" data-wow-delay=".3s">الكتب والمؤلفات</h3>

            <div class="services-replace">
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="service-box2 wow fadeInUp h-100" data-wow-delay=".3s">
                                <div class="box-img">
                                    <a href="<?php echo e(route('frontend.books.show', $book->slug)); ?>">
                                        <img src="<?php echo e($book->img && file_exists(public_path('assets/books/images/' . $book->img)) ? asset('assets/books/images/' . $book->img) : asset('frontand/assets/img/books/default.jpg')); ?>"
                                            alt="<?php echo e($book->title); ?>">
                                    </a>
                                </div>
                                <div class="box-info">
                                    <div class="box-icon">
                                        <img src="<?php echo e(asset('frontand/assets/img/icon/service_2_2.svg')); ?>" alt="Icon">
                                    </div>
                                    <h3 class="box-title">
                                        <a href="<?php echo e(route('frontend.books.show', $book->slug)); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->title)), 15)); ?>

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
                                            <a href="<?php echo e(route('frontend.books.show', $book->slug)); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->title)), 15)); ?>

                                            </a>
                                        </h3>
                                        <p class="box-desc">
                                            <?php echo e(\Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->description)), 140)); ?>

                                        </p>
                                    </div>
                                    <div class="service-btn">
                                        <?php if($book->file && file_exists(public_path('assets/books/files/' . $book->file))): ?>
                                            <a href="<?php echo e(route('frontend.books.download', $book->slug)); ?>"
                                                class="simple-btn">
                                                تحميل <i class="fa-solid fa-download ms-2"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="simple-btn disabled">لا يوجد ملف</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <p>لا توجد كتب حالياً.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- pagination -->
            <div class="row mt-3">
                <div class="col-12">
                    <?php echo e($books->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/books/index.blade.php ENDPATH**/ ?>