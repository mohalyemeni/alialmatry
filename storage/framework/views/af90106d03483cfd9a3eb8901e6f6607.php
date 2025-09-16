<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-image"></i> تنسيقات الموقع
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.site_style.edit', 5)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_logo_light" class="form-label">شعار فاتح</label>
                    </div>
                    <div class="col-md-10">
                        <?php if(isset($site_logo_light->value)): ?>
                            <img src="<?php echo e(asset('assets/site_settings/' . $site_logo_light->value)); ?>"
                                class="img-thumbnail mb-2" style="max-height: 80px;">
                        <?php endif; ?>
                        <input type="file" name="site_logo_light" id="site_logo_light" class="form-control">
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_logo_dark" class="form-label">شعار داكن</label>
                    </div>
                    <div class="col-md-10">
                        <?php if(isset($site_logo_dark->value)): ?>
                            <img src="<?php echo e(asset('assets/site_settings/' . $site_logo_dark->value)); ?>"
                                class="img-thumbnail mb-2" style="max-height: 80px;">
                        <?php endif; ?>
                        <input type="file" name="site_logo_dark" id="site_logo_dark" class="form-control">
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_favicon" class="form-label">فافيكون</label>
                    </div>
                    <div class="col-md-10">
                        <?php if(isset($site_favicon->value)): ?>
                            <img src="<?php echo e(asset('assets/site_settings/' . $site_favicon->value)); ?>"
                                class="img-thumbnail mb-2" style="max-height: 50px;">
                        <?php endif; ?>
                        <input type="file" name="site_favicon" id="site_favicon" class="form-control">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/site_formats/index.blade.php ENDPATH**/ ?>