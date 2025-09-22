@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4 widget_title title-header-noline fadeInRight wow text-wrap">
            نتائج البحث عن: "{{ $query }}"
        </h3>

        {{-- المدونات --}}
        @if ($blogs->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-blog text-primary"></i> المدونات</h4>
                <div class="list-group">
                    @foreach ($blogs as $blog)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="far fa-newspaper me-2 text-muted"></i>{{ $blog->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($blog->description))), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{ $blogs->withQueryString()->links() }}</div>
            </section>
        @endif

        {{-- الفيديوهات --}}
        @if ($videos->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-video text-danger"></i> الفيديوهات</h4>
                <div class="list-group">
                    @foreach ($videos as $video)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-play-circle me-2 text-danger"></i>{{ $video->title }}
                                </h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($video->description))), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.videos.show', $video->slug) }}" class="btn btn-sm btn-primary">
                                مشاهدة
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{ $videos->withQueryString()->links() }}</div>
            </section>
        @endif

        {{-- المقاطع الصوتية --}}
        @if ($audios->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-headphones text-success"></i> المقاطع الصوتية</h4>
                <div class="list-group">
                    @foreach ($audios as $audio)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-music me-2 text-success"></i>{{ $audio->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($audio->description))), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.audios.show', $audio->slug) }}" class="btn btn-sm btn-primary">
                                استماع
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{ $audios->withQueryString()->links() }}</div>
            </section>
        @endif

        {{-- الفتاوى --}}
        @if ($fatawas->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book-open text-warning"></i> الفتاوى</h4>
                <div class="list-group">
                    @foreach ($fatawas as $fatawa)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-scroll me-2 text-warning"></i>{{ $fatawa->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($fatawa->description))), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.fatawas.show', $fatawa->slug) }}" class="btn btn-sm btn-primary">
                                قراءة الفتوى
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{ $fatawas->withQueryString()->links() }}</div>
            </section>
        @endif

        {{-- الكتب --}}
        @if ($books->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-book text-info"></i> الكتب</h4>
                <div class="list-group">
                    @foreach ($books as $book)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-book-reader me-2 text-info"></i>{{ $book->title }}
                                </h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($book->description))), 120) }}
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
                <div class="mt-3">{{ $books->withQueryString()->links() }}</div>
            </section>
        @endif

        {{-- الدرر --}}
        @if ($durars->count() > 0)
            <section class="mb-5">
                <h4 class="mb-3"><i class="fas fa-gem text-secondary"></i> الدرر</h4>
                <div class="list-group">
                    @foreach ($durars as $durar)
                        <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-gem me-2 text-secondary"></i>{{ $durar->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    {{ Str::limit(trim(strip_tags(html_entity_decode($durar->description))), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('frontend.durars.show', $durar->slug) }}" class="btn btn-sm btn-primary">
                                قراءة المزيد
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{ $durars->withQueryString()->links() }}</div>
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
