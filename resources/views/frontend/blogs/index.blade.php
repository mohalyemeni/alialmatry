@extends('layouts.app')
@section('title', 'المقالات')
@section('description', 'عرض آخر تصنيفات المقالات والمقالات المتاحة على الموقع')
@section('keywords', 'مقالات, مدونة, موقعنا')
@section('canonical', urldecode(route('frontend.blogs.index')))
@section('og_type', 'website')
@section('og_title', 'المقالات')
@section('og_description', 'عرض آخر تصنيفات المقالات والمقالات المتاحة على الموقع')
@section('og_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', route('frontend.blogs.index'))
@section('og_keywords', 'مقالات, مدونة, موقعنا')
@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'المقالات')
@section('twitter_description', 'عرض آخر تصنيفات المقالات والمقالات المتاحة على الموقع')
@section('twitter_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', 'مقالات, مدونة, موقعنا')

@section('content')

    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">المقالات</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item">المقالات</li>
                </ul>
            </div>
        </div>
    </div>

    @include('frontend.blogs.partials.index_partial', ['categories' => $categories])

@endsection
