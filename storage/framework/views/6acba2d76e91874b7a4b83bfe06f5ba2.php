<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-info-circle"></i> بيانات الموقع
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.site_infos.edit', 1)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_name" class="form-label">اسم الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_name" id="site_name" class="form-control"
                            value="<?php echo e($site_name->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_description" class="form-label">وصف الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="site_description" id="site_description" class="form-control" rows="5"><?php echo e($site_description->value ?? ''); ?></textarea>
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_keywords" class="form-label">الكلمات المفتاحية</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_keywords" id="site_keywords" class="form-control"
                            value="<?php echo e($site_keywords->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_link" class="form-label">رابط الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_link" id="site_link" class="form-control"
                            value="<?php echo e($site_link->value ?? ''); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> حفظ
                        </button>
                        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-outline-danger">
                            <i class="fa fa-times me-2"></i> إلغاء
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/site_infos/index.blade.php ENDPATH**/ ?>