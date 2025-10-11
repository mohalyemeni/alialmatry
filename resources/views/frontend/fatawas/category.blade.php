@extends('layouts.app')

@section('title', $category->title ?? 'الفتاوى')
@section('description', $category->description ?? 'عرض آخر الفتاوى ضمن تصنيف ' . ($category->title ?? ''))
@section('keywords', $category->keywords ?? 'فتاوى, ' . ($category->title ?? '') . ', أسئلة شرعية')
@section('canonical', urldecode(route('frontend.fatawas.category', $category->slug ?? '')))

@section('og_type', 'website')
@section('og_title', $category->title ?? 'الفتاوى')
@section('og_description', $category->description ?? 'عرض آخر الفتاوى ضمن تصنيف ' . ($category->title ?? ''))
@section('og_image', $category->img ? asset('assets/fatwa_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', urldecode(route('frontend.fatawas.category', $category->slug ?? '')))
@section('og_keywords', $category->keywords ?? 'فتاوى, ' . ($category->title ?? '') . ', أسئلة شرعية')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $category->title ?? 'الفتاوى')
@section('twitter_description', $category->description ?? 'عرض آخر الفتاوى ضمن تصنيف ' . ($category->title ?? ''))
@section('twitter_image', $category->img ? asset('assets/fatwa_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', $category->keywords ?? 'فتاوى, ' . ($category->title ?? '') . ', أسئلة شرعية')

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $category->title }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.fatawas.index') }}"
                            class="text-white">الفتاوى</a></li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <div class=" col-xxl-8 col-lg-8">
                <div class="list-group">
                    @foreach ($fatawas as $fatawa)
                        @include('frontend.fatawas.partials.category_partial', ['fatawa' => $fatawa])
                    @endforeach
                </div>

                <div class="mt-5 mb-5">
                    {{ $fatawas->links('pagination::simple-tailwind') }}
                </div>
            </div>
            <aside class="col-xxl-4 col-lg-4 pb-5">
                <div class="card shadow-sm border-0 sticky-top" style="top:100px; border-radius:12px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4 d-flex align-items-center text-primary fw-bold">
                            <i class="fa-solid fa-gavel me-2 ms-2"></i>
                            أحدث الفتاوى
                        </h5>

                        @php
                            $recentList =
                                $recentFatawas ??
                                \App\Models\Fatwa::with('category')
                                    ->where('status', 1)
                                    ->where(function ($q) {
                                        $q->whereNull('published_on')->orWhere('published_on', '<=', now());
                                    })
                                    ->orderByDesc('published_on')
                                    ->take(6)
                                    ->get();
                        @endphp

                        @if ($recentList->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach ($recentList as $item)
                                    @php
                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    @endphp

                                    <li class="d-flex align-items-start mb-3 pb-3 border-bottom recent-fatwa-item">
                                        <div class="me-2 flex-shrink-0">
                                            <a href="{{ route('frontend.fatawas.show', $item->slug) }}"
                                                class="d-flex align-items-center justify-content-center bg-light rounded-circle ms-3"
                                                style="width:40px;height:40px;">
                                                <i class="fa fa-gavel text-primary"></i>
                                            </a>
                                        </div>

                                        <div class="flex-grow-1">
                                            <a href="{{ route('frontend.fatawas.show', $item->slug) }}"
                                                class="d-block fw-bold text-dark small mb-1">
                                                {{ \Illuminate\Support\Str::limit($item->title, 72) }}
                                            </a>

                                            <small class="text-muted d-block mb-1">{{ $rDate }}</small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> {{ $item->views ?? 0 }}

                                                @if (!empty($item->category))
                                                    <a href="{{ route('frontend.fatawas.category', $item->category->slug ?? '#') }}"
                                                        class="badge bg-light text-dark fw-normal px-2 py-1"
                                                        title="{{ e($item->category->title) }}">
                                                        <i class="fa-solid fa-folder-open me-1"
                                                            style="font-size:0.78rem;"></i>
                                                        {{ \Illuminate\Support\Str::limit($item->category->title, 18) }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-3 text-start">
                                <a href="{{ route('frontend.fatawas.index') }}" class="th-btn">
                                    عرض المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                </a>
                            </div>
                        @else
                            <p class="text-muted mb-0">لا توجد فتاوى حديثة.</p>
                        @endif
                    </div>
                </div>
            </aside>




        </div>
    </div>
@endsection
