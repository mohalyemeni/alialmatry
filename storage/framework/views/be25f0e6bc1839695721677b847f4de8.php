<!DOCTYPE html>

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
    <!-- End layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/flatpickr/flatpickr-rtl.min.css')); ?>">
    <?php if(isset($siteSettings['site_favicon']->value) && $siteSettings['site_favicon']->value): ?>
        <link rel="shortcut icon" href="<?php echo e(asset('assets/site_settings/' . $siteSettings['site_favicon']->value)); ?>"
            type="image/x-icon">
    <?php else: ?>
        <link rel="shortcut icon" href="<?php echo e(asset('backend/images/favicon.png')); ?>" type="image/x-icon">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/summernote/summernote-bs4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/demo1/custom.css')); ?>">


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
    <script src="<?php echo e(asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/plugins/piexif.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/plugins/sortable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/bootstrap-fileinput/themes/fa6/theme.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/summernote/summernote-bs4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendors/flatpickr/flatpickr-rtl.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/sweetalert2@11.js')); ?>"></script>
    
    <script src="<?php echo e(asset('backend/')); ?>"></script>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="sidebarThemeSettings"]');
            const storageKey = 'sidebarTheme';
            const defaultTheme = 'sidebar-dark'; // افتراضي عند عدم وجود قيمة محفوظة
            const body = document.body; // أو العنصر اللي تضيف له الكلاس في تطبيقك

            // 1. قراءة القيمة المحفوظة وتطبيقها
            const saved = localStorage.getItem(storageKey) || defaultTheme;
            applyTheme(saved);

            // 2. ضبط حالة الراديو عند التحميل
            const sel = document.querySelector(`input[name="sidebarThemeSettings"][value="${saved}"]`);
            if (sel) sel.checked = true;

            // 3. حدث تغيير على كل راديو ليحفظ القيمة ويطبقها فوراً
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (!this.checked) return;
                    localStorage.setItem(storageKey, this.value);
                    applyTheme(this.value);
                });
            });

            // دالة تطبيق الثيم — تأكد أن أسماء الكلاسات تطابق مشروعك
            function applyTheme(theme) {
                // احذف كلاسات الثيم القديمة ثم أضف الجديد
                body.classList.remove('sidebar-light', 'sidebar-dark');
                body.classList.add(theme);
                // إذا كان الثيم يطبق على عنصر آخر غيّر body إلى selector المناسب
            }
        });
    </script>

    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/layouts/admin.blade.php ENDPATH**/ ?>