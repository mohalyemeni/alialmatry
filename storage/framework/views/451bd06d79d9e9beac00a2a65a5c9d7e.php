<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-user-shield"></i>
                    <?php echo e(__('panel.manage_supervisors')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> \</li>
                    <li class="ms-1"><?php echo e(__('panel.supervisors_list')); ?></li>
                </ul>
            </div>
            <div class="ml-auto">
                <?php if (\Entrust::ability('admin', 'create_supervisors')) : ?>
                    <a href="<?php echo e(route('admin.supervisors.create')); ?>" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text"><?php echo e(__('panel.add_new_supervisor')); ?></span>
                    </a>
                <?php endif; // Entrust::ability ?>
            </div>
        </div>


        <?php echo $__env->make('backend.supervisors.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-10p border-bottom-0">#</th>
                        <th class="wd-10p border-bottom-0"><?php echo e(__('panel.image')); ?></th>
                        <th class="wd-20p border-bottom-0"><?php echo e(__('panel.name')); ?></th>
                        <th class="wd-25p border-bottom-0"><?php echo e(__('panel.email_mobile')); ?></th>
                        <th class="wd-10p border-bottom-0"><?php echo e(__('panel.status')); ?></th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell"><?php echo e(__('panel.created_at')); ?></th>
                        <th class="text-center border-bottom-0" style="width: 120px;"><?php echo e(__('panel.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $supervisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supervisor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="<?php echo e($supervisor->id); ?>">
                            </td>
                            <td>
                                <?php if($supervisor->user_image): ?>
                                    <img src="<?php echo e(asset('assets/users/' . $supervisor->user_image)); ?>"
                                        alt="<?php echo e($supervisor->full_name); ?>" class="img-thumbnail" style="max-width: 60px;">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/users/avatar.svg')); ?>" alt="Avatar" class="img-thumbnail"
                                        style="max-width: 60px;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($supervisor->full_name); ?><br><small><?php echo e($supervisor->username); ?></small></td>
                            <td><?php echo e($supervisor->email); ?><br><?php echo e($supervisor->mobile); ?></td>
                            <td class="text-center">
                                <a href="javascript:void(0);" class="updateSupervisorStatus"
                                    id="supervisor-<?php echo e($supervisor->id); ?>" supervisor_id="<?php echo e($supervisor->id); ?>">
                                    <?php if($supervisor->status): ?>
                                        <i class="fas fa-toggle-on fa-lg text-success"></i>
                                    <?php else: ?>
                                        <i class="fas fa-toggle-off fa-lg text-warning"></i>
                                    <?php endif; ?>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell"><?php echo e($supervisor->created_at?->diffForHumans() ?? '-'); ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton<?php echo e($supervisor->id); ?>" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                                            <i data-feather="more-vertical" class="icon-sm text-muted"></i>
                                            <?php echo e(__('panel.operation_options')); ?>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 25 15" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down link-arrow ms-1">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton<?php echo e($supervisor->id); ?>">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="<?php echo e(route('admin.supervisors.edit', $supervisor->id)); ?>">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i> <?php echo e(__('panel.edit')); ?>

                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-supervisor-<?php echo e($supervisor->id); ?>', '<?php echo e(__('panel.confirm_delete')); ?>')">
                                                <i data-feather="trash" class="icon-sm me-2"></i> <?php echo e(__('panel.delete')); ?>

                                            </a>
                                            <form id="delete-supervisor-<?php echo e($supervisor->id); ?>"
                                                action="<?php echo e(route('admin.supervisors.destroy', $supervisor->id)); ?>"
                                                method="POST" class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center"><?php echo e(__('panel.no_supervisors_found')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($supervisors->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateSupervisorStatus', function() {
                var el = $(this);
                var supervisor_id = el.attr('supervisor_id');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('admin.supervisors.toggleStatus')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        supervisor_id: supervisor_id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            if (response.new_status) {
                                el.html('<i class="fas fa-toggle-on fa-lg text-success"></i>');
                            } else {
                                el.html('<i class="fas fa-toggle-off fa-lg text-warning"></i>');
                            }
                        } else {
                            alert('حدث خطأ: ' + (response.message || 'خطأ غير معروف'));
                        }
                    },
                    error: function() {
                        alert('حدث خطأ أثناء تغيير الحالة');
                    }
                });
            });
        });

        function confirmDelete(formId, message) {
            if (confirm(message)) {
                document.getElementById(formId).submit();
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/backend/supervisors/index.blade.php ENDPATH**/ ?>