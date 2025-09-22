<?php $__env->startSection('content'); ?>
    <div class="container py-5 px-5">
        <h3 class="mb-4 widget_title title-header-noline fadeInRight wow text-wrap">
            نتائج البحث عن: "<?php echo e($query); ?>"
        </h3>

        
        <?php if($blogs->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-blog icon_color"></i> المدونات</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="far fa-newspaper ms-2 icon_color"></i><?php echo e($blog->title); ?></h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($blog->description))), 80)); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('frontend.blogs.show', $blog->slug)); ?>" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($blogs->withQueryString()->links()); ?>

                </div>
            </section>
        <?php endif; ?>

        
        <?php if($videos->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-video icon_color"></i> الفيديوهات</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-play-circle ms-2 icon_color"></i><?php echo e($video->title); ?>

                                </h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($video->description))), 80)); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('frontend.videos.show', $video->slug)); ?>" class="btn btn-sm btn-primary">
                                مشاهدة
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($videos->withQueryString()->links()); ?>

                </div>
            </section>
        <?php endif; ?>

        
        <?php if($audios->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-headphones icon_color"></i> المقاطع الصوتية</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fa fa-volume-up ms-2 icon_color"></i><?php echo e($audio->title); ?></h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($audio->description))), 80)); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('frontend.audios.show', $audio->slug)); ?>" class="btn btn-sm btn-primary">
                                استماع
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($audios->withQueryString()->links()); ?>

                </div>
            </section>
        <?php endif; ?>

        
        <?php if($fatawas->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book-open icon_color"></i> الفتاوى</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $fatawas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatawa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-scroll ms-2 icon_color"></i><?php echo e($fatawa->title); ?></h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($fatawa->description))), 80)); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('frontend.fatawas.show', $fatawa->slug)); ?>" class="btn btn-sm btn-primary">
                                قراءة الفتوى
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($fatawas->withQueryString()->links()); ?>

                </div>
            </section>
        <?php endif; ?>

        
        <?php if($books->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book icon_color"></i> الكتب</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-book-reader ms-2 icon_color"></i><?php echo e($book->title); ?>

                                </h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($book->description))), 80)); ?>

                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('frontend.books.show', $book->slug)); ?>" class="btn btn-sm btn-primary">
                                    قراءة
                                </a>
                                <a href="<?php echo e(route('frontend.books.download', $book->slug)); ?>"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-download"></i> تحميل
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($books->withQueryString()->links()); ?>

                </div>
            </section>
        <?php endif; ?>

        
        <?php if($durars->count() > 0): ?>
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-gem icon_color"></i> الدرر</h4>
                <div class="list-group">
                    <?php $__currentLoopData = $durars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $durar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-gem ms-2 icon_color "></i><?php echo e($durar->title); ?></h5>
                                <p class="mb-1 text-muted small">
                                    <?php echo e(Str::limit(trim(strip_tags(html_entity_decode($durar->description))), 80)); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('frontend.durars.show', $durar->slug)); ?>" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?php echo e($durars->withQueryString()->links()); ?>

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