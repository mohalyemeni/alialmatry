<div class="wow fadeInUp" data-wow-delay=".3s">
    <div class="cousrse-card cousrse-card2">
        @php
            $imgSrc = null;
            $raw = $blog->img ?? null;

            if (!empty($raw)) {
                if (\Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                    $imgSrc = $raw;
                } else {
                    $candidate1 = 'assets/blogs/images/' . ltrim($raw, '/');
                    $candidate2 = 'storage/' . ltrim($raw, '/');
                    $candidate3 = ltrim($raw, '/');

                    if (file_exists(public_path($candidate1))) {
                        $imgSrc = asset($candidate1);
                    } elseif (file_exists(public_path($candidate2))) {
                        $imgSrc = asset($candidate2);
                    } elseif (file_exists(public_path($candidate3))) {
                        $imgSrc = asset($candidate3);
                    } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($raw)) {
                        $imgSrc = asset('storage/' . ltrim($raw, '/'));
                    }
                }
            }

            // لا نُعيّن placeholder هنا — نريد إختفاء الصورة لو لم توجد
            // $imgSrc = $imgSrc ?? asset('frontand/assets/img/normal/counter-image.jpg');

        @endphp

        {{-- فقط نعرض الـ box-img لو كانت الصورة موجودة --}}
        @if ($imgSrc)
            <div class="box-img global-img tow_height">
                <a href="{{ route('frontend.blogs.show', $blog->slug) }}" aria-label="{{ e($blog->title) }}">
                    <img src="{{ $imgSrc }}" alt="{{ e($blog->title) }}" class="tow_height"
                        style="width:100%; height:100%; object-fit:cover;">
                </a>
            </div>
        @endif

        <div class="hei{{ $imgSrc ? '' : ' no-image' }}">
            <h3 class="box-title">
                <a
                    href="{{ route('frontend.blogs.show', $blog->slug) }}">{{ \Illuminate\Support\Str::limit(strip_tags($blog->title), 20) }}</a>
            </h3>

            <p class="tags text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 50) }}</p>

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
