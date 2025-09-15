<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    <?php echo e(__('panel.edit_audio_category')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> /
                    </li>
                    <li class="ms-1">
                        <a href="<?php echo e(route('admin.audio_categories.index')); ?>"><?php echo e(__('panel.manage_audio_categories')); ?></a> /
                    </li>
                    <li class="ms-1"><?php echo e($category->title); ?></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.audio_categories.update', $category->id)); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <ul class="nav nav-tabs mb-4" id="editTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            <?php echo e(__('panel.content')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false">
                            <?php echo e(__('panel.seo')); ?>

                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="editTabContent">

                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label"><?php echo e(__('panel.title')); ?></label>
                            <div class="col-md-10">
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?php echo e(old('title', $category->title)); ?>">
                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label"><?php echo e(__('panel.content')); ?></label>
                            <div class="col-md-10">
                                <textarea id="description" name="description" class="form-control summernote" rows="6"><?php echo old('description', $category->description); ?></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="img" class="col-md-2 col-form-label">
                                <?php echo e(__('panel.image')); ?><br><small><?php echo e(__('panel.best_size')); ?></small>
                            </label>
                            <div class="col-md-10">
                                <input type="file" id="img" name="img"
                                    class="form-control-file file-input-overview">
                                <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="published_on"
                                class="col-md-2 col-form-label"><?php echo e(__('panel.publish_date')); ?></label>
                            <div class="col-md-10">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" id="published_on" name="published_on" class="form-control"
                                        placeholder="<?php echo e(__('panel.publish_date')); ?>" data-input
                                        value="<?php echo e(old('published_on', optional($category->published_on)->format('Y-m-d H:i'))); ?>">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['published_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label"><?php echo e(__('panel.status')); ?></label>
                            <div class="col-md-10 d-flex align-items-center gap-3 flex-wrap">
                                <div class="form-check form-check-inline me-3">
                                    <input type="radio" id="status_active" name="status" value="1"
                                        class="form-check-input"
                                        <?php echo e(old('status', (string) $category->status) == '1' ? 'checked' : ''); ?>>
                                    <label for="status_active" class="form-check-label"><?php echo e(__('panel.active')); ?></label>
                                </div>
                                <div class="form-check form-check-inline me-3">
                                    <input type="radio" id="status_inactive" name="status" value="0"
                                        class="form-check-input"
                                        <?php echo e(old('status', (string) $category->status) == '0' ? 'checked' : ''); ?>>
                                    <label for="status_inactive"
                                        class="form-check-label"><?php echo e(__('panel.inactive')); ?></label>
                                </div>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small d-block mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label"
                                for="featured"><?php echo e(__('panel.featured') ?? 'مميز'); ?></label>
                            <div class="col-md-10">
                                
                                <input type="hidden" name="featured" id="featured_input"
                                    value="<?php echo e(old('featured', $category->featured) ? 1 : 0); ?>">
                                <button type="button" id="featured_btn" class="btn btn-light p-2"
                                    aria-pressed="<?php echo e(old('featured', $category->featured) ? 'true' : 'false'); ?>">
                                    <i id="featured_icon"
                                        class="<?php echo e(old('featured', $category->featured) ? 'fas fa-star text-warning' : 'far fa-star text-muted'); ?>"
                                        style="font-size:1.6em;"></i>
                                </button>
                                <?php $__errorArgs = ['featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small d-block mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="mb-3 row">
                            <label for="meta_slug" class="col-md-3 col-form-label"><?php echo e(__('panel.seo_slug')); ?></label>
                            <div class="col-md-9">
                                <input type="text" id="meta_slug" name="meta_slug" class="form-control"
                                    value="<?php echo e(old('meta_slug', $category->meta_slug)); ?>">
                                <?php $__errorArgs = ['meta_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="meta_description"
                                class="col-md-3 col-form-label"><?php echo e(__('panel.seo_description')); ?></label>
                            <div class="col-md-9">
                                <input type="text" id="meta_description" name="meta_description" class="form-control"
                                    value="<?php echo e(old('meta_description', $category->meta_description)); ?>">
                                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="meta_keywords"
                                class="col-md-3 col-form-label"><?php echo e(__('panel.seo_keywords')); ?></label>
                            <div class="col-md-9">
                                <input type="text" id="meta_keywords" name="meta_keywords" class="form-control"
                                    value="<?php echo e(old('meta_keywords', $category->meta_keywords)); ?>">
                                <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
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
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i>
                            <?php echo e(__('panel.save_changes')); ?>

                        </button>
                        <a href="<?php echo e(route('admin.audio_categories.index')); ?>" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i>
                            <?php echo e(__('panel.cancel')); ?>

                        </a>
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
                maxFileCount: 1,
                initialPreview: [
                    <?php if($category->img): ?>
                        "<?php echo e(asset('assets/audio_categories/' . $category->img)); ?>"
                    <?php endif; ?>
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    <?php if($category->img): ?>
                        {
                            caption: "<?php echo e(basename($category->img)); ?>",
                            url: "<?php echo e(route('admin.audio_categories.remove_image')); ?>",
                            key: "<?php echo e($category->id); ?>",
                            extra: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                key: "<?php echo e($category->id); ?>"
                            }
                        }
                    <?php endif; ?>
                ],
                fileActionSettings: {
                    showZoom: true,
                    showRemove: true,
                    zoomIcon: '<i class="fas fa-search-plus"></i>',
                    removeIcon: '<i class="fas fa-trash"></i>',
                }
            });
        });
    </script>

    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate =
                    "<?php echo e(old('published_on', optional($category->published_on)->format('Y-m-d H:i'))); ?>" ?
                    "<?php echo e(old('published_on', optional($category->published_on)->format('Y-m-d H:i'))); ?>" :
                    new Date();
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
                var is = $input.val() === '1' || $input.val() === 1 || $input.val() === 'true';
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/audio_categories/edit.blade.php ENDPATH**/ ?>