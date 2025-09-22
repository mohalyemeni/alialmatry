<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Kufi Font -->
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href=" <?php echo e(asset('backend/vendors/core/core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/custom.css')); ?>">


    <!-- inject:css -->
    <link href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/fonts/feather-font/css/iconfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/style-rtl.css')); ?>">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="<?php echo e(asset('backend/images/favicon.png')); ?>" />

</head>

<body>

    <div class="main-wrapper">
        <div class="page-wrapper full-page" id="app">
            <div class="page-content d-flex align-items-center justify-content-center">



                <?php echo $__env->yieldContent('content'); ?>

            </div>
        </div>
    </div>


    <script src="<?php echo e(asset('backend/vendors/core/core.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery-3.6.0.min.js')); ?> "></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/template.js')); ?>"></script>

    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/layouts/admin-auth.blade.php ENDPATH**/ ?>