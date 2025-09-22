<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i> <?php echo e(__('panel.edit_useful_link')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index_route')); ?>"><?php echo e(__('panel.home')); ?></a> /</li>
                    <li class="ms-1"><a
                            href="<?php echo e(route('admin.useful_links.index')); ?>"><?php echo e(__('panel.manage_useful_links')); ?></a> /</li>
                    <li class="ms-1"><a href=""><?php echo e($link->title); ?></a></li>
                </ul>
            </div>
        </div>

        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger pt-0 pb-0 mb-0">
                    <ul class="px-2 py-3 m-0" style="list-style-type: circle">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.useful_links.update', $link->id)); ?>" method="POST" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            <?php echo e(__('panel.content')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false">
                            <?php echo e(__('panel.seo')); ?>

                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <!-- Title -->
                        <div class="row mt-3">
                            <label for="title" class="col-sm-12 col-md-2 pt-3"><?php echo e(__('panel.title')); ?></label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title"
                                    value="<?php echo e(old('title', $link->title)); ?>"
                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- URL -->
                        <div class="row mt-3">
                            <label for="url" class="col-sm-12 col-md-2 pt-3"><?php echo e(__('panel.url')); ?></label>
                            <div class="col-sm-12 col-md-10 pt-3 d-flex flex-column flex-md-row gap-2">
                                <input type="url" name="url" id="url" value="<?php echo e(old('url', $link->url)); ?>"
                                    class="form-control <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="https://example.com" required>
                                <div class="d_ruby align-items-center">
                                    <?php if($link->url): ?>
                                        <a href="<?php echo e($link->url); ?>" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-outline-primary me-2">
                                            <i class="fas fa-external-link-alt"></i> <span>
                                                <?php echo e(__('panel.open_link')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Publish date -->
                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3"><?php echo e(__('panel.publish_date')); ?></label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="<?php echo e(old('published_on', $link->published_on?->format('Y-m-d H:i'))); ?>"
                                        class="form-control" placeholder="<?php echo e(__('panel.publish_date')); ?>" data-input
                                        required>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['published_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mt-3">
                            <label for="status"
                                class="col-sm-12 col-md-2 pt-3 control-label"><?php echo e(__('panel.status')); ?></label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" <?php echo e(old('status', $link->status) == '1' ? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="status_active"><?php echo e(__('panel.active')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" <?php echo e(old('status', $link->status) == '0' ? 'checked' : ''); ?>

                                        required>
                                    <label class="form-check-label"
                                        for="status_inactive"><?php echo e(__('panel.inactive')); ?></label>
                                </div>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row mt-3">
                            <label for="meta_slug" class="col-sm-12 col-md-3 pt-3"><?php echo e(__('panel.seo_slug')); ?></label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug"
                                    value="<?php echo e(old('meta_slug', $link->meta_slug)); ?>" class="form-control">
                                <?php $__errorArgs = ['meta_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="meta_keywords"
                                class="col-sm-12 col-md-3 pt-3"><?php echo e(__('panel.seo_keywords')); ?></label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input name="meta_keywords" id="tags1"
                                    value="<?php echo e(old('meta_keywords', $link->meta_keywords)); ?>" class="form-control" />
                                <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="meta_description"
                                class="col-sm-12 col-md-3 pt-3"><?php echo e(__('panel.seo_description')); ?></label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control"><?php echo e(old('meta_description', $link->meta_description)); ?></textarea>
                                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="save"></i> <?php echo e(__('panel.update')); ?>

                        </button>
                        <a href="<?php echo e(route('admin.useful_links.index')); ?>" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> <?php echo e(__('panel.cancel')); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "<?php echo e(old('published_on', $link->published_on?->format('Y-m-d H:i'))); ?>" ?
                    "<?php echo e(old('published_on', $link->published_on?->format('Y-m-d H:i'))); ?>" : new Date();
                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "Y/m/d h:i K",
                    locale: locale,
                    defaultDate: defaultDate,
                });
            }

            // إذا تستخدم مكتبة tags input يمكنك تفعيلها هنا
            // $('#tags1').tagsinput();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/useful_links/edit.blade.php ENDPATH**/ ?>