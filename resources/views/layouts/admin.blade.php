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

    <link rel="stylesheet" href=" {{ asset('backend/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/demo1/custom.css') }}">


    <!-- inject:css -->
    <link href="{{ asset('frontand/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <link href="{{ asset('frontand/assets/css/fontawesome.min.css') }}" rel="stylesheet" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/demo1/style-rtl.css') }}">
    <!-- End layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/flatpickr/flatpickr-rtl.min.css') }}">
    @if (isset($siteSettings['site_favicon']->value) && $siteSettings['site_favicon']->value)
        <link rel="shortcut icon" href="{{ asset('assets/site_settings/' . $siteSettings['site_favicon']->value) }}"
            type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="{{ asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/demo1/custom.css') }}">


    @livewireStyles
    @yield('style')
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">

        @include('partial.backend.sidbar')

        @include('partial.backend.setteng_sidbar')

        <div class="page-wrapper">

            @include('partial.backend.header')

            <div class="page-content">
                @include('partial.backend.flash')
                @yield('content')
            </div>

            @include('partial.backend.footer')

        </div>
    </div>


    <script src="{{ asset('backend/vendors/core/core.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }} "></script>
    <script src="{{ asset('backend/vendors/bootstrap_back/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script src="{{ asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/themes/fa6/theme.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/flatpickr/flatpickr-rtl.min.js') }}"></script>
    <script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
    {{-- <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script> --}}
    <script src="{{ asset('backend/') }}"></script>

    @livewireScripts
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

    @yield('script')
</body>

</html>
