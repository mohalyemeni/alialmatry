<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-video me-2"></i>
                    <?php echo e(__('panel.manage_videos')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> \</li>
                    <li class="ms-1"><?php echo e(__('panel.manage_videos')); ?></li>
                </ul>
            </div>
            <div class="ml-auto">
                <?php if (\Entrust::ability('admin', 'create_videos')) : ?>
                    <a href="<?php echo e(route('admin.videos.create')); ?>" class="btn btn-primary" title="<?php echo e(__('panel.add_video')); ?>">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text"><?php echo e(__('panel.add_video')); ?></span>
                    </a>
                <?php endif; // Entrust::ability ?>
            </div>
        </div>

        <?php echo $__env->make('backend.videos.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0"><?php echo e(__('panel.thumbnail')); ?></th>
                        <th class="wd-35p border-bottom-0"><?php echo e(__('panel.title')); ?></th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell"><?php echo e(__('panel.published_on')); ?></th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell"><?php echo e(__('panel.status')); ?></th>
                        <th class="text-center border-bottom-0" style="width: 120px;"><?php echo e(__('panel.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="<?php echo e($video->id); ?>">
                            </td>

                            <td>
                                <?php if($video->thumbnail_url): ?>
                                    
                                    <img src="<?php echo e($video->thumbnail_url); ?>" alt="<?php echo e($video->title); ?>" class="img-thumbnail"
                                        style="width: 81px; height: 70px; object-fit: cover; border-radius: 100%;">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="width:81px; height:70px; background:#f5f5f5; border-radius: 100%;">
                                        <small class="text-muted"><?php echo e(__('panel.no_image')); ?></small>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($video->title); ?></td>

                            <td class="d-none d-sm-table-cell"><?php echo e($video->published_on?->diffForHumans() ?? '-'); ?></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <a href="javascript:void(0);" class="updateVideoStatus" id="video-<?php echo e($video->id); ?>"
                                    video_id="<?php echo e($video->id); ?>">
                                    <?php if($video->status): ?>
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    <?php else: ?>
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    <?php endif; ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton<?php echo e($video->id); ?>" data-bs-toggle="dropdown"
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo e($video->id); ?>">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="<?php echo e(route('admin.videos.edit', $video->id)); ?>">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <?php echo e(__('panel.operation_edit')); ?>

                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-video-<?php echo e($video->id); ?>')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <?php echo e(__('panel.operation_delete')); ?>

                                            </a>
                                            <form id="delete-video-<?php echo e($video->id); ?>"
                                                action="<?php echo e(route('admin.videos.destroy', $video->id)); ?>" method="POST"
                                                class="d-none">
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
                            <td colspan="7" class="text-center"><?php echo e(__('panel.no_items')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($videos->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateVideoStatus', function() {
                var el = $(this);
                var video_id = el.attr('video_id');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('admin.videos.toggleStatus')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        video_id: video_id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            if (response.new_status) {
                                el.html(
                                    '<i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>'
                                );
                            } else {
                                el.html(
                                    '<i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>'
                                );
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '<?php echo e(__('panel.something_was_wrong')); ?>',
                                text: response.message ||
                                    '<?php echo e(__('panel.unknown_error')); ?>'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: '<?php echo e(__('panel.something_was_wrong')); ?>',
                            text: '<?php echo e(__('panel.error_while_changing_status', ['_lang' => 'ar'])); ?>'
                        });
                    }
                });
            });
        });

        function confirmDelete(formId) {
            Swal.fire({
                title: '<?php echo e(__('panel.confirm_delete_message')); ?>',
                text: "<?php echo e(__('panel.cant_revert_this', ['_lang' => 'ar'])); ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(__('panel.yes_delete')); ?>',
                cancelButtonText: '<?php echo e(__('panel.cancel')); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/backend/videos/index.blade.php ENDPATH**/ ?>