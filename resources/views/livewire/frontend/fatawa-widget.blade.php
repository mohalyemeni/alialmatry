<div>
    @if ($debug)
    @endif

    <div class="pt-80 overflow-hidden space-extra-bottom" id="faq-sec" wire:init>
        <div class="container">
            <div class="row flex-row-reverse">

                <div class="col-xxl-8 col-lg-8">
                    <div class="accordion-area style2 load-more-active accordion" id="faqAccordion">
                        <h3 class="widget_title title-header-noline mb-5 fadeInRight wow">الفتاوى</h3>

                        @if (!empty($fatawas) && count($fatawas))
                            @foreach ($fatawas as $index => $faq)
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

                        <div class="d-flex justify-content-between align-items-center mt-3 px-1">
                            <div class="fw-bold flex_mine fadeInUp wow">
                                <p class="tags text-muted">عدد الفتاوى</p>
                                <span class="num_fata count_span">{{ isset($fatawas) ? count($fatawas) : 0 }}</span>
                            </div>
                            <a href="{{ route('frontend.fatawas.index') }}" class="th-btn new_pad fadeInRight wow">
                                قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

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

                        <div class="d-flex justify-content-end align-items-center mt-4 px-1 fadeInLeft wow">
                            <a href="{{ route('frontend.fatawas.index') }}" class="th-btn new_pad">
                                قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
            });

            window.addEventListener('fatawa-debug', function(e) {
                console.log("FATAWA DEBUG:", e.detail);
                if (Array.isArray(e.detail.messages)) {
                    const debugOutput = document.getElementById('debug-output');
                    if (debugOutput) {
                        let html = '';
                        e.detail.messages.forEach(m => {
                            html += '<div style="border-bottom: 1px solid #333; padding: 5px 0;">' +
                                m + '</div>';
                        });
                        debugOutput.innerHTML = html;
                        debugOutput.scrollTop = debugOutput.scrollHeight;
                    }

                    // أيضًا طباعة في console للمطورين
                    e.detail.messages.forEach(m => console.log(m));
                }
            });
        });

        Livewire.on('fatawasLoaded', () => {
            console.log('fatawas updated via Livewire');
        });
    </script>

</div>
