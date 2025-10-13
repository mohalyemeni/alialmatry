@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_book') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a href="{{ route('admin.books.index') }}">{{ __('panel.manage_books') }}</a></li>
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

            <form id="bookForm" action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false">{{ __('panel.seo') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="title">{{ __('panel.title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="description">{{ __('panel.description') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10"
                                    class="form-control summernote @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="img">{{ __('panel.image') }}
                                    <br><small>{{ __('panel.best_size') }}</small></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="img" id="img" class="file-input-overview"
                                        accept="image/*">
                                </div>
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="file">{{ __('panel.book_file') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="file" name="file" id="file" class="form-control">
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                {{ __('panel.publish_date') }}
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on" value="{{ old('published_on') }}"
                                        class="form-control" placeholder="{{ __('panel.publish_date') }}" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">{{ __('panel.status') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="status_inactive">{{ __('panel.inactive') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_slug">{{ __('panel.seo_slug') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug" value="{{ old('meta_slug') }}"
                                    class="form-control">
                                @error('meta_slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_description">{{ __('panel.seo_description') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_description" id="meta_description"
                                    value="{{ old('meta_description') }}" class="form-control">
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_keywords">{{ __('panel.seo_keywords') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input name="meta_keywords" id="tags1" value="{{ old('meta_keywords') }}"
                                    class="form-control" />
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i>
                            <span id="uploadBtnText">{{ __('panel.save') }}</span>
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> {{ __('panel.cancel') }}
                        </a>

                        {{-- status + progress partial --}}
                        <div id="uploadStatus" class="mt-2" aria-live="polite"></div>
                    </div>
                </div>

                <div class="modern-progress-wrapper" id="globalProgressWrapper" style="height:28px; display:none;">
                    <div id="uploadProgress" class="modern-progress-bar" style="width:0%;">
                        <span class="modern-progress-label" id="uploadProgressLabel">0%</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/vendors/select2/select2.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#tinymceExample',
            plugins: 'advlist autolink lists link image charmap preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            height: 300,
        });
    </script>

    <script>
        $(function() {
            $("#img").fileinput({
                theme: "fa5",
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                maxFileCount: 1
            });
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            if ($('#tags1').length && typeof $.fn.tagsInput === 'function') {
                $('#tags1').tagsInput({
                    'defaultText': 'أضف كلمة مفتاحية',
                    'height': 'auto',
                    'width': '100%',
                    'interactive': true,
                    'removeWithBackspace': true,
                    'delimiter': ',',
                    'minChars': 1,
                    'maxChars': 50
                });
            }
        });
    </script>

    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "{{ old('published_on') }}" ? "{{ old('published_on') }}" : new Date();
                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "Y/m/d h:i K",
                    locale: locale,
                    defaultDate: defaultDate,
                });
            }
        });
    </script>

    {{-- Upload form AJAX with progress (reused from audio page) --}}
    <script>
        $(document).ready(function() {

            const $form = $('#bookForm');
            const $btn = $('#uploadBtn');
            const $btnText = $('#uploadBtnText');
            const $progressWrapper = $('#globalProgressWrapper');
            const $progress = $('#uploadProgress');
            const $progressLabel = $('#uploadProgressLabel');
            const $status = $('#uploadStatus');

            function clearAjaxFieldErrors() {
                $('.ajax-error').remove();
                $('.is-invalid.ajax-field').removeClass('ajax-field');
            }

            function resetUploadUI() {
                $progressWrapper.hide();
                $progress.css('width', '0%');
                $progressLabel.text('0%');
                $progress.removeClass('bg-success bg-danger').addClass('progress-bar-animated bg-primary');
                $status.html('');
                $btn.prop('disabled', false);
                $btnText.text("{{ __('panel.save') }}");
                clearAjaxFieldErrors();
            }

            resetUploadUI();

            $form.on('submit', function(e) {
                e.preventDefault();

                // clear previous ajax errors
                clearAjaxFieldErrors();

                let formData = new FormData(this);

                $progressWrapper.show();
                $progress.css('width', '0%');
                $progressLabel.text('0%');
                $progress.removeClass('bg-success bg-danger').addClass('progress-bar-animated bg-primary');
                $status.html('');
                $btn.prop('disabled', true);
                $btnText.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> جاري الحفظ...'
                );

                $.ajax({
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        let maxPercent = 0;
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                let percent = Math.round((evt.loaded / evt.total) *
                                100);
                                if (percent > maxPercent) {
                                    maxPercent = percent;
                                    $progress.css('width', percent + '%');
                                    $progressLabel.text(percent + '%');
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        // success UI
                        $progress.removeClass('progress-bar-animated bg-primary').addClass(
                            'bg-success');
                        $status.html(
                                '<i class="fa fa-check-circle me-1"></i> تم حفظ الكتاب بنجاح')
                            .removeClass('text-danger').addClass('text-success');

                        // redirect to index if available or provided by backend
                        const redirectUrl = res.redirect || "{{ route('admin.books.index') }}";
                        setTimeout(function() {
                            window.location.href = redirectUrl;
                        }, 1300);
                    },
                    error: function(xhr) {
                        // show validation errors (422) or generic error
                        $progress.removeClass('progress-bar-animated bg-primary').addClass(
                            'bg-danger');

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            let messages = [];
                            for (const field in errors) {
                                if (!errors.hasOwnProperty(field)) continue;
                                const msgArr = errors[field];
                                const msg = msgArr.join('<br>');
                                messages.push(msg);

                                // try to show under the input
                                const $input = $form.find('[name="' + field + '"]');
                                if ($input.length) {
                                    // mark input and append error text
                                    $input.addClass('is-invalid ajax-field');
                                    $input.after(
                                        '<span class="text-danger ajax-error d-block small mt-1">' +
                                        msg + '</span>');
                                } else {
                                    // sometimes fields like tags (meta_keywords) may not match; skip
                                }
                            }
                            $status.html('<div class="alert alert-danger p-2 m-0">' + messages
                                .join('<br>') + '</div>');
                        } else {
                            $status.html(
                                '<i class="fa fa-times-circle me-1"></i> حدث خطأ أثناء الحفظ. يرجى المحاولة مجددًا'
                                ).removeClass('text-success').addClass('text-danger');
                        }

                        setTimeout(function() {
                            $btn.prop('disabled', false);
                            $btnText.text("{{ __('panel.save') }}");
                            $progress.removeClass('bg-danger').addClass(
                                'progress-bar-animated bg-primary');
                        }, 1500);
                    }
                });
            });
        });
    </script>
@endsection
