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
                    <li class="list-inline-item"><a href="{{ route('frontend.blogs.index') }}"
                            class="text-white">المقالات</a></li>
                    <li class="list-inline-item">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container py-4">
        <div class="row">

            <div class="col-12 col-xl-8">
                <h3 class="widget_title mb-0 fadeInRight wow title-header-noline" data-wow-delay=".3s">
                    المقالات
                </h3>

                <div class="list-group mt-3">
                    {{-- استخدم المتغير $blogs (paginated) --}}
                    @forelse ($blogs as $blog)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div class="me-3" style="flex:1;">
                                <h5 class="mb-1">
                                    <i class="fa fa-newspaper me-2 text-primary"></i>
                                    <a href="{{ route('frontend.blogs.show', $blog->slug) }}">
                                        {{ e($blog->title) }}
                                    </a>
                                </h5>

                                @if (!empty($blog->excerpt))
                                    <p class="mb-1 text-muted small">
                                        {{ e($blog->excerpt) }}
                                    </p>
                                @endif
                            </div>

                            <div class="button-wrapp d-flex align-items-center">
                                <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="th-btn style1 th-btn1">
                                    <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                    <i class="fa-solid fa-eye me-1"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">لا توجد مقالات في هذا التصنيف.</p>
                    @endforelse
                </div>

                {{-- pagination --}}
                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="col-12 col-xl-4">
                <div class="card sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-newspaper me-2 text-primary"></i>
                            أحدث المقالات
                        </h5>

                        @if (!empty($recentBlogs) && $recentBlogs->count())
                            <ul class="list-group list-unstyled mb-0">
                                @foreach ($recentBlogs as $item)
                                    <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                        <div class="me-3" style="flex:1;">
                                            <h6 class="mb-1">
                                                <a href="{{ route('frontend.blogs.show', $item->slug) }}">
                                                    {{ e(\Illuminate\Support\Str::limit($item->title, 50)) }}
                                                </a>
                                            </h6>

                                            @if (!empty($item->excerpt))
                                                <p class="mb-1 text-muted small">
                                                    {{ e($item->excerpt) }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="button-wrapp d-flex align-items-center">
                                            <a href="{{ route('frontend.blogs.show', $item->slug) }}"
                                                class="th-btn style1 th-btn1">
                                                <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
                                                <i class="fa-solid fa-eye me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">لا توجد مقالات حديثة.</p>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
