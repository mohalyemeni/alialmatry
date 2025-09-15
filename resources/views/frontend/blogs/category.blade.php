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
        use Illuminate\Support\Str;
        use Illuminate\Support\Facades\Storage;

        $cols = 3;
        $rowsToShow = 4;
        $initialCount = $cols * $rowsToShow;
        $items = $blogs ?? $category->blogs()->where('status', 1)->latest()->get();
        $total = $items->count();

        $resolveImage = function ($raw) {
            $raw = $raw ?? null;
            if (empty($raw)) {
                return null;
            }

            // إذا كان مصفوفة أو JSON خذ أول قيمة
            if (is_string($raw) && (Str::startsWith($raw, '[') || Str::startsWith($raw, '{'))) {
                try {
                    $dec = json_decode($raw, true);
                    if (is_array($dec) && count($dec)) {
                        $raw = reset($dec);
                    }
                } catch (\Throwable $e) {
                }
            } elseif (is_array($raw)) {
                $raw = reset($raw);
            }

            $raw = trim($raw);
            $rawTrim = ltrim($raw, '/');

            // روابط خارجية
            if (Str::startsWith($rawTrim, ['http://', 'https://', '//'])) {
                return $rawTrim;
            }

            // تحقق في public مباشرة
            if (file_exists(public_path($rawTrim))) {
                return asset($rawTrim);
            }

            // مجلد الاعتيادي assets/blogs/images
            if (file_exists(public_path('assets/blogs/images/' . $rawTrim))) {
                return asset('assets/blogs/images/' . $rawTrim);
            }

            // مجلد الصور العام عبر storage (بعد storage:link)
            if (Storage::disk('public')->exists($rawTrim)) {
                return asset('storage/' . $rawTrim);
            }

            // لم نجد شيء
            return null;
        };
    @endphp

    <div class="container py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <h3 class="widget_title mb-0 fadeInRight wow title-header-noline" data-wow-delay=".3s">المقالات</h3>
                <div class="section-head d-flex align-items-center justify-content-between mb-5 "></div>

                <div id="blogs-grid" class="row gy-4">
                    @foreach ($items as $index => $blog)
                        @php
                            $hideInitially = $index >= $initialCount;
                            $imgSrc = $resolveImage($blog->img ?? null);
                        @endphp

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 blog-item {{ $hideInitially ? 'd-none hidden-by-js' : '' }}"
                            data-index="{{ $index }}">
                            <div class="wow fadeInUp" data-wow-delay=".3s">
                                {{-- اضف كلاس has-image اذا وجد imgSrc، وإلا no-image --}}
                                <div class="cousrse-card cousrse-card2 {{ $imgSrc ? 'has-image' : 'no-image' }}">
                                    @if ($imgSrc)
                                        <div class="box-img global-img tow_height">
                                            <a href="{{ route('frontend.blogs.show', $blog->slug) }}"
                                                aria-label="{{ e($blog->title) }}">
                                                <img src="{{ $imgSrc }}" alt="{{ e($blog->title) }}"
                                                    class="tow_height" loading="lazy" decoding="async">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="hei">
                                        <h3 class="box-title">
                                            <a href="{{ route('frontend.blogs.show', $blog->slug) }}">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->title), 25) }}
                                            </a>
                                        </h3>

                                        <p class="tags text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 80) }}
                                        </p>

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
                                </div> {{-- end cousrse-card --}}
                            </div>
                        </div>
                    @endforeach
                </div> {{-- end grid --}}

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

            if (hiddenItems.length === 0) {
                if (showMoreBtn) showMoreBtn.style.display = 'none';
                return;
            }

            showMoreBtn && showMoreBtn.addEventListener('click', function() {
                hiddenItems.forEach(el => el.classList.remove('d-none'));
                if (showMoreBtn) showMoreBtn.classList.add('d-none');
                if (showLessBtn) showLessBtn.classList.remove('d-none');
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
            });

            showLessBtn && showLessBtn.addEventListener('click', function() {
                hiddenItems.forEach(el => el.classList.add('d-none'));
                if (showLessBtn) showLessBtn.classList.add('d-none');
                if (showMoreBtn) showMoreBtn.classList.remove('d-none');
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }

                const grid = document.getElementById('blogs-grid');
                if (grid) grid.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
