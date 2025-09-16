<div>
    <!--[if BLOCK]><![endif]--><?php if($debug): ?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="pt-80 overflow-hidden space-extra-bottom" id="faq-sec" wire:init>
        <div class="container">
            <div class="row flex-row-reverse">

                <div class="col-xxl-8 col-lg-8">
                    <div class="accordion-area style2 load-more-active accordion" id="faqAccordion">
                        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow">الفتاوى</h3>

                        <!--[if BLOCK]><![endif]--><?php if(!empty($fatawas) && count($fatawas)): ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fatawas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-card style2 <?php echo e($index === 0 ? 'active' : ''); ?> fadeInUp wow"
                                    data-wow-delay="<?php echo e(0.2 + $index * 0.1); ?>s" wire:key="faq-<?php echo e($faq->id); ?>">
                                    <div class="accordion-header" id="collapse-item-<?php echo e($index + 1); ?>">
                                        <button class="accordion-button <?php echo e($index !== 0 ? 'collapsed' : ''); ?>"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-<?php echo e($index + 1); ?>"
                                            aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                            aria-controls="collapse-<?php echo e($index + 1); ?>">
                                            <span><?php echo e($index + 1); ?>.</span> <?php echo e(e($faq->title)); ?>

                                        </button>
                                    </div>

                                    <div id="collapse-<?php echo e($index + 1); ?>"
                                        class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                                        aria-labelledby="collapse-item-<?php echo e($index + 1); ?>"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="faq-text"><?php echo e(e($faq->excerpt)); ?></p>
                                            <div class="d-flex mt-2 fadeInRight wow">
                                                <a href="<?php echo e(route('frontend.fatawas.show', $faq->slug)); ?>"
                                                    class="th-btn new_pad me-auto">
                                                    قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php else: ?>
                            <p class="text-muted">لا توجد فتاوى حالياً.</p>

                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <div class="d-flex justify-content-between align-items-center mt-3 px-1">
                            <div class="fw-bold flex_mine fadeInUp wow">
                                <p class="tags text-muted">عدد الفتاوى</p>
                                <span class="num_fata count_span"><?php echo e(isset($fatawas) ? count($fatawas) : 0); ?></span>
                            </div>
                            <a href="<?php echo e(route('frontend.fatawas.index')); ?>" class="th-btn new_pad fadeInRight wow">
                                قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4">
                    <aside class="sidebar-area">
                        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow">تصنيفات الفتاوى</h3>

                        <div class="widget widget_categories fadeInUp wow mb-0 new_efect" data-wow-delay=".4s">
                            <ul class="styled-list">
                                <!--[if BLOCK]><![endif]--><?php if(!empty($categories) && count($categories)): ?>
                                    <li class="wow fadeInRight" data-wow-delay=".1s">
                                        <a href="#" wire:click.prevent="selectCategory(null)"
                                            class="<?php echo e($selectedCategoryId === null ? 'fw-bold text-primary' : ''); ?>">
                                            كل الفتاوى
                                            <i class="fa-solid fa-arrow-left float-start"></i>
                                        </a>
                                    </li>

                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="wow fadeInRight <?php echo e($selectedCategoryId === $c->id ? 'active' : ''); ?>"
                                            data-wow-delay=".<?php echo e($loop->index + 1); ?>s"
                                            wire:key="cat-<?php echo e($c->id); ?>">
                                            <a href="#"
                                                wire:click.prevent="selectCategoryById(<?php echo e($c->id); ?>)"
                                                class="d-block text-end text-decoration-none <?php echo e($selectedCategoryId === $c->id ? 'fw-bold text-primary' : ''); ?>">
                                                <?php echo e(e(\Illuminate\Support\Str::limit($c->name ?? ($c->title ?? $c->slug), 80))); ?>

                                                <i class="fa-solid fa-arrow-left float-start"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <?php else: ?>
                                    <li class="text-muted">لا توجد تصنيفات لعرضها حالياً.</li>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </ul>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-4 px-1 fadeInLeft wow">
                            <a href="<?php echo e(route('frontend.fatawas.index')); ?>" class="th-btn new_pad">
                                قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
            });

            window.addEventListener('fatawa-debug', function(e) {
                console.log("FATAWA DEBUG:", e.detail);
                if (Array.isArray(e.detail.messages)) {
                    const debugOutput = document.getElementById('debug-output');
                    if (debugOutput) {
                        let html = '';
                        e.detail.messages.forEach(m => {
                            html += '<div style="border-bottom: 1px solid #333; padding: 5px 0;">' +
                                m + '</div>';
                        });
                        debugOutput.innerHTML = html;
                        debugOutput.scrollTop = debugOutput.scrollHeight;
                    }

                    // أيضًا طباعة في console للمطورين
                    e.detail.messages.forEach(m => console.log(m));
                }
            });
        });

        Livewire.on('fatawasLoaded', () => {
            console.log('fatawas updated via Livewire');
        });
    </script>

</div>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/livewire/frontend/fatawa-widget.blade.php ENDPATH**/ ?>