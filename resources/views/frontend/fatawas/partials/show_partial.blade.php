    <div class="sermon-details   overflow-hidden">
        <div class="page-single">
            <div class="sermon-top-wrapp">
                <h3 class="box-title mb-5">{{ $fatawa->title }}</h3>
            </div>

            <div class="audio-play-wrapp">
                @if ($fatawa->audio_file)
                    <audio controls="" class="w-100 mt-1">
                        <source src="{{ asset('assets/fatawa/files/' . $fatawa->audio_file) }}" type="audio/mpeg">
                        متصفحك لا يدعم مشغل الصوت.
                    </audio>
                @else
                    <div class="alert alert-secondary">لا يوجد ملف صوتي متاح لهذه الفتوى.</div>
                @endif

                <div class="audio-play-wrapp">
                    <div class="button-wrapp">
                        @if (!empty($fatawa->pdf_link))
                            <a href="{{ $fatawa->pdf_link }}" target="_blank" class="th-btn style3">PDF<i
                                    class="fa-regular fa-file-pdf ms-2"></i></a>
                        @endif
                        @if (!empty($fatawa->doc_link))
                            <a href="{{ $fatawa->doc_link }}" target="_blank" class="th-btn style3">Documents<i
                                    class="fa-solid fa-file ms-2"></i></a>
                        @endif
                        @if ($fatawa->audio_file)
                            <a href="{{ route('frontend.fatawas.download', $fatawa->id) }}"
                                class="th-btn style2 th-btn1">
                                <span class="btn-text" data-back=" تحميل" data-front=" تحميل"></span>
                                <i class="fa-regular fa-arrow-down-to-line ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="sermon-text mt-4">
                {!! $fatawa->description !!}
            </div>
        </div>
    </div>
