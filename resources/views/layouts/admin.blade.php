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

    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap-fileinpuسt/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
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
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-fileinput/themes/fa6/theme.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/flatpickr/flatpickr-rtl.min.js') }}"></script>
    <script src="{{ asset('backend/js/flatpickr.js') }}"></script>
    <script src="{{ asset('frontand/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    {{-- <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script> --}}
    @livewireScripts

    @yield('script')
</body>

</html>
