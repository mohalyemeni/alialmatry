@extends('layouts.app')

@section('title', $category->title ?? 'المرئيات')
@section('description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات'))
@section('keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? ''))
@section('canonical', urldecode(route('frontend.videos.category', $category->slug ?? '')))

@section('og_type', 'website')
@section('og_title', $category->title ?? 'المرئيات')
@section('og_description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات'))
@section('og_image', $category->img ? asset('assets/video_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', urldecode(route('frontend.videos.category', $category->slug ?? '')))
@section('og_keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? ''))
@section('twitter_card', 'summary_large_image')
@section('twitter_title', $category->title ?? 'المرئيات')
@section('twitter_description', $category->description ?? 'عرض الفيديوهات ضمن فئة ' . ($category->title ?? 'المرئيات'))
@section('twitter_image', $category->img ? asset('assets/video_categories/' . $category->img) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', $category->keywords ?? 'فيديوهات, مرئيات, ' . ($category->title ?? ''))

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $category->title ?? 'المرئيات' }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.videos.index') }}"
                            class="text-white">المرئيات</a></li>
                    @if (isset($category))
                        <li class="list-inline-item">{{ $category->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div id="ajax-content">
        @include('frontend.partials.category_partial', [
            'category' => $category,
            'videos' => $videos,
        ])
    </div>
@endsection
