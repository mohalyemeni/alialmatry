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
    <link rel="stylesheet" href="{{ asset('backend/css/demo1/custom.css') }}">
    <!-- End layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/flatpickr/flatpickr-rtl.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/summernote/summernote-bs4.min.css') }}">
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
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/themes/fa6/theme.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/flatpickr/flatpickr-rtl.min.js') }}"></script>
    <script src="{{ asset('backend/js/flatpickr.js') }}"></script>
    {{-- <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script> --}}
    @livewireScripts

    @yield('script')
</body>

</html>
