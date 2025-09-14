<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    <?php echo e(__('panel.add_blog_category')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> /
                    </li>
                    <li class="ms-1">
                        <a href="<?php echo e(route('admin.blog_categories.index')); ?>"><?php echo e(__('panel.manage_blog_categories')); ?></a>
                    </li>
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

            <form action="<?php echo e(route('admin.blog_categories.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true"><?php echo e(__('panel.content')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false"><?php echo e(__('panel.seo')); ?>

                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="title"><?php echo e(__('panel.title')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>"
                                    class="form-control">
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

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="description"><?php echo e(__('panel.content')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10" class="form-control summernote"><?php echo old('description'); ?></textarea>
                                <?php $__errorArgs = ['description'];
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



                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="img">
                                    <?php echo e(__('panel.image')); ?>

                                    <br>
                                    <small><?php echo e(__('panel.best_size')); ?></small>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="img" id="img" class="file-input-overview">
                                </div>
                                <?php $__errorArgs = ['img'];
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



                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <?php echo e(__('panel.publish_date')); ?>

                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on" value="<?php echo e(old('published_on')); ?>"
                                        class="form-control" placeholder="<?php echo e(__('panel.publish_date')); ?>" data-input>
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

                        
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label"><?php echo e(__('panel.status')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3 d-flex align-items-center gap-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" <?php echo e(old('status', '1') == '1' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="status_active"><?php echo e(__('panel.active')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" <?php echo e(old('status') == '0' ? 'checked' : ''); ?>>
                                    <label class="form-check-label"
                                        for="status_inactive"><?php echo e(__('panel.inactive')); ?></label>
                                </div>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger d-block mt-2"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="featured" class="control-label"><?php echo e(__('panel.featured') ?? 'مميز'); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                
                                <input type="hidden" name="featured" id="featured_input"
                                    value="<?php echo e(old('featured') ? 1 : 0); ?>">
                                <button type="button" id="featured_btn" class="btn btn-light p-2"
                                    aria-pressed="<?php echo e(old('featured') ? 'true' : 'false'); ?>">
                                    <i id="featured_icon"
                                        class="<?php echo e(old('featured') ? 'fas fa-star text-warning' : 'far fa-star text-muted'); ?>"
                                        style="font-size:1.6em;"></i>
                                </button>
                                <?php $__errorArgs = ['featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger d-block mt-2"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_slug"><?php echo e(__('panel.seo_slug')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug" value="<?php echo e(old('meta_slug')); ?>"
                                    class="form-control">
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
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_description"><?php echo e(__('panel.seo_description')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_description" id="meta_description"
                                    value="<?php echo e(old('meta_description')); ?>" class="form-control">
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
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_keywords"><?php echo e(__('panel.seo_keywords')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input name="meta_keywords" id="meta_keywords" value="<?php echo e(old('meta_keywords')); ?>"
                                    class="form-control" />
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
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                        <div class="col-sm-12 col-md-10 pt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-lg me-2" data-feather="corner-down-left"></i>
                                <?php echo e(__('panel.save')); ?>

                            </button>
                            <a href="<?php echo e(route('admin.blog_categories.index')); ?>" class="btn btn-outline-danger">
                                <i class="icon-lg me-2" data-feather="x"></i>
                                <?php echo e(__('panel.cancel')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backend/vendors/select2/select2.min.js')); ?>"></script>

    <script>
        $(function() {
            $("#img").fileinput({
                theme: "fa5",
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                maxFileCount: 1
            });
        });
    </script>

    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "<?php echo e(old('published_on')); ?>" ? "<?php echo e(old('published_on')); ?>" : new Date();
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
        });
    </script>

    <script>
        $(function() {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>

    
    <script>
        $(function() {
            $('#featured_btn').on('click', function() {
                var $input = $('#featured_input');
                var $icon = $('#featured_icon');
                var is = $input.val() === '1';
                if (is) {
                    $input.val('0');
                    $icon.removeClass('fas text-warning').addClass('far text-muted');
                    $(this).attr('aria-pressed', 'false');
                } else {
                    $input.val('1');
                    $icon.removeClass('far text-muted').addClass('fas text-warning');
                    $(this).attr('aria-pressed', 'true');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/blog_categories/create.blade.php ENDPATH**/ ?>