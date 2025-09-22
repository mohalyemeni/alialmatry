<div class="card-body">
    <form action="<?php echo e(route('admin.audios.index')); ?>" method="get">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-8 col-sm-7 ">
                <div class="form-group">
                    <input type="text" name="keyword" value="<?php echo e(old('keyword', request()->input('keyword'))); ?>"
                        class="form-control" placeholder="<?php echo e(__('panel.keyword')); ?>">
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value=""> <?php echo e(__('panel.show_all')); ?></option>
                        <option value="1" <?php echo e(old('status', request()->input('status')) == '1' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.status_active')); ?>

                        </option>
                        <option value="0" <?php echo e(old('status', request()->input('status')) == '0' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.status_inactive')); ?>

                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-sm-block col-sm-2 ">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="" selected><?php echo e(__('panel.show_all')); ?></option>
                        <option value="published_on"
                            <?php echo e(old('sort_by', request()->input('sort_by')) == 'published_on' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.published_on')); ?>

                        </option>
                        <option value="created_at"
                            <?php echo e(old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.created_at')); ?>

                        </option>
                        <option value="id"
                            <?php echo e(old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.id')); ?>

                        </option>
                        <option value="title"
                            <?php echo e(old('sort_by', request()->input('sort_by')) == 'title' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.title')); ?>

                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="asc"
                            <?php echo e(old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.asc')); ?>

                        </option>
                        <option value="desc"
                            <?php echo e(old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : ''); ?>>
                            <?php echo e(__('panel.desc')); ?>

                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10"
                            <?php echo e(old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : ''); ?>>10</option>
                        <option value="20"
                            <?php echo e(old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : ''); ?>>20</option>
                        <option value="50"
                            <?php echo e(old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : ''); ?>>50</option>
                        <option value="100"
                            <?php echo e(old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : ''); ?>>100</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-4 col-sm-3 d-flex justify-content-end">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        <i class="fa fa-search "></i>
                        <?php echo e(__('panel.search')); ?>

                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/audio/filter/filter.blade.php ENDPATH**/ ?>