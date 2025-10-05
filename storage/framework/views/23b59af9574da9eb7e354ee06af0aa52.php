<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('backend/vendors/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    <?php echo e(__('panel.edit_supervisor')); ?> (<?php echo e($supervisor->full_name); ?>)
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> /</li>
                    <li class="ms-1"><a
                            href="<?php echo e(route('admin.supervisors.index')); ?>"><?php echo e(__('panel.manage_supervisors')); ?></a></li>
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

            <form action="<?php echo e(route('admin.supervisors.update', $supervisor->id)); ?>" method="post"
                enctype="multipart/form-data" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="first_name"><?php echo e(__('panel.first_name')); ?></label>
                        <input type="text" name="first_name" id="first_name"
                            value="<?php echo e(old('first_name', $supervisor->first_name)); ?>" class="form-control">
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
                        <input type="text" name="last_name" id="last_name"
                            value="<?php echo e(old('last_name', $supervisor->last_name)); ?>" class="form-control">
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
                        <input type="text" name="username" id="username"
                            value="<?php echo e(old('username', $supervisor->username)); ?>" class="form-control">
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
                        <input type="email" name="email" id="email" value="<?php echo e(old('email', $supervisor->email)); ?>"
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
                        <input type="text" name="mobile" id="mobile"
                            value="<?php echo e(old('mobile', $supervisor->mobile)); ?>" class="form-control">
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
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="<?php echo e(__('panel.leave_blank_keep_current')); ?>">
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
                            <option value="1" <?php echo e(old('status', $supervisor->status) == 1 ? 'selected' : ''); ?>>
                                <?php echo e(__('panel.active')); ?></option>
                            <option value="0" <?php echo e(old('status', $supervisor->status) == 0 ? 'selected' : ''); ?>>
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
                        <label for="permissions"><?php echo e(__('panel.permissions')); ?></label>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($perm->id); ?>"
                                    <?php echo e(in_array($perm->id, old('permissions', $supervisorPermissions)) ? 'selected' : ''); ?>>
                                    <?php echo e($perm->display_name); ?>

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
                        <input type="file" name="user_image" id="supervisor-image"
                            class="file-input-overview form-control-file">
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
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i> <?php echo e(__('panel.update')); ?>

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
            $('#permissions').select2({
                tags: true,
                placeholder: '<?php echo e(__('panel.select_permissions')); ?>',
                closeOnSelect: false,
                width: '100%'
            });

            $('#supervisor-image').fileinput({
                theme: 'fa',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                showZoom: true,
                <?php if($supervisor->user_image): ?>
                    initialPreview: ["<?php echo e(asset('assets/users/' . $supervisor->user_image)); ?>"],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [{
                        caption: "<?php echo e($supervisor->user_image); ?>",
                        size: <?php echo e(file_exists(public_path("assets/users/{$supervisor->user_image}")) ? filesize(public_path("assets/users/{$supervisor->user_image}")) : 0); ?>,
                        width: "120px",
                        url: "<?php echo e(route('admin.supervisors.remove_image', ['supervisor_id' => $supervisor->id, '_token' => csrf_token()])); ?>",
                        key: <?php echo e($supervisor->id); ?>

                    }],
                <?php endif; ?>
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/backend/supervisors/edit.blade.php ENDPATH**/ ?>