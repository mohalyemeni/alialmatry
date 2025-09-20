@extends('layouts.app')
@section('title', e($book->title ?? 'الكتاب'))
@section('description', e($book->excerpt ?? strip_tags(Str::limit($book->description ?? '', 160))))
@section('keywords', "كتب, {$book->title}, مؤلفات")
@section('canonical', urldecode(route('frontend.books.show', $book->slug ?? '')))

@section('og_type', 'article')
@section('og_title', e($book->title ?? 'الكتاب'))
@section('og_description', e($book->excerpt ?? strip_tags(Str::limit($book->description ?? '', 160))))
@section('og_image', $book->img && file_exists(public_path('assets/books/images/' . $book->img)) ?
    asset('assets/books/images/' . $book->img) : asset('frontand/assets/img/books/default.jpg'))
@section('og_url', urldecode(route('frontend.books.show', $book->slug ?? '')))
@section('og_keywords', "كتب, {$book->title}, مؤلفات")

@section('twitter_card', 'summary_large_image')
@section('twitter_title', e($book->title ?? 'الكتاب'))
@section('twitter_description', e($book->excerpt ?? strip_tags(Str::limit($book->description ?? '', 160))))
@section('twitter_image', $book->img && file_exists(public_path('assets/books/images/' . $book->img)) ?
    asset('assets/books/images/' . $book->img) : asset('frontand/assets/img/books/default.jpg'))
@section('twitter_keywords', "كتب, {$book->title}, مؤلفات")

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ e($book->title) }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.books.index') }}" class="text-white">الكتب
                            والمؤلفات</a></li>
                    <li class="list-inline-item text-white-50">{{ e(\Illuminate\Support\Str::limit($book->title, 60)) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="product-details overflow-hidden space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-4 gy-4">
                <!-- MAIN -->
                <main class="col-12 col-lg-8 order-2 order-lg-1">
                    <div class="sermon-card product-about p-4">
                        <div class="d-flex align-items-start gap-3 flex-column flex-md-row">
                            <div class="book-cover-wrap">
                                <img src="{{ $img }}" alt="{{ e($book->title) }}" class="book-cover shadow-sm">
                            </div>


                            <div class="flex-grow-1">
                                <h2 class="product-title mb-2">{{ e($book->title) }}</h2>

                                <div class="product-meta mb-3 text-muted small">
                                    <span>تاريخ النشر: {{ optional($book->published_on)->format('d M, Y') ?? '—' }}</span>
                                    <span class="mx-2">|</span>
                                    <span>المشاهدات: {{ $book->views ?? 0 }}</span>
                                </div>

                                <div class="mb-3">
                                    {!! $book->description !!}
                                </div>

                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    @if ($book->file && file_exists(public_path('assets/books/files/' . $book->file)))
                                        <a href="{{ route('frontend.books.download', $book->slug) }}"
                                            class="th-btn style1 th-btn11">
                                            تحميل الكتاب <i class="fa-solid fa-download ms-2"></i>
                                        </a>
                                    @else
                                        <span class="th-btn disabled">لا يوجد ملف</span>
                                    @endif

                                    <a href="{{ route('frontend.books.index') }}" class="th-btn new_pad">عودة للكتب</a>


                                </div>

                                @if (!empty($book->meta_keywords) || !empty($book->meta_description))
                                    <div class="book-meta-info mt-3 small text-muted">
                                        @if (!empty($book->meta_keywords))
                                            <div><strong>كلمات مفتاحية:</strong> {{ e($book->meta_keywords) }}</div>
                                        @endif
                                        @if (!empty($book->meta_description))
                                            <div><strong>وصف الميتا:</strong> {{ e($book->meta_description) }}</div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>
                </main>

                <!-- SIDEBAR -->
                <aside class="col-12 col-lg-4 order-1 order-lg-2">
                    <div class="sermon-card   p-3">
                        <h3 class="mb-3 widget_title title-header-noline fadeInRight wow">أحدث الكتب</h3>

                        @php
                            $recentList =
                                $recentBooks ??
                                \App\Models\Book::where('status', true)
                                    ->where(function ($q) {
                                        $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                    })
                                    ->orderByDesc('published_on')
                                    ->take(6)
                                    ->get();
                        @endphp

                        @if ($recentList->isNotEmpty())
                            <div class="recent-books-list">
                                @foreach ($recentList as $rb)
                                    @php
                                        $thumb =
                                            $rb->img ??
                                            (!empty($rb->img) &&
                                            file_exists(public_path('assets/books/images/' . $rb->img))
                                                ? asset('assets/books/images/' . $rb->img)
                                                : asset('frontand/assets/img/normal/counter-image.jpg'));
                                    @endphp

                                    <a href="{{ route('frontend.books.show', $rb->slug) }}"
                                        class="recent-book-item d-flex mb-3 text-decoration-none">
                                        <div style="flex:0 0 72px;">
                                            <img src="{{ $thumb }}" alt="{{ e($rb->title) }}" class="recent-thumb"
                                                style="width:72px;height:72px;object-fit:cover;border-radius:6px;">
                                        </div>
                                        <div class="flex-grow-1 ps-3">
                                            <h6 class="mb-1 recent-title">
                                                {{ e(\Illuminate\Support\Str::limit($rb->title, 60)) }}</h6>

                                            <div class="d-flex align-items-center justify-content-between mb-1"
                                                style="gap:8px;">
                                                <small class="text-muted">{{ $rb->published_on ?? '' }}</small>

                                                <div class="text-muted small d-flex align-items-center" style="gap:6px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                    <span>{{ $rb->views ?? 0 }}</span>
                                                </div>
                                            </div>


                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <div class="mt-3 text-end">
                                <a href="{{ route('frontend.books.index') }}" class="th-btn new_pad">عرض المزيد <i
                                        class="fa-solid fa-arrow-left ms-1"></i></a>
                            </div>
                        @else
                            <p class="text-muted mb-0">لا توجد كتب حديثة حالياً.</p>
                        @endif
                    </div>
                </aside>

            </div>
        </div>
    </section>
@endsection
