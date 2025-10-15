@if (isset($audioCategories) && $audioCategories->count())
    <section>
        <div class="pb_80 row spical m-0 padding_top" dir="rtl">


            <section class="tabs-section col-lg-7 col-12">
                <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                    <h3 class="widget_title mb-0 wow fadeInRight" data-wow-delay=".3s">الصوتيات</h3>

                    <div class="btn-group">
                        <a href="{{ route('frontend.audios.index') }}" class="th-btn style1">
                            <span class="btn-text" data-back=" المزيد" data-front=" المزيد"></span>
                        </a>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="audioTabs" role="tablist">
                    @foreach ($audioCategories as $i => $cat)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $i === 0 ? 'active' : '' }} btn_font_size"
                                id="audio-tab-{{ $cat->id }}" data-bs-toggle="tab"
                                data-bs-target="#audio-{{ $cat->id }}" type="button" role="tab"
                                aria-controls="audio-{{ $cat->id }}"
                                aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                                {{ e(\Illuminate\Support\Str::limit($cat->title, 15)) }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="audioTabsContent">
                    @foreach ($audioCategories as $i => $cat)
                        <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="audio-{{ $cat->id }}"
                            role="tabpanel" aria-labelledby="audio-tab-{{ $cat->id }}">
                            <div class="background_color">
                                @php
                                    $audios = $cat->audios ?? collect();
                                @endphp

                                @forelse($audios as $audio)
                                    @php
                                        $rawFile = $audio->audio_file ?? null;
                                        $isExternal = false;
                                        $downloadUrl = null;

                                        if (!empty($rawFile)) {
                                            if (
                                                \Illuminate\Support\Str::startsWith($rawFile, ['http://', 'https://'])
                                            ) {
                                                $isExternal = true;
                                                $downloadUrl = $rawFile;
                                            } else {
                                                $downloadUrl = route('frontend.audios.download', $audio->id);
                                            }
                                        }
                                    @endphp

                                    <div
                                        class="audio-play-wrapp d-flex justify-content-between align-items-center mb-2">
                                        <div class="flex-1 me-1">
                                            <h5 class="card-title mb-0 a_font_size">
                                                <a
                                                    href="{{ route('frontend.audios.show', $audio->slug ?? $audio->id) }}">
                                                    {{ e(\Illuminate\Support\Str::limit($audio->title, 80)) }}
                                                </a>
                                            </h5>
                                            @if (!empty($audio->author))
                                                <small class="d-block text-muted">{{ e($audio->author) }}</small>
                                            @endif
                                        </div>

                                        <div class="button-wrapp pt-15 d-flex flex-nowrap gap-2 ms-1">
                                            <a href="{{ route('frontend.audios.show', $audio->slug ?? $audio->id) }}"
                                                class="th-btn style1 th-btn1"
                                                aria-label="تشغيل {{ e($audio->title) }}">
                                                <span class="btn-text" data-back=" تشغيل" data-front=" تشغيل"></span>
                                                <i class="fa-solid fa-play me-1"></i>
                                            </a>

                                            @if ($downloadUrl)
                                                @if ($isExternal)
                                                    <a href="{{ $downloadUrl }}" target="_blank"
                                                        rel="noopener noreferrer" class="th-btn style2 th-btn1"
                                                        aria-label="فتح/تحميل {{ e($audio->title) }}">
                                                        <span class="btn-text" data-back=" تحميل"
                                                            data-front=" تحميل"></span>
                                                        <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ $downloadUrl }}" class="th-btn style2 th-btn1"
                                                        download aria-label="تحميل {{ e($audio->title) }}">
                                                        <span class="btn-text" data-back=" تحميل"
                                                            data-front=" تحميل"></span>
                                                        <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-3">
                                        <em>لا توجد صوتيات في هذا التصنيف حالياً.</em>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="col-xxl-5 col-lg-5">
                <aside class="sidebar-area ">
                    <div class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                        <h3 class="widget_title mb-0 wow fadeInRight" data-wow-delay=".3s">الدرر السنية</h3>

                        <div class="btn-group">
                            <a href="{{ route('frontend.durars.index') }}" class="th-btn style1">
                                <span class="btn-text" data-back=" المزيد" data-front=" المزيد"></span>
                            </a>
                        </div>
                    </div>


                    <div class="widget widget_categories fadeInUp wow mb-0 new_efect" data-wow-delay=".4s">
                        <ul class="styled-list">
                            @if (!empty($durars) && $durars->count())
                                @foreach ($durars as $d)
                                    <li class="wow fadeInRight" data-wow-delay=".{{ $loop->index + 1 }}s">
                                        <a href="{{ route('frontend.durars.show', $d->slug) }}">
                                            {{ e(\Illuminate\Support\Str::limit($d->title, 80)) }}
                                            <i class="fa-solid fa-arrow-left float-start"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-muted">لا توجدش درر لعرضها حالياً.</li>
                            @endif
                        </ul>
                    </div>

                </aside>
            </div>
        </div>
    </section>
@endif

<style>
    @media (max-width: 991px) {
        .sidebar-area {
            padding-top: 80px;
        }

        .widget_title_new {
            margin-top: 30px;
        }
    }
</style>
