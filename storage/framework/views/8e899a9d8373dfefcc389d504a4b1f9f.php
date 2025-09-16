<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-address-book"></i> بيانات التواصل
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.site_contacts.edit', 2)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_address" class="form-label">العنوان</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_address" id="site_address" class="form-control"
                            value="<?php echo e($site_address->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_mobile" class="form-label">الهاتف</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_mobile" id="site_mobile" class="form-control"
                            value="<?php echo e($site_mobile->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_fax" class="form-label">الفاكس</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_fax" id="site_fax" class="form-control"
                            value="<?php echo e($site_fax->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_email" class="form-label">البريد الإلكتروني</label>
                    </div>
                    <div class="col-md-10">
                        <input type="email" name="site_email" id="site_email" class="form-control"
                            value="<?php echo e($site_email->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_workTime" class="form-label">أوقات العمل</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_workTime" id="site_workTime" class="form-control"
                            value="<?php echo e($site_workTime->value ?? ''); ?>">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/site_contacts/index.blade.php ENDPATH**/ ?>