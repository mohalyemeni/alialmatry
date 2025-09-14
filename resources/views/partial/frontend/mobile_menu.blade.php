<!--==============================
    قائمة الجوال
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('frontend.index') }}">
                <img src="{{ asset('frontand/assets/img/top-logo.png') }}" alt="Tawba">
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="{{ route('frontend.sheikh-intro') }}">نبذة الشيخ</a>
                </li>
                <li><a href="{{ route('frontend.videos.index') }}"> المرئيات</a></li>
                <li class="menu-item-has-children">
                    <a href{{ route('frontend.audios.index') }}">الصوتيات</a>
                </li>
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
