@extends('layouts.app')

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">المرئيات</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">المرئيات</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow" data-wow-delay=".3s">
            الدرر السنية
        </h3>

        @if ($durars->count())
            <div class="row gy-4">
                @foreach ($durars as $d)
                    <div class="col-md-6 col-lg-6">
                        <div class="event-card event-card1 wow fadeInUp" data-wow-delay=".3s">
                            <div class="box-img global-img box-img1">
                                @php
                                    $img =
                                        $d->img && file_exists(public_path('assets/durar_diniya/images/' . $d->img))
                                            ? asset('assets/durar_diniya/images/' . $d->img)
                                            : asset('frontand/assets/img/normal/counter-image.jpg');
                                @endphp
                                <a href="{{ route('frontend.durars.show', $d->slug) }}">
                                    <img src="{{ $img }}" alt="{{ e($d->title) }}" class="durar-img">
                                </a>
                            </div>

                            <div class="box-content">
                                <h3 class="box-title">
                                    <a href="{{ route('frontend.durars.show', $d->slug) }}">
                                        {{ e(\Illuminate\Support\Str::limit($d->title, 60)) }}
                                    </a>
                                </h3>

                                <div class="event-meta">
                                    @if ($d->published_on)
                                        <a href="{{ route('frontend.durars.show', $d->slug) }}">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            {{ \Carbon\Carbon::parse($d->published_on)->format('M d, Y') }}
                                        </a>
                                    @endif
                                </div>

                                <p class="text-muted mb-3">
                                    {{ e(\Illuminate\Support\Str::limit(strip_tags($d->excerpt), 120)) }}
                                </p>

                                <a href="{{ route('frontend.durars.show', $d->slug) }}" class="th-btn">
                                    <span class="btn-text" data-back="قراءة" data-front="قراءة"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $durars->links() }}
            </div>
        @else
            <p class="text-muted">لا توجد درر لعرضها حالياً.</p>
        @endif
    </div>
@endsection
