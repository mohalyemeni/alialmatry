@extends('layouts.app')

@section('title', 'المرئيات')
@section('description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع')
@section('keywords', 'فيديوهات, مرئيات, موقعنا')
@section('canonical', urldecode(route('frontend.videos.index')))
@section('og_type', 'website')
@section('og_title', 'المرئيات')
@section('og_description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع')
@section('og_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', route('frontend.videos.index'))
@section('og_keywords', 'فيديوهات, مرئيات, موقعنا')
@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'المرئيات')
@section('twitter_description', 'عرض آخر المرئيات والفيديوهات المتاحة على الموقع')
@section('twitter_image', asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', 'فيديوهات, مرئيات, موقعنا')

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

    <div id="ajax-content">
        @include('frontend.partials.index_partial', ['categories' => $categories])
    </div>
@endsection
