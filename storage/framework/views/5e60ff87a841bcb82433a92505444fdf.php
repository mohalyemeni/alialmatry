<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h3 class="mb-4 mt- widget_title title-header-noline fadeInRight wow text-wrap">نتائج البحث عن: "<?php echo e($query); ?>"
        </h3>

        <?php if($blogs->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">المدونات</h4>
                <div class="row">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($blog->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($blog->description))), 100)); ?></p>
                                    <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>" class="btn btn-primary">قراءة
                                        المزيد</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if($videos->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">الفيديوهات</h4>
                <div class="row">
                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($video->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($video->description))), 100)); ?></p>
                                    <a href="<?php echo e(route('frontend.videos.show', $video->slug)); ?>"
                                        class="btn btn-primary">مشاهدة</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if($audios->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">المقاطع الصوتية</h4>
                <div class="row">
                    <?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($audio->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($audio->description))), 100)); ?></p>
                                    <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>"
                                        class="btn btn-primary">استماع</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if($fatawas->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">الفتاوى</h4>
                <div class="row">
                    <?php $__currentLoopData = $fatawas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatawa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($fatawa->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($fatawa->description))), 100)); ?>

                                    </p>
                                    <a href="<?php echo e(route('frontend.fatawas.show', $fatawa->slug)); ?>"
                                        class="btn btn-primary">قراءة الفتوى</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if($books->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">الكتب</h4>
                <div class="row">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($book->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($book->description))), 100)); ?></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="<?php echo e(route('frontend.books.show', $book->slug)); ?>"
                                            class="btn btn-primary">قراءة</a>
                                        <a href="<?php echo e(route('frontend.books.download', $book->slug)); ?>"
                                            class="btn btn-outline-secondary">
                                            <i class="fas fa-download"></i> تحميل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if($durars->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3">الدرر</h4>
                <div class="row">
                    <?php $__currentLoopData = $durars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $durar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($durar->title); ?></h5>
                                    <p class="card-text">
                                        <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($durar->description))), 100)); ?>

                                    </p>
                                    <a href="<?php echo e(route('frontend.durars.show', $durar->slug)); ?>"
                                        class="btn btn-primary1">قراءة المزيد</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(
            $blogs->count() == 0 &&
                $videos->count() == 0 &&
                $audios->count() == 0 &&
                $fatawas->count() == 0 &&
                $books->count() == 0 &&
                $durars->count() == 0): ?>
            <div class="alert alert-info text-center">
                لم يتم العثور على نتائج للبحث "<?php echo e($query); ?>"
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/search-results.blade.php ENDPATH**/ ?>