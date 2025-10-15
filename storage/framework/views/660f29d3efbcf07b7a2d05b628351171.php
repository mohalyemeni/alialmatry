<?php if(isset($audioCategories) && $audioCategories->count()): ?>
    <section>
        <div class="pb_80 row spical m-0 padding_top" dir="rtl">


            <section class="tabs-section col-lg-7 col-12">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 wow fadeInRight" data-wow-delay=".3s">الصوتيات</h3>

                    <div class="btn-group">
                        <a href="<?php echo e(route('frontend.audios.index')); ?>" class="th-btn style1">
                            <span class="btn-text" data-back=" المزيد" data-front=" المزيد"></span>
                        </a>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="audioTabs" role="tablist">
                    <?php $__currentLoopData = $audioCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo e($i === 0 ? 'active' : ''); ?> btn_font_size"
                                id="audio-tab-<?php echo e($cat->id); ?>" data-bs-toggle="tab"
                                data-bs-target="#audio-<?php echo e($cat->id); ?>" type="button" role="tab"
                                aria-controls="audio-<?php echo e($cat->id); ?>"
                                aria-selected="<?php echo e($i === 0 ? 'true' : 'false'); ?>">
                                <?php echo e(e(\Illuminate\Support\Str::limit($cat->title, 15))); ?>

                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="tab-content" id="audioTabsContent">
                    <?php $__currentLoopData = $audioCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade <?php echo e($i === 0 ? 'show active' : ''); ?>" id="audio-<?php echo e($cat->id); ?>"
                            role="tabpanel" aria-labelledby="audio-tab-<?php echo e($cat->id); ?>">
                            <div class="background_color">
                                <?php
                                    $audios = $cat->audios ?? collect();
                                ?>

                                <?php $__empty_1 = true; $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $rawFile = $audio->audio_file ?? null;
                                        $isExternal = false;
                                        $downloadUrl = null;

                                        if (!empty($rawFile)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($rawFile, ['http://', 'https://'])
                                            ) {
                                                $isExternal = true;
                                                $downloadUrl = $rawFile;
                                            } else {
                                                $downloadUrl = route('frontend.audios.download', $audio->id);
                                            }
                                        }
                                    ?>

                                    <div
                                        class="audio-play-wrapp d-flex justify-content-between align-items-center mb-2">
                                        <div class="flex-1 me-1">
                                            <h5 class="card-title mb-0 a_font_size">
                                                <a
                                                    href="<?php echo e(route('frontend.audios.show', $audio->slug ?? $audio->id)); ?>">
                                                    <?php echo e(e(\Illuminate\Support\Str::limit($audio->title, 80))); ?>

                                                </a>
                                            </h5>
                                            <?php if(!empty($audio->author)): ?>
                                                <small class="d-block text-muted"><?php echo e(e($audio->author)); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="button-wrapp pt-15 d-flex flex-nowrap gap-2 ms-1">
                                            <a href="<?php echo e(route('frontend.audios.show', $audio->slug ?? $audio->id)); ?>"
                                                class="th-btn style1 th-btn1"
                                                aria-label="تشغيل <?php echo e(e($audio->title)); ?>">
                                                <span class="btn-text" data-back=" تشغيل" data-front=" تشغيل"></span>
                                                <i class="fa-solid fa-play me-2"></i>
                                            </a>

                                            <?php if($downloadUrl): ?>
                                                <?php if($isExternal): ?>
                                                    <a href="<?php echo e($downloadUrl); ?>" target="_blank"
                                                        rel="noopener noreferrer" class="th-btn style2 th-btn1"
                                                        aria-label="فتح/تحميل <?php echo e(e($audio->title)); ?>">
                                                        <span class="btn-text" data-back=" تحميل"
                                                            data-front=" تحميل"></span>
                                                        <i class="fa-regular fa-arrow-down-to-line me-2"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e($downloadUrl); ?>" class="th-btn style2 th-btn1"
                                                        download aria-label="تحميل <?php echo e(e($audio->title)); ?>">
                                                        <span class="btn-text" data-back=" تحميل"
                                                            data-front=" تحميل"></span>
                                                        <i class="fa-regular fa-arrow-down-to-line me-2"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="p-3">
                                        <em>لا توجد صوتيات في هذا التصنيف حالياً.</em>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>

            <div class="col-xxl-5 col-lg-5">
                <aside class="sidebar-area ">
                    <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                        <h3 class="widget_title mb-0 wow fadeInRight" data-wow-delay=".3s">الدرر السنية</h3>

                        <div class="btn-group">
                            <a href="<?php echo e(route('frontend.durars.index')); ?>" class="th-btn style1">
                                <span class="btn-text" data-back=" المزيد" data-front=" المزيد"></span>
                            </a>
                        </div>
                    </div>


                    <div class="widget widget_categories fadeInUp wow mb-0 new_efect" data-wow-delay=".4s">
                        <ul class="styled-list">
                            <?php if(!empty($durars) && $durars->count()): ?>
                                <?php $__currentLoopData = $durars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="wow fadeInRight" data-wow-delay=".<?php echo e($loop->index + 1); ?>s">
                                        <a href="<?php echo e(route('frontend.durars.show', $d->slug)); ?>">
                                            <?php echo e(e(\Illuminate\Support\Str::limit($d->title, 80))); ?>

                                            <i class="fa-solid fa-arrow-left float-start"></i>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li class="text-muted">لا توجدش درر لعرضها حالياً.</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </aside>
            </div>
        </div>
    </section>
<?php endif; ?>

<style>
    @media (max-width: 991px) {
        .sidebar-area {
            padding-top: 80px;
        }

        .widget_title_new {
            margin-top: 30px;
        }
    }
</style>
<?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/frontend/sections/lectuers.blade.php ENDPATH**/ ?>