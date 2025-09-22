@extends('layouts.app')

@section('content')
    <div class="container py-5 px-5">
        <h3 class="mb-4 widget_title title-header-noline fadeInRight wow text-wrap">
            نتائج البحث عن: "{{ $query }}"
        </h3>

        {{-- المدونات --}}
        @if ($blogs->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-blog icon_color"></i> المدونات</h4>
                <div class="list-group">
                    @foreach ($blogs as $blog)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="far fa-newspaper ms-2 icon_color"></i>{{ $blog->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($blog->description))), 80) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $blogs->withQueryString()->links() }}
                </div>
            </section>
        @endif

        {{-- الفيديوهات --}}
        @if ($videos->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-video icon_color"></i> الفيديوهات</h4>
                <div class="list-group">
                    @foreach ($videos as $video)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-play-circle ms-2 icon_color"></i>{{ $video->title }}
                                </h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($video->description))), 80) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.videos.show', $video->slug) }}" class="btn btn-sm btn-primary">
                                مشاهدة
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $videos->withQueryString()->links() }}
                </div>
            </section>
        @endif

        {{-- المقاطع الصوتية --}}
        @if ($audios->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-headphones icon_color"></i> المقاطع الصوتية</h4>
                <div class="list-group">
                    @foreach ($audios as $audio)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fa fa-volume-up ms-2 icon_color"></i>{{ $audio->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($audio->description))), 80) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.audios.show', $audio->slug) }}" class="btn btn-sm btn-primary">
                                استماع
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $audios->withQueryString()->links() }}
                </div>
            </section>
        @endif

        {{-- الفتاوى --}}
        @if ($fatawas->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book-open icon_color"></i> الفتاوى</h4>
                <div class="list-group">
                    @foreach ($fatawas as $fatawa)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-scroll ms-2 icon_color"></i>{{ $fatawa->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($fatawa->description))), 80) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.fatawas.show', $fatawa->slug) }}" class="btn btn-sm btn-primary">
                                قراءة الفتوى
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $fatawas->withQueryString()->links() }}
                </div>
            </section>
        @endif

        {{-- الكتب --}}
        @if ($books->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book icon_color"></i> الكتب</h4>
                <div class="list-group">
                    @foreach ($books as $book)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-book-reader ms-2 icon_color"></i>{{ $book->title }}
                                </h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($book->description))), 80) }}
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('frontend.books.show', $book->slug) }}" class="btn btn-sm btn-primary">
                                    قراءة
                                </a>
                                <a href="{{ route('frontend.books.download', $book->slug) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-download"></i> تحميل
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $books->withQueryString()->links() }}
                </div>
            </section>
        @endif

        {{-- الدرر --}}
        @if ($durars->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-gem icon_color"></i> الدرر</h4>
                <div class="list-group">
                    @foreach ($durars as $durar)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-gem ms-2 icon_color "></i>{{ $durar->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($durar->description))), 80) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.durars.show', $durar->slug) }}" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $durars->withQueryString()->links() }}
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
