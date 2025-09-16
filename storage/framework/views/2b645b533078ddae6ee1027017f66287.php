<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-toggle-on"></i> حالة الموقع
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.site_status.edit', 4)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label class="form-label">حالة الموقع</label>
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="site_status" id="status_active"
                                value="active"
                                <?php echo e(isset($site_status->value) && $site_status->value === 'active' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="status_active">
                                مفعل
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="site_status" id="status_inactive"
                                value="inactive"
                                <?php echo e(isset($site_status->value) && $site_status->value === 'inactive' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="status_inactive">
                                معطل
                            </label>
                        </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/site_status/index.blade.php ENDPATH**/ ?>