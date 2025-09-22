<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-gavel"></i>
                    <?php echo e(__('panel.manage_fatawa_categories')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.main')); ?></a> \</li>
                    <li class="ms-1"><?php echo e(__('panel.show_fatawa_categories')); ?></li>
                </ul>
            </div>

            <div class="ml-auto">
                <?php if (\Entrust::ability('admin', 'create_fatawa_categories')) : ?>
                    <a href="<?php echo e(route('admin.fatawa_categories.create')); ?>" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text"><?php echo e(__('panel.add_new_content')); ?></span>
                    </a>
                <?php endif; // Entrust::ability ?>
            </div>
        </div>

        <?php echo $__env->make('backend.fatawa_categories.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-30p border-bottom-0"><?php echo e(__('panel.title')); ?></th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell"><?php echo e(__('panel.author')); ?></th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell text-center"><?php echo e(__('panel.status')); ?></th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell text-center"><?php echo e(__('panel.featured')); ?>

                        </th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell"><?php echo e(__('panel.published_on')); ?></th>
                        <th class="text-center border-bottom-0" style="width: 120px;"><?php echo e(__('panel.actions')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $page_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="<?php echo e($page_category->id); ?>">
                            </td>

                            <td><?php echo e($page_category->title); ?></td>

                            <td class="d-none d-sm-table-cell">
                                <?php echo e($page_category->creator?->first_name ?? __('panel.unknown')); ?>

                            </td>

                            <td class="d-none d-sm-table-cell text-center">
                                <a href="javascript:void(0);" class="updateFatawaCategoryStatus"
                                    id="fatawa-category-<?php echo e($page_category->id); ?>"
                                    fatawa_category_id="<?php echo e($page_category->id); ?>">
                                    <?php if($page_category->status): ?>
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    <?php else: ?>
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    <?php endif; ?>
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell text-center">
                                <a href="javascript:void(0);" class="toggleFatawaCategoryFeatured"
                                    id="fatawa-category-featured-<?php echo e($page_category->id); ?>"
                                    fatawa_category_id="<?php echo e($page_category->id); ?>">
                                    <?php if($page_category->featured): ?>
                                        <i class="fas fa-star fa-lg text-warning" style="font-size:1.6em;"></i>
                                    <?php else: ?>
                                        <i class="far fa-star fa-lg text-muted" style="font-size:1.6em;"></i>
                                    <?php endif; ?>
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell">
                                <?php echo e($page_category->published_on?->diffForHumans() ?? '-'); ?>

                            </td>

                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton<?php echo e($page_category->id); ?>" data-bs-toggle="dropdown"
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
                                            aria-labelledby="dropdownMenuButton<?php echo e($page_category->id); ?>">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="<?php echo e(route('admin.fatawa_categories.edit', $page_category->id)); ?>">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <span><?php echo e(__('panel.operation_edit')); ?></span>
                                            </a>

                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-fatawa-category-<?php echo e($page_category->id); ?>', '<?php echo e(__('panel.confirm_delete_message')); ?>', '<?php echo e(__('panel.yes_delete')); ?>', '<?php echo e(__('panel.cancel')); ?>')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <span><?php echo e(__('panel.operation_delete')); ?></span>
                                            </a>

                                            <form id="delete-fatawa-category-<?php echo e($page_category->id); ?>"
                                                action="<?php echo e(route('admin.fatawa_categories.destroy', $page_category->id)); ?>"
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
                            <td colspan="7" class="text-center"><?php echo e(__('panel.no_found_item')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($page_categories->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            // تغيير الحالة
            $(document).on('click', '.updateFatawaCategoryStatus', function() {
                var el = $(this);
                var category_id = el.attr('fatawa_category_id');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('admin.fatawa_categories.toggleStatus')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        category_id: category_id
                    },
                    success: function(response) {
                        if (response.status) {
                            el.html(
                                '<i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>'
                            );
                        } else {
                            el.html(
                                '<i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('حدث خطأ أثناء تغيير الحالة');
                    }
                });
            });

            // تغيير المميز (featured)
            $(document).on('click', '.toggleFatawaCategoryFeatured', function() {
                var el = $(this);
                var category_id = el.attr('fatawa_category_id');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('admin.fatawa_categories.toggleFeatured')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        category_id: category_id
                    },
                    success: function(response) {
                        // تقبل قيمة 1/0 أو true/false
                        if (response.featured == 1 || response.featured === true) {
                            el.html(
                                '<i class="fas fa-star fa-lg text-warning" style="font-size:1.6em;"></i>'
                            );
                        } else {
                            el.html(
                                '<i class="far fa-star fa-lg text-muted" style="font-size:1.6em;"></i>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        if (xhr.status === 403) {
                            alert('غير مصرح لك بتغيير هذه الخاصية');
                        } else if (xhr.status === 404) {
                            alert('التصنيف غير موجود أو ليس ضمن قسم الفتاوى');
                        } else {
                            alert('حدث خطأ أثناء تغيير حالة المميز');
                        }
                    }
                });
            });
        });

        function confirmDelete(formId, message, yesText, cancelText) {
            if (confirm(message)) {
                console.log('Submitting form: ' + formId);
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                } else {
                    console.error('Form not found: ' + formId);
                }
            } else {
                console.log('User cancelled deletion');
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/fatawa_categories/index.blade.php ENDPATH**/ ?>