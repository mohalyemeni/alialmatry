<?php if(isset($audioCategories) && $audioCategories->count()): ?>
    <section>
        <div class="pb_80 row spical m-0 padding_top" dir="rtl">
            <h3 class="widget_title title-header-noline mb-5 wow fadeInRight" data-wow-delay=".3s">الصوتيات</h3>

            <section class="tabs-section col-lg-8 col-12">
                <ul class="nav nav-tabs    " id="audioTabs" role="tablist">
                    <?php $__currentLoopData = $audioCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo e($i === 0 ? 'active' : ''); ?> btn_font_size"
                                id="audio-tab-<?php echo e($cat->id); ?>" data-bs-toggle="tab"
                                data-bs-target="#audio-<?php echo e($cat->id); ?>" type="button" role="tab"
                                aria-controls="audio-<?php echo e($cat->id); ?>"
                                aria-selected="<?php echo e($i === 0 ? 'true' : 'false'); ?>">

                                <?php echo e(e(\Illuminate\Support\Str::limit($cat->title, 10))); ?>

                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="tab-content    " id="audioTabsContent">
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
                                        $downloadUrl = null;
                                        if (!empty($rawFile)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($rawFile, ['http://', 'https://'])
                                            ) {
                                                $downloadUrl = $rawFile;
                                            } else {
                                                $downloadUrl = asset($rawFile);
                                            }
                                        }
                                    ?>

                                    <div
                                        class="audio-play-wrapp d-flex justify-content-between align-items-center   mb-2">
                                        <div class="flex-1">
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

                                        <div class="button-wrapp pt-15 d-flex flex-nowrap gap-2  ">
                                            <a href="<?php echo e(route('frontend.audios.show', $audio->slug ?? $audio->id)); ?>"
                                                class="th-btn style1 th-btn1"
                                                aria-label="تشغيل <?php echo e(e($audio->title)); ?>">
                                                <span class="btn-text" data-back=" تشغيل" data-front=" تشغيل"></span>
                                                <i class="fa-solid fa-play me-1"></i>
                                            </a>

                                            <?php if($downloadUrl): ?>
                                                <a href="<?php echo e($downloadUrl); ?>" download class="th-btn style2 th-btn1"
                                                    aria-label="تحميل <?php echo e(e($audio->title)); ?>">
                                                    <span class="btn-text" data-back=" تحميل"
                                                        data-front=" تحميل"></span>
                                                    <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                                </a>
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

            <div class="col-xxl-4 col-lg-4">
                <aside class="sidebar-area ">
                    <h3 class="widget_title widget_title_new  mb-5 fadeInRight wow " data-wow-delay=".3s">الدرر السنية
                    </h3>

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
                                <li class="text-muted">لا توجد درر لعرضها حالياً.</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-4 px-1 fadeInLeft wow"
                        data-wow-delay=".7s">
                        <a href="<?php echo e(route('frontend.durars.index')); ?>" class="th-btn new_pad">
                            قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                        </a>
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
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/frontend/sections/lectuers.blade.php ENDPATH**/ ?>