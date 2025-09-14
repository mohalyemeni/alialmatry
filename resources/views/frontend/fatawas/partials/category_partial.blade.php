<div class="list-group-item d-flex justify-content-between align-items-start py-3">
    <div class="me-3" style="flex:1;">
        <h5 class="mb-1">
            <i class="fa fa-gavel me-2 text-primary"></i>
            <a href="{{ route('frontend.fatawas.show', $fatawa->slug) }}">{{ e($fatawa->title) }}</a>
        </h5>

        @if (!empty($fatawa->excerpt ?? '') || !empty($fatawa->description ?? ''))
            <p class="mb-1 text-muted small">
                {{ e(\Illuminate\Support\Str::limit(strip_tags($fatawa->excerpt ?? ($fatawa->description ?? '')), 120)) }}
            </p>
        @endif
    </div>

    <div class="button-wrapp d-flex align-items-center">
        <a href="{{ route('frontend.fatawas.show', $fatawa->slug) }}" class="th-btn style1 th-btn1">
            <span class="btn-text" data-back=" مشاهدة" data-front=" مشاهدة"></span>
            <i class="fa-solid fa-eye me-1"></i>
        </a>
    </div>
</div>
