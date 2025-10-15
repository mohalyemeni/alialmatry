<!--==============================
    قائمة الجوال
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">

        <button class="th-menu-toggle" aria-label="إغلاق القائمة"><i class="fal fa-times"></i></button>

        <div class="mobile-logo">
            <a href="{{ route('frontend.index') }}">
                <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="Logo">
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>


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
                <li><a href="{{ route('frontend.contact.form') }}">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    .th-mobile-menu ul {
        padding: 0 12px;
    }

    .th-mobile-menu ul li {
        list-style: none;
        margin: 10px 0;
    }

    .th-mobile-menu .menu-item-has-children a,
    .th-mobile-menu li a {
        display: block;
        padding: 12px 8px;
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
