@extends('layouts.app')
@section('title', 'الكتب والمؤلفات')
@section('description', 'عرض جميع الكتب والمؤلفات المتاحة على الموقع')
@section('keywords', 'كتب, مؤلفات, مكتبة, تحميل كتب')
@section('canonical', urldecode(route('frontend.books.index')))

@section('og_type', 'website')
@section('og_title', 'الكتب والمؤلفات')
@section('og_description', 'عرض جميع الكتب والمؤلفات المتاحة على الموقع')
@section('og_image', asset('frontand/assets/img/books/default.jpg'))
@section('og_url', urldecode(route('frontend.books.index')))
@section('og_keywords', 'كتب, مؤلفات, مكتبة, تحميل كتب')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'الكتب والمؤلفات')
@section('twitter_description', 'عرض جميع الكتب والمؤلفات المتاحة على الموقع')
@section('twitter_image', asset('frontand/assets/img/books/default.jpg'))
@section('twitter_keywords', 'كتب, مؤلفات, مكتبة, تحميل كتب')

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">الكتب والمؤلفات</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">الكتب والمؤلفات</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 575.98px) {
            .service-box2 {
                margin-bottom: 1rem;
            }
        }

        .service-box2 .box-img img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>

    <div class="container py-4">
        <div class="col-12 col-xl-12">

            <h3 class="title-header-noline widget_title  mb-5 fadeInRight wow" data-wow-delay=".3s">الكتب والمؤلفات</h3>

            <div class="services-replace">
                <div class="row">
                    @forelse ($books as $book)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="service-box2 wow fadeInUp h-100" data-wow-delay=".3s">
                                <div class="box-img">
                                    <a href="{{ route('frontend.books.show', $book->slug) }}">
                                        <img src="{{ $book->img && file_exists(public_path('assets/books/images/' . $book->img)) ? asset('assets/books/images/' . $book->img) : asset('frontand/assets/img/books/default.jpg') }}"
                                            alt="{{ $book->title }}">
                                    </a>
                                </div>
                                <div class="box-info">
                                    <div class="box-icon">
                                        <img src="{{ asset('frontand/assets/img/icon/service_2_2.svg') }}" alt="Icon">
                                    </div>
                                    <h3 class="box-title">
                                        <a href="{{ route('frontend.books.show', $book->slug) }}">
                                            {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->title)), 15) }}
                                        </a>
                                    </h3>
                                </div>
                                <div class="box-content">
                                    <div class="box-wrapp">
                                        <div class="box-icon">
                                            <img src="{{ asset('frontand/assets/img/icon/service_2_2.svg') }}"
                                                alt="Icon">
                                        </div>
                                        <h3 class="box-title">
                                            <a href="{{ route('frontend.books.show', $book->slug) }}">
                                                {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->title)), 15) }}
                                            </a>
                                        </h3>
                                        <p class="box-desc">
                                            {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($book->description)), 140) }}
                                        </p>
                                    </div>
                                    <div class="service-btn">
                                        @if ($book->file && file_exists(public_path('assets/books/files/' . $book->file)))
                                            <a href="{{ route('frontend.books.download', $book->slug) }}"
                                                class="simple-btn">
                                                تحميل <i class="fa-solid fa-download ms-2"></i>
                                            </a>
                                        @else
                                            <a href="#" class="simple-btn disabled">لا يوجد ملف</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>لا توجد كتب حالياً.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- pagination -->
            <div class="row mt-3">
                <div class="col-12">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
