@extends('layouts.app')
@section('title', 'نتائج البحث: ' . $q)

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">نتائج البحث عن: <strong>{{ e($q) }}</strong></h2>

        @if (empty($results))
            <p class="text-muted">لا توجد مصادر بحث معرفة.</p>
        @endif

        @foreach ($results as $key => $block)
            @php
                $items = $block['items'];
                $cfg = $block['config'];
                $routeName = $cfg['route'] ?? null;
                $routeParam = $cfg['param'] ?? 'id';
                $titleField = $cfg['fields'][0] ?? 'title';
            @endphp

            <section class="mb-5">
                <h4 class="mb-3">{{ ucfirst($key) }} <small class="text-muted">({{ $items->total() }})</small></h4>

                @if ($items->count())
                    <ul class="list-unstyled">
                        @foreach ($items as $item)
                            <li class="mb-3">
                                @if ($routeName && \Route::has($routeName) && isset($item->{$routeParam}))
                                    <a href="{{ route($routeName, $item->{$routeParam}) }}">
                                        {{ $item->{$titleField} ?? 'عرض' }}
                                    </a>
                                @elseif($routeName && \Route::has($routeName) && isset($item->id))
                                    <a href="{{ route($routeName, $item->id) }}">
                                        {{ $item->{$titleField} ?? 'عرض' }}
                                    </a>
                                @else
                                    {{ $item->{$titleField} ?? 'عرض' }}
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    {{-- صفحات النتائج خاصة بالمصدر --}}
                    <div>
                        {{ $items->appends(request()->all())->links() }}
                    </div>
                @else
                    <p class="text-muted">لا توجد نتائج في هذا المصدر.</p>
                @endif
            </section>
        @endforeach
    </div>
@endsection
