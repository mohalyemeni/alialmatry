@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4 mt- widget_title title-header-noline fadeInRight wow text-wrap">نتائج البحث عن: "{{ $query }}"
        </h3>

        @if ($blogs->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">المدونات</h4>
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($blog->description))), 100) }}</p>
                                    <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="btn btn-primary">قراءة
                                        المزيد</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($videos->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">الفيديوهات</h4>
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($video->description))), 100) }}</p>
                                    <a href="{{ route('frontend.videos.show', $video->slug) }}"
                                        class="btn btn-primary">مشاهدة</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($audios->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">المقاطع الصوتية</h4>
                <div class="row">
                    @foreach ($audios as $audio)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $audio->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($audio->description))), 100) }}</p>
                                    <a href="{{ route('frontend.audios.show', $audio->slug) }}"
                                        class="btn btn-primary">استماع</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($fatawas->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">الفتاوى</h4>
                <div class="row">
                    @foreach ($fatawas as $fatawa)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $fatawa->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($fatawa->description))), 100) }}
                                    </p>
                                    <a href="{{ route('frontend.fatawas.show', $fatawa->slug) }}"
                                        class="btn btn-primary">قراءة الفتوى</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($books->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">الكتب</h4>
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($book->description))), 100) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('frontend.books.show', $book->slug) }}"
                                            class="btn btn-primary">قراءة</a>
                                        <a href="{{ route('frontend.books.download', $book->slug) }}"
                                            class="btn btn-outline-secondary">
                                            <i class="fas fa-download"></i> تحميل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($durars->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3">الدرر</h4>
                <div class="row">
                    @foreach ($durars as $durar)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $durar->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(trim(strip_tags(html_entity_decode($durar->description))), 100) }}
                                    </p>
                                    <a href="{{ route('frontend.durars.show', $durar->slug) }}"
                                        class="btn btn-primary1">قراءة المزيد</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if (
            $blogs->count() == 0 &&
                $videos->count() == 0 &&
                $audios->count() == 0 &&
                $fatawas->count() == 0 &&
                $books->count() == 0 &&
                $durars->count() == 0)
            <div class="alert alert-info text-center">
                لم يتم العثور على نتائج للبحث "{{ $query }}"
            </div>
        @endif
    </div>
@endsection
