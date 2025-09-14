<!--==============================
    قائمة الجوال
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="<?php echo e(route('frontend.index')); ?>">
                <img src="<?php echo e(asset('frontand/assets/img/top-logo.png')); ?>" alt="Tawba">
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.sheikh-intro')); ?>">نبذة الشيخ</a>
                </li>
                <li><a href="<?php echo e(route('frontend.videos.index')); ?>"> المرئيات</a></li>
                <li class="menu-item-has-children">
                    <a href<?php echo e(route('frontend.audios.index')); ?>">الصوتيات</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.fatawas.index')); ?>">الفتاوى</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.blogs.index')); ?>">المقالات</a>

                </li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.books.index')); ?>">الكتب والمؤلفات</a>

                </li>
                <li><a href="contact.html">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/partial/frontend/mobile_menu.blade.php ENDPATH**/ ?>