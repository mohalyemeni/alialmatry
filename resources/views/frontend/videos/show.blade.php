@extends('layouts.app')

@section('title', $video->title ?? 'المرئيات')
@section('description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات'))
@section('keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? ''))
@section('canonical', urldecode(route('frontend.videos.show', $video->slug ?? '')))
@section('og_type', 'video')
@section('og_title', $video->title ?? 'المرئيات')
@section('og_description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات'))
@section('og_image', $video->thumbnail ? asset('upload/' . $video->thumbnail) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('og_url', urldecode(route('frontend.videos.show', $video->slug ?? '')))
@section('og_keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? ''))
@section('twitter_card', 'summary_large_image')
@section('twitter_title', $video->title ?? 'المرئيات')
@section('twitter_description', $video->description ?? 'مشاهدة الفيديو ' . ($video->title ?? 'المرئيات'))
@section('twitter_image', $video->thumbnail ? asset('upload/' . $video->thumbnail) :
    asset('frontand/assets/img/hero/hero_5_3.jpg'))
@section('twitter_keywords', $video->meta_keywords ?? 'فيديو, مرئيات, ' . ($video->title ?? ''))

@section('content')
    <div class="breadcumb-wrapper"
        style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $video->title ?? 'المرئيات' }}</h1>
                <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                    <li class="list-inline-item"><a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a></li>
                    <li class="list-inline-item"><a href="{{ route('frontend.videos.index') }}"
                            class="text-white">المرئيات</a></li>
                    @if (isset($video->category))
                        <li class="list-inline-item"><a
                                href="{{ route('frontend.videos.category', $video->category->slug) }}"
                                class="text-white">{{ $video->category->title }}</a></li>
                    @endif
                    <li class="list-inline-item">{{ $video->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="ajax-content">
        @include('frontend.partials.show_partial', [
            'video' => $video,
            'recentVideos' => $recentVideos,
        ])
    </div>
@endsection
