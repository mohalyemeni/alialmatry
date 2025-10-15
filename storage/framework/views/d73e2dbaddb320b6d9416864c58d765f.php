<!--==============================
    قائمة الجوال
============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">

        <button class="th-menu-toggle" aria-label="إغلاق القائمة"><i class="fal fa-times"></i></button>

        <div class="mobile-logo">
            <a href="<?php echo e(route('frontend.index')); ?>">
                <img src="<?php echo e(asset('frontand/assets/img/top-logo.png')); ?>" alt="Logo">
            </a>
        </div>

        <div class="th-mobile-menu">
            <ul>
                <!-- زر البحث أُخرج إلى الهيدر على الموبايل، لذلك لم نعد نحتاج هذا العنصر داخل القائمة -->
                <!-- تم حذف <li class="mobile-search-item"> ... </li> -->

                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.sheikh-intro')); ?>">نبذة الشيخ</a>
                </li>
                <li><a href="<?php echo e(route('frontend.videos.index')); ?>"> المرئيات</a></li>
                <li><a href="<?php echo e(route('frontend.audios.index')); ?>"> الصوتيات</a></li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.fatawas.index')); ?>">الفتاوى</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.blogs.index')); ?>">المقالات</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="<?php echo e(route('frontend.books.index')); ?>">الكتب والمؤلفات</a>
                </li>
                <li><a href="<?php echo e(route('frontend.contact.form')); ?>">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    .th-mobile-menu ul {
        padding: 0 12px;
    }

    /* تم تعديل الـ mobile-search-item سابقاً؛ هنا تركت بقية ستايلات القائمة كما كانت */
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
<?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/partial/frontend/mobile_menu.blade.php ENDPATH**/ ?>