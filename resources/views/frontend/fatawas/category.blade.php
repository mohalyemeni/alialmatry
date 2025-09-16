@extends('layouts.app')
@section('title', $category->title)

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
            <div class="col-md-8">
                <div class="list-group">
                    @foreach ($fatawas as $fatawa)
                        @include('frontend.fatawas.partials.category_partial', ['fatawa' => $fatawa])
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $fatawas->links() }}
                </div>
            </div>
            <aside class="col-xxl-4 col-lg-4  pb-5">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-gavel me-2 text-primary"></i>
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
                            <ul class="list-unstyled mb-0 pr-0">
                                @foreach ($recentList as $item)
                                    @php
                                        $thumb = null;
                                        if (!empty($item->img)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($item->img, ['http://', 'https://'])
                                            ) {
                                                $thumb = $item->img;
                                            } elseif (file_exists(public_path('assets/fatawa/images/' . $item->img))) {
                                                $thumb = asset('assets/fatawa/images/' . $item->img);
                                            } elseif (file_exists(public_path($item->img))) {
                                                $thumb = asset($item->img);
                                            } elseif (
                                                \Illuminate\Support\Facades\Storage::disk('public')->exists($item->img)
                                            ) {
                                                $thumb = asset('storage/' . ltrim($item->img, '/'));
                                            }
                                        }
                                        $thumb = $thumb ?: null;

                                        $rDate = $item->published_on
                                            ? \Carbon\Carbon::parse($item->published_on)->format('d M, Y')
                                            : '';
                                    @endphp

                                    <li class="d-flex align-items-start mb-3 recent-video-item gap-3">
                                        <a href="{{ route('frontend.fatawas.show', $item->slug) }}">
                                            <img src="{{ $thumb }}" alt=""
                                                class="recent-video-thumb recent-fatawa-thumb"
                                                style="width:88px;height:64px;object-fit:cover;border-radius:6px;">
                                        </a>

                                        <div class="flex-grow-1" style="min-width:0;">
                                            <a href="{{ route('frontend.fatawas.show', $item->slug) }}"
                                                class="d-block fw-bold text-dark small mb-1">
                                                {{ \Illuminate\Support\Str::limit($item->title, 72) }}
                                            </a>

                                            <small class="text-muted d-block mb-1">{{ $rDate }}</small>

                                            <div class="d-flex align-items-center text-muted small" style="gap:.5rem;">
                                                <i class="fa-solid fa-eye me-1"></i> {{ $item->views ?? 0 }}

                                                @if (!empty($item->category))
                                                    <a href="{{ route('frontend.fatawas.category', $item->category->slug ?? '#') }}"
                                                        class="recent-video-badge ms-2"
                                                        title="{{ e($item->category->title) }}">
                                                        <i class="fa-solid fa-folder-open" aria-hidden="true"
                                                            style="font-size:0.78rem;"></i>
                                                        <span class="recent-video-badge-text d-none d-sm-inline">
                                                            {{ \Illuminate\Support\Str::limit($item->category->title, 18) }}
                                                        </span>
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
