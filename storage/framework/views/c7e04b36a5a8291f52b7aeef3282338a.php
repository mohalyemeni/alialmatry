<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>إدارة المحتوى </title>

    <link rel="stylesheet" href=" <?php echo e(asset('backend/vendors/core/core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/custom.css')); ?>">


    <!-- inject:css -->
    <link href="<?php echo e(asset('frontand/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/fonts/feather-font/css/iconfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <!-- endinject -->
    <link href="<?php echo e(asset('frontand/assets/css/fontawesome.min.css')); ?>" rel="stylesheet" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/style-rtl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/custom.css')); ?>">
    <!-- End layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/flatpickr/flatpickr-rtl.min.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('backend/images/favicon.png')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/summernote/summernote-bs4.min.css')); ?>">
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldContent('style'); ?>
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">

        <?php echo $__env->make('partial.backend.sidbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('partial.backend.setteng_sidbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-wrapper">

            <?php echo $__env->make('partial.backend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="page-content">
                <?php echo $__env->make('partial.backend.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <?php echo $__env->make('partial.backend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>


    <script src="<?php echo e(asset('backend/vendors/core/core.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/jquery-3.6.0.min.js')); ?> "></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap_back/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/template.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/plugins/piexif.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/plugins/sortable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/themes/fa6/theme.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/summernote/summernote-bs4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/flatpickr/flatpickr-rtl.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/flatpickr.js')); ?>"></script>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/layouts/admin.blade.php ENDPATH**/ ?>