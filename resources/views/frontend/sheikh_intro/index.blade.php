@extends('layouts.app')
@section('title', 'نبذة عن الشيخ')

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ __('panel.sheikh_intro') }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}"
                            class="text-white">{{ __('panel.home') }}</a></li>
                    <li class="list-inline-item">{{ __('panel.sheikh_intro') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="overflow-hidden bg-white position-relative pt-30 my-animation theme_overlay" id="sheikh-intro-sec">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                @if ($sheikhIntro)
                    <div class="col-12">
                        <div class="blog-grid style2">
                            <div class="blog-img blog-img1 global-img wow fadeInLeft" data-wow-delay=".3s">
                                <img src="{{ $sheikhIntro->img ? asset('assets/sheikh_intro/images/' . $sheikhIntro->img) : asset('frontand/assets/img/team/default.png') }}"
                                    alt="{{ $sheikhIntro->title }}">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title wow fadeInRight" data-wow-delay=".4s">
                                    {{ $sheikhIntro->title }}
                                </h3>
                                <p class="box-text wow fadeInUp" data-wow-delay=".6s">
                                    {!! $sheikhIntro->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <p>{{ __('panel.intro') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
