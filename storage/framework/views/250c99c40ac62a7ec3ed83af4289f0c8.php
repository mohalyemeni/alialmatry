<?php
    $current_page = Route::currentRouteName();
?>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="<?php echo e(route('admin.index')); ?>" class="sidebar-brand">
            <?php echo e(__('panel.dashboard')); ?>


        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <h3 class="h3_mine"><?php echo e(__('panel.web_detail')); ?></h3>
        <ul class="nav">
            <?php if (\Entrust::hasRole(['admin'])) : ?>
                <?php $__currentLoopData = $admin_side_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($menu->appearedChildren) == 0): ?>
                        <li class="nav-item nav-category <?php echo e($menu->id == getParentShowOf($current_page) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.' . $menu->as)); ?>" class="nav-link">
                                <i class="link-icon <?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                                <span class="link-title"><?php echo e(__('panel.' . $menu->name)); ?> </span>
                            </a>
                            
                        </li>
                    <?php else: ?>
                        <li
                            class="nav-item nav-category <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'active' : ''); ?>">
                            <a class="nav-link <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? '' : 'collapsed'); ?>"
                                data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo e($menu->route); ?>"
                                href="#collapse_<?php echo e($menu->route); ?>" role="button"
                                aria-expanded="<?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'true' : 'false'); ?>"
                                aria-controls="collapse_<?php echo e($menu->route); ?>">
                                <i class="link-icon <?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                                <span class="link-title"><?php echo e($menu->display_name); ?></span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <?php if(count($menu->appearedChildren) > 0): ?>
                                <div class="collapse <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'show' : ''); ?>"
                                    id="collapse_<?php echo e($menu->route); ?>">
                                    <ul class="nav sub-menu">
                                        <?php $__currentLoopData = $menu->appearedChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('admin.' . $sub_menu->as)); ?>"
                                                    class="nav-link <?php echo e((int) getParentShowOf($current_page) + 1 == $sub_menu->id ? 'active' : ''); ?>">
                                                    <?php echo e($sub_menu->display_name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            

                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; // Entrust::hasRole ?>

            <?php if (\Entrust::hasRole(['supervisor'])) : ?>
                <?php $__currentLoopData = $admin_side_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (\Entrust::can($menu->name)) : ?>
                        <?php if(count($menu->appearedChildren) == 0): ?>
                            <li
                                class="nav-item nav-category <?php echo e($menu->id == getParentShowOf($current_page) ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('admin.' . $menu->as)); ?>" class="nav-link">
                                    <i class="link-icon <?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                                    <span class="link-title"><?php echo e($menu->display_name); ?></span>
                                </a>
                                
                            </li>
                        <?php else: ?>
                            <li
                                class="nav-item nav-category <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'active' : ''); ?>">
                                <a class="nav-link <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? '' : 'collapsed'); ?>"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo e($menu->route); ?>"
                                    href="#collapse_<?php echo e($menu->route); ?>" role="button"
                                    aria-expanded="<?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'true' : 'false'); ?>"
                                    aria-controls="collapse_<?php echo e($menu->route); ?>">
                                    <i class="link-icon <?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                                    <span class="link-title"><?php echo e($menu->display_name); ?></span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <?php if(count($menu->appearedChildren) > 0): ?>
                                    <div class="collapse <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'show' : ''); ?>"
                                        id="collapse_<?php echo e($menu->route); ?>">
                                        <ul class="nav sub-menu">
                                            <?php $__currentLoopData = $menu->appearedChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if (\Entrust::can($sub_menu->name)) : ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo e(route('admin.' . $sub_menu->as)); ?>"
                                                            class="nav-link <?php echo e((int) getParentShowOf($current_page) + 1 == $sub_menu->id ? 'active' : ''); ?>">
                                                            <?php echo e($sub_menu->display_name); ?>

                                                        </a>
                                                    </li>
                                                <?php endif; // Entrust::can ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endif; // Entrust::can ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; // Entrust::hasRole ?>

        </ul>

    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/partial/backend/sidbar.blade.php ENDPATH**/ ?>