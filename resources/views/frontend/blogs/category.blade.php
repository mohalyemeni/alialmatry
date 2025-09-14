@extends('layouts.app')
@section('title', $category->title)

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $category->title }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.blogs.index') }}"
                            class="text-white">المقالات</a></li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    @php
        // إعدادات الشبكة:
        $cols = 3; // عدد أعمدة العرض (على lg)
        $rowsToShow = 4; // عدد الصفوف الأولى التي تُعرض قبل الضغط على "عرض المزيد"
        $initialCount = $cols * $rowsToShow;
        // إذا تم تمرير $blogs من الكنترولر استخدمها، وإلا جلب كافة المقالات لهذا التصنيف
        $items = $blogs ?? $category->blogs()->where('status', 1)->latest()->get();
        $total = $items->count();

        // دالة مغلقة لحل مسار الصورة بشكل موثوق — تُعيد null إذا لا توجد صورة صالحة
        $resolveImage = function ($raw) {
            $raw = $raw ?? null;
            if (empty($raw)) {
                return null;
            }

            // استعمل الفولدرات من خلال الـ helpers الكاملين لتفادي الأخطاء
            $rawTrim = ltrim($raw, '/');

            // رابط خارجي
            if (\Illuminate\Support\Str::startsWith($rawTrim, ['http://', 'https://', '//'])) {
                return $rawTrim;
            }

            // تحقق إذا المخزن كمسار كامل داخل public (مثلاً لو خزنت 'assets/blogs/images/xxx.jpg')
            if (file_exists(public_path($rawTrim))) {
                return asset($rawTrim);
            }

            // تحقق المسار المتوقع assets/blogs/images/<raw>
            $candidate1 = public_path('assets/blogs/images/' . $rawTrim);
            if (file_exists($candidate1)) {
                return asset('assets/blogs/images/' . $rawTrim);
            }

            // تحقق إذا المخزن في storage/app/public (مع رابط storage)
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($rawTrim)) {
                return asset('storage/' . $rawTrim);
            }

            // لم نجد صورة صالحة
            return null;
        };
    @endphp

    <div class="container py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <h3 class="widget_title mb-0 fadeInRight wow title-header-noline" data-wow-delay=".3s">المقالات</h3>
                <div class="section-head d-flex align-items-center justify-content-between mb-5 "></div>

                {{-- Grid: استخدم صفوف و أعمدة بوتستراب --}}
                <div id="blogs-grid" class="row gy-4">
                    @foreach ($items as $index => $blog)
                        @php
                            // determine if this item should be hidden initially
                            $hideInitially = $index >= $initialCount;
                            // الحصول على src إن وُجد — الدالة تعيد null إن لم توجد صورة
                            $imgSrc = $resolveImage($blog->img ?? null);
                        @endphp

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 blog-item {{ $hideInitially ? 'd-none hidden-by-js' : '' }}"
                            data-index="{{ $index }}">
                            <div class="wow fadeInUp" data-wow-delay=".3s">
                                <div class="cousrse-card cousrse-card2">


                                    @if ($imgSrc)
                                        <div class="box-img global-img tow_height">
                                            <a href="{{ route('frontend.blogs.show', $blog->slug) }}"
                                                aria-label="{{ e($blog->title) }}">
                                                <img src="{{ $imgSrc }}" alt="{{ e($blog->title) }}"
                                                    class="tow_height" style="width:100%; height:100%; object-fit:cover;">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="hei">
                                        <h3 class="box-title">
                                            <a
                                                href="{{ route('frontend.blogs.show', $blog->slug) }}">{{ \Illuminate\Support\Str::limit(strip_tags($blog->title), 25) }}</a>
                                        </h3>

                                        <p class="tags text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 80) }}</p>

                                        <div class="btn-group justify-content-between">
                                            <a class="th-btn border-btn2 new_pad"
                                                href="{{ route('frontend.blogs.category', $blog->category->slug ?? ($blog->category->id ?? '')) }}">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->title), 20) }}
                                            </a>

                                            <a class="th-btn border-btn2 read-btn-custom new_pad"
                                                href="{{ route('frontend.blogs.show', $blog->slug) }}">
                                                {{ __('panel.read') }} <i class="fa-solid fa-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- عرض المزيد / إخفاء --}}
                @if ($total > $initialCount)
                    <div class="text-center mt-4">
                        <button id="show-more-btn" class="btn btn-primary">
                            عرض المزيد ({{ $total - $initialCount }}) <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <button id="show-less-btn" class="btn btn-outline-secondary d-none">
                            عرض أقل <i class="fa fa-angle-up ms-1"></i>
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('show-more-btn');
            const showLessBtn = document.getElementById('show-less-btn');
            const hiddenItems = Array.from(document.querySelectorAll('.hidden-by-js'));
            // إذا لم يوجد مخفيين لا نفعل شيء
            if (hiddenItems.length === 0) {
                if (showMoreBtn) showMoreBtn.style.display = 'none';
                return;
            }

            showMoreBtn && showMoreBtn.addEventListener('click', function() {
                // أظهر كل العناصر المخفية
                hiddenItems.forEach(el => el.classList.remove('d-none'));
                // أخفِ زر العرض واظهر زر الإخفاء
                if (showMoreBtn) showMoreBtn.classList.add('d-none');
                if (showLessBtn) showLessBtn.classList.remove('d-none');
                // تشغيل WOW مجدداً إن كان موجود
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
            });

            showLessBtn && showLessBtn.addEventListener('click', function() {
                // أخفِ العناصر التي كانت مخفية
                hiddenItems.forEach(el => el.classList.add('d-none'));
                if (showLessBtn) showLessBtn.classList.add('d-none');
                if (showMoreBtn) showMoreBtn.classList.remove('d-none');
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
                // مرّر للجزء العلوي من الشبكة
                const grid = document.getElementById('blogs-grid');
                if (grid) grid.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
