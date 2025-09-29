<!--==============================
    قائمة الجوال (نسخة خفيفة: زر البحث فقط داخل القائمة)
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <!-- زر إغلاق القائمة -->
        <button class="th-menu-toggle" aria-label="إغلاق القائمة"><i class="fal fa-times"></i></button>

        <!-- شعار الموبايل -->
        <div class="mobile-logo">
            <a href="{{ route('frontend.index') }}">
                <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="Logo">
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>
                <!-- زر البحث: سيستخدم نفس الـ JS لأن لديه الصنف searchBoxToggler -->
                <li class="mobile-search-item">
                    <button type="button" class="mobile-search-btn searchBoxToggler" aria-label="بحث">
                        <i class="far fa-search"></i>
                        <span class="visually-hidden">بحث</span>
                    </button>
                </li>

                <!-- بقية الروابط -->
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.sheikh-intro') }}">نبذة الشيخ</a>
                </li>
                <li><a href="{{ route('frontend.videos.index') }}"> المرئيات</a></li>
                <li><a href="{{ route('frontend.audios.index') }}"> الصوتيات</a></li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.fatawas.index') }}">الفتاوى</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.blogs.index') }}">المقالات</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.books.index') }}">الكتب والمؤلفات</a>
                </li>
                <li><a href="contact.html">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- CSS صغير لتنسيق زر البحث داخل قائمة الموبايل -->
<style>
    /* اجعل زر البحث داخل القائمة يبدو كعنصر من عناصر القائمة */
    .th-mobile-menu ul {
        padding: 0 12px;
    }

    .th-mobile-menu ul li.mobile-search-item {
        list-style: none;
        margin: 10px 0;
        display: flex;
        justify-content: center;
        /* اجعل الزر في منتصف القائمة */
    }

    .mobile-search-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.06);
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

    /* إذا أردت أن يظهر نص بجانب الأيقونة على شاشات أكبر داخل القائمة */
    @media (min-width: 480px) {
        .mobile-search-btn span {
            display: inline-block;
            margin-inline-start: 6px;
        }
    }

    /* وللحفاظ على إمكانية الوصول اجعل النص مخفي بصرياً لكن متاح للقراء */
    .visually-hidden {
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
        white-space: nowrap;
    }
</style>
