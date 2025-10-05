<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('backend/vendors/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    <?php echo e(__('panel.add_supervisor')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> /</li>
                    <li class="ms-1">
                        <a href="<?php echo e(route('admin.supervisors.index')); ?>"><?php echo e(__('panel.manage_supervisors')); ?></a>
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

            <form action="<?php echo e(route('admin.supervisors.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
                <?php echo csrf_field(); ?>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="first_name"><?php echo e(__('panel.first_name')); ?></label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>"
                            class="form-control">
                        <?php $__errorArgs = ['first_name'];
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

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="last_name"><?php echo e(__('panel.last_name')); ?></label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>"
                            class="form-control">
                        <?php $__errorArgs = ['last_name'];
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

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="username"><?php echo e(__('panel.username')); ?></label>
                        <input type="text" name="username" id="username" value="<?php echo e(old('username')); ?>"
                            class="form-control">
                        <?php $__errorArgs = ['username'];
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

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="email"><?php echo e(__('panel.email')); ?></label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                            class="form-control">
                        <?php $__errorArgs = ['email'];
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
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="mobile"><?php echo e(__('panel.mobile')); ?></label>
                        <input type="text" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>"
                            class="form-control">
                        <?php $__errorArgs = ['mobile'];
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

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="password"><?php echo e(__('panel.password')); ?></label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?php $__errorArgs = ['password'];
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

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="status"><?php echo e(__('panel.status')); ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" <?php echo e(old('status', '1') === '1' ? 'selected' : ''); ?>>
                                <?php echo e(__('panel.active')); ?></option>
                            <option value="0" <?php echo e(old('status') === '0' ? 'selected' : ''); ?>>
                                <?php echo e(__('panel.inactive')); ?></option>
                        </select>
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

                <div class="row mt-3">
                    
                    <div class="col-sm-12 col-md-12 pt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="permissions"><?php echo e(__('panel.permissions')); ?></label>
                            <button type="button" id="select-all-btn" class="btn btn-outline-primary btn-sm tahdeed">
                                تحديد الكل
                            </button>
                        </div>

                        <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($permission->id); ?>"
                                    <?php echo e(in_array($permission->id, old('permissions', [])) ? 'selected' : ''); ?>>
                                    <?php echo e($permission->display_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <?php $__errorArgs = ['permissions'];
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

                    
                    <div class="col-sm-12 col-md-12 pt-3">
                        <label for="supervisor-image"><?php echo e(__('panel.profile_image')); ?></label>
                        <input type="file" name="user_image" id="supervisor-image" class="file-input-overview">
                        <small class="form-text text-muted"><?php echo e(__('panel.image_recommendation')); ?></small>
                        <?php $__errorArgs = ['user_image'];
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

                
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i> <?php echo e(__('panel.save')); ?>

                        </button>
                        <a href="<?php echo e(route('admin.supervisors.index')); ?>" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> <?php echo e(__('panel.cancel')); ?>

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
            // تهيئة Select2
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                placeholder: '<?php echo e(__('panel.select_permissions')); ?>',
                width: '100%',
                closeOnSelect: false
            });

            // تهيئة رفع الصورة
            $('#supervisor-image').fileinput({
                theme: 'fa',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                fileActionSettings: {
                    showZoom: true,
                    showRemove: true,
                    showDrag: true,
                    zoomIcon: '<i class="fas fa-search-plus"></i>',
                    removeIcon: '<i class="fas fa-trash"></i>',
                    dragIcon: '<i class="fas fa-arrows-alt"></i>',
                    rotateIcon: '<i class="fas fa-sync-alt"></i>'
                }
            });

            // زر تحديد الكل / إلغاء التحديد
            let allSelected = false;

            $("#select-all-btn").on("click", function() {
                if (!allSelected) {
                    $("#permissions > option").prop("selected", true);
                    $("#permissions").trigger("change");
                    $(this).text("إلغاء التحديد");
                    $(this).removeClass("btn-outline-primary").addClass("btn-outline-danger");
                } else {
                    $("#permissions > option").prop("selected", false);
                    $("#permissions").trigger("change");
                    $(this).text("تحديد الكل");
                    $(this).removeClass("btn-outline-danger").addClass("btn-outline-primary");
                }
                allSelected = !allSelected;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/backend/supervisors/create.blade.php ENDPATH**/ ?>