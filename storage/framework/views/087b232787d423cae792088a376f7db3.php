<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-users"></i> المجتمع والتطبيق
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.community_links.edit', 7)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_community_link" class="form-label">رابط المجتمع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_community_link" id="site_community_link" class="form-control"
                            value="<?php echo e($site_community_link->value ?? ''); ?>">
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_app_link" class="form-label">رابط التطبيق</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_app_link" id="site_app_link" class="form-control"
                            value="<?php echo e($site_app_link->value ?? ''); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> حفظ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/site_community/index.blade.php ENDPATH**/ ?>