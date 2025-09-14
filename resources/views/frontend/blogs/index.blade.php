@extends('layouts.app')
@section('title', 'المقالات')

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
