 <div class="accordion-area style2 load-more-active accordion" id="faqAccordion">
     <h3 class="widget_title title-header-noline mb-5 fadeInRight wow" data-wow-delay=".3s">الفتاوى</h3>

     @if (isset($fatawas) && $fatawas->count())
         @foreach ($fatawas as $index => $faq)
             <div class="accordion-card style2 {{ $index === 0 ? 'active' : '' }} fadeInUp wow"
                 data-wow-delay="{{ 0.2 + $index * 0.1 }}s">
                 <div class="accordion-header" id="collapse-item-{{ $index + 1 }}">
                     <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                         data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index + 1 }}"
                         aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                         aria-controls="collapse-{{ $index + 1 }}">
                         <span>{{ $index + 1 }}.</span> {{ e($faq->title) }}
                     </button>
                 </div>

                 <div id="collapse-{{ $index + 1 }}"
                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                     aria-labelledby="collapse-item-{{ $index + 1 }}" data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                         <p class="faq-text">{{ e($faq->excerpt ?? ($faq->description ?? '')) }}</p>
                         <div class="d-flex mt-2 fadeInRight wow" data-wow-delay=".5s">
                             <a href="{{ route('frontend.fatawas.show', $faq->slug) }}" class="th-btn new_pad me-auto">
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
         <div class="fw-bold flex_mine fadeInUp wow" data-wow-delay=".6s">
             <p class="tags text-muted">عدد الفتاوى</p>
             <span class="num_fata count_span">
                 {{ isset($fatawasCount) ? $fatawasCount : (is_countable($fatawas) ? count($fatawas) : 0) }}
             </span>
         </div>
         <a href="{{ route('frontend.fatawas.index') }}" class="th-btn new_pad fadeInRight wow" data-wow-delay=".7s">
             قراءة المزيد <i class="fa-solid fa-arrow-left ms-1"></i>
         </a>
     </div>
 </div>
