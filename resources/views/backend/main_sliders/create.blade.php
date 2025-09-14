@extends('layouts.admin')

@section('content')

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    إضافة سلايدر جديد
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

            <form action="{{ route('admin.main_sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf

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
                            <div class="col-md-2">
                                <label for="title">العنوان</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="subtitle">العنوان الفرعي</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                                    class="form-control">
                                @error('subtitle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="description">الوصف</label>
                            </div>
                            <div class="col-md-10">
                                <textarea id="tinymceExample" name="description" rows="7" class="form-control">{!! old('description') !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label>صورة (أفضل قياس 350x250)</label>
                            </div>
                            <div class="col-md-10">
                                <!-- حقل ملف واحد باسم img -->
                                <input type="file" name="img" id="img" class="form-control" accept="image/*" />
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade p-3" id="url" role="tabpanel" aria-labelledby="url-tab">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="btn_title">نص زر التصفح</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="btn_title" id="btn_title" value="{{ old('btn_title') }}"
                                    class="form-control">
                                @error('btn_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="url">الرابط</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="url" id="url" value="{{ old('url') }}"
                                    class="form-control" placeholder="https://example.com">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>هدف الرابط</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="target" value="_self" id="target_self"
                                        class="form-check-input" {{ old('target', '_self') == '_self' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="target_self">في نفس التبويب</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="target" value="_blank" id="target_blank"
                                        class="form-check-input" {{ old('target') == '_blank' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="target_blank">في تبويب جديد</label>
                                </div>
                                @error('target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>إظهار زر التصفح</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="show_btn_title" value="1" id="show_btn_yes"
                                        class="form-check-input" {{ old('show_btn_title', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_btn_yes">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="show_btn_title" value="0" id="show_btn_no"
                                        class="form-check-input" {{ old('show_btn_title') == '0' ? 'checked' : '' }}>
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
                                <div class="col-md-3">
                                    <label>تاريخ النشر</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group flatpickr" id="flatpickr-datetime">
                                        <!-- data-input مطلوب عند wrap: true -->
                                        <input type="text" name="published_on" value="{{ old('published_on') }}"
                                            class="form-control" placeholder="Y/m/d h:i AM/PM" data-input>
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3"><label>الحالة</label></div>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" value="1" id="status_active"
                                            class="form-check-input" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active">مفعل</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" value="0" id="status_inactive"
                                            class="form-check-input" {{ old('status') == '0' ? 'checked' : '' }}>
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
                                <div class="col-md-3"><label>إظهار معلومات السلايدر</label></div>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="show_info" value="1" id="show_info_yes"
                                            class="form-check-input" {{ old('show_info', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_info_yes">نعم</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="show_info" value="0" id="show_info_no"
                                            class="form-check-input" {{ old('show_info') == '0' ? 'checked' : '' }}>
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
                                    value="{{ old('metadata_title') }}" class="form-control">
                                @error('metadata_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><label for="metadata_description">وصف SEO</label></div>
                            <div class="col-md-9">
                                <input type="text" name="metadata_description" id="metadata_description"
                                    value="{{ old('metadata_description') }}" class="form-control">
                                @error('metadata_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><label for="metadata_keywords">الكلمات المفتاحية</label></div>
                            <div class="col-md-9">
                                <input type="text" name="metadata_keywords" id="metadata_keywords"
                                    value="{{ old('metadata_keywords') }}" class="form-control">
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
                        <button type="submit" class="btn btn-primary">
                            حفظ
                        </button>
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
            // fileinput (حقل واحد)
            if ($('#img').length) {
                try {
                    $("#img").fileinput({
                        theme: "fa5",
                        maxFileCount: 1,
                        allowedFileTypes: ['image'],
                        showCancel: true,
                        showRemove: false,
                        showUpload: false,
                        overwriteInitial: true,
                    });
                } catch (e) {
                    console.warn('fileinput plugin not loaded, using native file input.');
                }
            }
        });

        $(function() {
            if ($('#flatpickr-datetime').length) {
                // استخدم القيمة القديمة إن وُجدت وإلا التوقيت الحالي
                const oldVal = {!! json_encode(old('published_on') ?: null) !!};
                const defaultDate = oldVal ? oldVal : new Date();

                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    // التنسيق الذي يُرسَل للسيرفر (آمن للـ prepareInput)
                    dateFormat: "Y-m-d H:i",
                    // عرض ودّي للمستخدم
                    altInput: true,
                    altFormat: "Y/m/d h:i K",
                    defaultDate: defaultDate,
                });
            }
        });
    </script>
@endsection
