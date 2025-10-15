{{-- partial/frontend/mobile_menu.blade.php --}}
<!--==============================
    قائمة الجوال
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">

        <button class="th-menu-toggle" aria-label="إغلاق القائمة"><i class="fal fa-times"></i></button>

        <div class="mobile-logo">
            <a href="{{ route('frontend.index') }}">
                @if (isset($siteSettings['site_logo_light']->value) && $siteSettings['site_logo_light']->value)
                    <img src="{{ asset('assets/site_settings/' . $siteSettings['site_logo_light']->value) }}"
                        alt="Logo">
                @else
                    <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="Logo">
                @endif
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>
                {{-- لقد ألغينا/أخفينا زر البحث داخل القائمة لأننا أنقلناه إلى الهيدر --}}
                {{-- <li class="mobile-search-item">
                    <button type="button" class="mobile-search-btn searchBoxToggler" aria-label="بحث">
                        <i class="far fa-search"></i>
                        <span class="visually-hidden">بحث</span>
                    </button>
                </li> --}}

                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.sheikh-intro') }}">نبذة الشيخ</a>
                </li>
                <li><a href="{{ route('frontend.videos.index') }}">المرئيات</a></li>
                <li><a href="{{ route('frontend.audios.index') }}">الصوتيات</a></li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.fatawas.index') }}">الفتاوى</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.blogs.index') }}">المقالات</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.books.index') }}">الكتب والمؤلفات</a>
                </li>
                <li><a href="{{ route('frontend.contact.form') }}">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    .th-mobile-menu ul {
        padding: 0 12px;
    }

    .th-mobile-menu ul li.mobile-search-item {
        display: none;
    }

    /* إخفاء حفاظاً على التوافق */
    .mobile-search-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: transparent;
        color: inherit;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        max-width: 320px;
        justify-content: center;
    }

    .mobile-search-btn i {
        font-size: 18px;
    }

    @media (min-width: 480px) {
        .mobile-search-btn span {
            display: inline-block;
            margin-inline-start: 6px;
        }
    }

    .visually-hidden {
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
        white-space: nowrap;
    }
</style>
