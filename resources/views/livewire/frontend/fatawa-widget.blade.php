<div>
    @if ($debug)
    @endif

    <div class="pt-80 overflow-hidden space-extra-bottom" id="faq-sec" wire:init>
        <div class="container">
            <div class="row flex-row-reverse">



                <!-- قسم تصنيفات الفتاوى -->
                <div class="col-xxl-4 col-lg-4">
                    <aside class="sidebar-area">
                        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow">تصنيفات الفتاوى</h3>

                        <div class="widget widget_categories fadeInUp wow mb-0 new_efect" data-wow-delay=".4s">
                            <ul class="styled-list">
                                @if (!empty($categories) && count($categories))
                                    <li class="wow fadeInRight" data-wow-delay=".1s">
                                        <a href="#" wire:click.prevent="selectCategory(null)"
                                            class="{{ $selectedCategoryId === null ? 'fw-bold text-primary' : '' }}">
                                            كل الفتاوى
                                            <i class="fa-solid fa-arrow-left float-start"></i>
                                        </a>
                                    </li>

                                    @foreach ($categories as $c)
                                        <li class="wow fadeInRight {{ $selectedCategoryId === $c->id ? 'active' : '' }}"
                                            data-wow-delay=".{{ $loop->index + 1 }}s"
                                            wire:key="cat-{{ $c->id }}">
                                            <a href="#"
                                                wire:click.prevent="selectCategoryById({{ $c->id }})"
                                                class="d-block text-end text-decoration-none {{ $selectedCategoryId === $c->id ? 'fw-bold text-primary' : '' }}">
                                                {{ e(\Illuminate\Support\Str::limit($c->name ?? ($c->title ?? $c->slug), 80)) }}
                                                <i class="fa-solid fa-arrow-left float-start"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-muted">لا توجد تصنيفات لعرضها حالياً.</li>
                                @endif
                            </ul>
                        </div>

                        <!-- يظل هذا كما هو -->
                        <div class="d-flex justify-content-end align-items-center mt-4 px-1 fadeInLeft wow">
                            <a href="{{ route('frontend.fatawas.index') }}" class="th-btn new_pad">
                                قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                    </aside>
                </div>
                <!-- قسم الفتاوى -->
                <div class="col-xxl-8 col-lg-8">
                    <div class="accordion-area style2 load-more-active accordion" id="faqAccordion">
                        <!-- عنوان الفتاوى + زر تصفح المزيد -->
                        <div
                            class="section-head d-flex align-items-center justify-content-between mb-5 title-header-line">
                            <h3 class="widget_title mb-0 fadeInRight wow">الفتاوى</h3>

                            <div class="btn-group">
                                <a href="{{ route('frontend.fatawas.index') }}" class="th-btn style1">
                                    <span class="btn-text" data-back="تصفح المزيد" data-front="تصفح المزيد"></span>
                                </a>
                            </div>
                        </div>

                        @php
                            $displayFatawas =
                                $fatawas instanceof \Illuminate\Support\Collection
                                    ? $fatawas->take(5)
                                    : collect($fatawas)->take(5);
                        @endphp

                        @if ($displayFatawas->isNotEmpty())
                            @foreach ($displayFatawas as $index => $faq)
                                <div class="accordion-card style2 {{ $index === 0 ? 'active' : '' }} fadeInUp wow"
                                    data-wow-delay="{{ 0.2 + $index * 0.1 }}s" wire:key="faq-{{ $faq->id }}">
                                    <div class="accordion-header" id="collapse-item-{{ $index + 1 }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $index + 1 }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse-{{ $index + 1 }}">
                                            <span>{{ $index + 1 }}.</span> {{ e($faq->title) }}
                                        </button>
                                    </div>

                                    <div id="collapse-{{ $index + 1 }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="collapse-item-{{ $index + 1 }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="faq-text">{{ e($faq->excerpt) }}</p>
                                            <div class="d-flex mt-2 fadeInRight wow">
                                                <a href="{{ route('frontend.fatawas.show', $faq->slug) }}"
                                                    class="th-btn new_pad me-auto">
                                                    قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">لا توجد فتاوى حالياً.</p>
                        @endif

                        <!-- عدد الفتاوى فقط (بدون الزر الآن) -->
                        <div class="d-flex justify-content-start align-items-center mt-3 px-1">
                            <div class="fw-bold flex_mine fadeInUp wow">
                                <p class="tags text-muted mb-0">عدد الفتاوى</p>
                                <span class="num_fata count_span">
                                    {{ isset($fatawasCount)
                                        ? $fatawasCount
                                        : (is_array($fatawas)
                                            ? count($fatawas)
                                            : ($fatawas instanceof \Illuminate\Support\Collection
                                                ? $fatawas->count()
                                                : 0)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
