<?php use Carbon\Carbon; ?>
@extends('layouts.admin')

@section('content')

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    تعديل السلايدر
                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="{{ route('admin.index') }}">الرئيسية</a>
                        \
                    </li>
                    <li class="ms-1">
                        <a href="{{ route('admin.main_sliders.index') }}">عرض السلايدر</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger pt-0 pb-0 mb-0">
                    <ul class="px-2 py-3 m-0" style="list-style-type: circle">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php

                $locale = 'ar';

                $get = function ($value) use ($locale) {
                    if (is_array($value)) {
                        return $value[$locale] ?? (reset($value) ?: null);
                    }
                    return $value;
                };

                $currTitle = old('title', $get($mainSlider->title));
                $currSubtitle = old('subtitle', $get($mainSlider->subtitle));
                $currDescription = old('description', $get($mainSlider->description));
                $currBtnTitle = old('btn_title', $get($mainSlider->btn_title));
                $currUrl = old('url', $get($mainSlider->url));
                $currMetadataTitle = old('metadata_title', $get($mainSlider->metadata_title));
                $currMetadataDescription = old('metadata_description', $get($mainSlider->metadata_description));
                $currMetadataKeywords = old('metadata_keywords', $get($mainSlider->metadata_keywords));

                $publishedValue = old(
                    'published_on',
                    $mainSlider->published_on ? Carbon::parse($mainSlider->published_on)->format('Y-m-d H:i') : null,
                );
            @endphp

            <form action="{{ route('admin.main_sliders.update', $mainSlider->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">المحتوى
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="url-tab" data-bs-toggle="tab" data-bs-target="#url" type="button"
                            role="tab" aria-controls="url" aria-selected="false">خيارات الزر
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false">SEO
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <!-- المحتوى -->
                    <div class="tab-pane fade show active p-3" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="row mb-3">
                            <div class="col-md-2"><label for="title">العنوان</label></div>
                            <div class="col-md-10">
                                <input type="text" name="title" id="title" value="{{ $currTitle }}"
                                    class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2"><label for="subtitle">العنوان الفرعي</label></div>
                            <div class="col-md-10">
                                <input type="text" name="subtitle" id="subtitle" value="{{ $currSubtitle }}"
                                    class="form-control">
                                @error('subtitle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2"><label for="description">الوصف</label></div>
                            <div class="col-md-10">
                                <textarea id="tinymceExample" name="description" rows="7" class="form-control">{!! $currDescription !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label>صورة/صور (أفضل قياس 350x250)</label>
                            </div>
                            <div class="col-md-10">
                                <input type="file" name="images[]" id="slider_images" class="file-input-overview"
                                    multiple>
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- خيارات الزر -->
                    <div class="tab-pane fade p-3" id="url" role="tabpanel" aria-labelledby="url-tab">
                        <div class="row mb-3">
                            <div class="col-md-3"><label for="btn_title">نص زر التصفح</label></div>
                            <div class="col-md-9">
                                <input type="text" name="btn_title" id="btn_title" value="{{ $currBtnTitle }}"
                                    class="form-control">
                                @error('btn_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><label for="url">الرابط</label></div>
                            <div class="col-md-9">
                                <input type="text" name="url" id="url" value="{{ $currUrl }}"
                                    class="form-control" placeholder="https://example.com">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">هدف الرابط</div>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="target" value="_self" id="target_self"
                                        class="form-check-input"
                                        {{ old('target', $mainSlider->target) == '_self' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="target_self">في نفس التبويب</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="target" value="_blank" id="target_blank"
                                        class="form-check-input"
                                        {{ old('target', $mainSlider->target) == '_blank' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="target_blank">في تبويب جديد</label>
                                </div>
                                @error('target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">إظهار زر التصفح</div>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="show_btn_title" value="1" id="show_btn_yes"
                                        class="form-check-input"
                                        {{ old('show_btn_title', $mainSlider->show_btn_title) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_btn_yes">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="show_btn_title" value="0" id="show_btn_no"
                                        class="form-check-input"
                                        {{ old('show_btn_title', $mainSlider->show_btn_title) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_btn_no">لا</label>
                                </div>
                                @error('show_btn_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <fieldset class="p-3 my-3" style="border: 1px solid #eee;">
                            <legend>خيارات النشر</legend>

                            <div class="row mb-3">
                                <div class="col-md-3">تاريخ النشر</div>
                                <div class="col-md-9">
                                    <div class="input-group flatpickr" id="flatpickr-datetime">
                                        <input type="text" name="published_on" class="form-control"
                                            placeholder="Y/m/d h:i AM/PM" data-input value="{{ $publishedValue }}">
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">الحالة</div>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" value="1" id="status_active"
                                            class="form-check-input"
                                            {{ old('status', $mainSlider->status) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active">مفعل</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" value="0" id="status_inactive"
                                            class="form-check-input"
                                            {{ old('status', $mainSlider->status) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_inactive">معطل</label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="p-3 my-3" style="border: 1px solid #eee;">
                            <legend>تفاصيل الشريحة</legend>
                            <div class="row mb-3">
                                <div class="col-md-3">إظهار معلومات السلايدر</div>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="show_info" value="1" id="show_info_yes"
                                            class="form-check-input"
                                            {{ old('show_info', $mainSlider->show_info) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_info_yes">نعم</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="show_info" value="0" id="show_info_no"
                                            class="form-check-input"
                                            {{ old('show_info', $mainSlider->show_info) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_info_no">لا</label>
                                    </div>
                                    @error('show_info')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <!-- SEO -->
                    <div class="tab-pane fade p-3" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row mb-3">
                            <div class="col-md-3"><label for="metadata_title">عنوان SEO</label></div>
                            <div class="col-md-9">
                                <input type="text" name="metadata_title" id="metadata_title"
                                    value="{{ $currMetadataTitle }}" class="form-control">
                                @error('metadata_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><label for="metadata_description">وصف SEO</label></div>
                            <div class="col-md-9">
                                <input type="text" name="metadata_description" id="metadata_description"
                                    value="{{ $currMetadataDescription }}" class="form-control">
                                @error('metadata_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><label for="metadata_keywords">الكلمات المفتاحية</label></div>
                            <div class="col-md-9">
                                <input type="text" name="metadata_keywords" id="metadata_keywords"
                                    value="{{ $currMetadataKeywords }}" class="form-control">
                                <small class="text-muted">افصل بين الكلمات بفاصلة</small>
                                @error('metadata_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-2 d-none d-md-block"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                        <a href="{{ route('admin.main_sliders.index') }}" class="btn btn-outline-danger">إلغاء</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function() {

            let initialPreview = [];
            let initialPreviewConfig = [];

            @if (method_exists($mainSlider, 'photos') && $mainSlider->photos()->count() > 0)
                @foreach ($mainSlider->photos as $media)
                    initialPreview.push("{{ asset('assets/main_sliders/' . $media->file_name) }}");
                    initialPreviewConfig.push({
                        caption: "{{ $media->file_name }}",
                        size: {{ $media->file_size ?? 0 }},
                        width: "120px",
                        url: "{{ route('admin.main_sliders.remove_image', ['image_id' => $media->id, 'slider_id' => $mainSlider->id, '_token' => csrf_token()]) }}",
                        key: {{ $media->id }}
                    });
                @endforeach
            @elseif (!empty($mainSlider->img))
                initialPreview.push("{{ asset('assets/main_sliders/' . $mainSlider->img) }}");
                initialPreviewConfig.push({
                    caption: "{{ $mainSlider->img }}",
                    size: 0,
                    width: "120px",
                    url: "{{ route('admin.main_sliders.remove_image') }}?slider_id={{ $mainSlider->id }}&_token={{ csrf_token() }}",
                    key: "current_img"
                });
            @endif

            try {
                $("#slider_images").fileinput({
                    theme: "fa5",
                    maxFileCount: 5,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: initialPreview,
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: initialPreviewConfig,
                }).on('filesorted', function(event, params) {
                    console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
                });
            } catch (e) {
                console.warn('fileinput plugin not loaded, using native file input.');
            }
        });


        $(function() {
            if ($('#flatpickr-datetime').length) {
                const oldVal = {!! json_encode(old('published_on') ?: null) !!};
                const serverVal = {!! json_encode($publishedValue) !!};
                const defaultDate = oldVal ? oldVal : (serverVal ? serverVal : new Date());

                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "Y/m/d h:i K",
                    defaultDate: defaultDate,
                });
            }
        });
    </script>
@endsection
