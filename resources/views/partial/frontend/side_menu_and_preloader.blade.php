{{-- مبدل الألوان --}}
<div class="color-scheme-wrap active">
    <button class="switchIcon"><i class="fa-solid fa-palette"></i></button>
    <h4 class="color-scheme-wrap-title"><i class="far fa-palette me-2"></i>تغيير النمط</h4>
    <div class="color-switch-btns">
        <button data-color="#3E66F3"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#684DF4"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#008080"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#323F7C"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#FC3737"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#8a2be2"><i class="fa-solid fa-droplet"></i></button>
    </div>
    {{-- <a href="https://themeforest.net/user/themeholy" class="th-btn text-center w-100">
        <i class="fa fa-shopping-cart me-2"></i> شراء
    </a> --}}
</div>

{{-- شاشة التحميل --}}
<div class="preloader">
    <button class="th-btn style1 preloaderCls">إلغاء شاشة التحميل</button>
    <div class="preloader-inner">
        <img src="{{ asset('frontand/assets/img/shape/shape.svg') }}" alt="رسم">
        <div class="loading-text">
            <span class="letter">ج</span>
            <span class="letter">ا</span>
            <span class="letter">رٍ</span>
            <span class="letter">ي</span>
            <span class="letter">ا</span>
            <span class="letter">ل</span>
            <span class="letter">ت</span>
            <span class="letter">ح</span>
            <span class="letter">م</span>
            <span class="letter">ي</span>
            <span class="letter">ل</span>
            <span class="letter">.</span>
            <span class="letter">.</span>
            <span class="letter">.</span>
        </div>
    </div>
</div>
{{-- القائمة الجانبية --}}
<div class="sidemenu-wrapper d-none d-lg-block">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget footer-widget">
            <h3 class="widget_title mb-2">معلومات</h3>
            <div class="th-widget-about">
                <p class="about-text">
                    @if (isset($siteSettings['site_description']->value) && $siteSettings['site_description']->value)
                        {{ $siteSettings['site_description']->value }}
                    @else
                        التاريخ الإسلامي دليل على الصمود والمرونة والتأثير العميق للحضارة الإسلامية.
                        إنها قصة إيمان وابتكار ومساهمات خالدة للبشرية.
                    @endif
                </p>
                <div class="th-widget-about">
                    @if (isset($siteSettings['site_mobile']->value) && $siteSettings['site_mobile']->value)
                        <p class="footer-info">
                            <i class="fa-sharp fa-solid fa-phone"></i>
                            <span>
                                <a class="text-inherit" href="tel:{{ $siteSettings['site_mobile']->value }}">
                                    {{ $siteSettings['site_mobile']->value }}
                                </a>
                            </span>
                        </p>
                    @endif
                    @if (isset($siteSettings['site_email']->value) && $siteSettings['site_email']->value)
                        <p class="footer-info">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <span>
                                <a class="text-inherit" href="mailto:{{ $siteSettings['site_email']->value }}">
                                    {{ $siteSettings['site_email']->value }}
                                </a>
                            </span>
                        </p>
                    @endif

                    @if (isset($siteSettings['site_address']->value) && $siteSettings['site_address']->value)
                        <p class="footer-info">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $siteSettings['site_address']->value }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
