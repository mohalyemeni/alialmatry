@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_video') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a href="{{ route('admin.videos.index') }}">{{ __('panel.manage_videos') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger pt-0 pb-0 mb-3">
                    <ul class="px-2 py-3 m-0" style="list-style-type: circle">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="step1" class="mb-4">
                <div class="row">
                    <div class="col-sm-12 col-md-2 pt-2">
                        <label for="initial_category">{{ __('panel.category') }}</label>
                    </div>
                    <div class="col-sm-12 col-md-6 pt-2">
                        <select id="initial_category" class="form-select">
                            <option value="">{{ __('panel.select_category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-4 pt-2 text-end">
                        @ability('admin', 'create_videos')
                            <a href="{{ route('admin.videos.create') }}" class="btn btn-outline-secondary">
                                {{ __('panel.reset') }}
                            </a>
                        @endability
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-2 pt-2">
                        <label for="youtube_url">{{ __('panel.youtube_url') }}</label>
                    </div>
                    <div class="col-sm-12 col-md-8 pt-2">
                        <input type="text" id="youtube_url" class="form-control"
                            placeholder="https://www.youtube.com/watch?v=..." />
                        <small class="text-muted">أدخل رابط الفيديو ثم اضغط "جلب البيانات".</small>
                    </div>
                    <div class="col-sm-12 col-md-2 pt-2">
                        <button id="fetchBtn" class="btn btn-primary w-100" type="button">
                            <span id="fetchBtnText">{{ __('panel.fetch_data') ?? 'جلب البيانات' }}</span>
                        </button>
                    </div>
                </div>

                <div id="fetchAlert" class="mt-3"></div>
            </div>

            <form id="fullForm" action="{{ route('admin.videos.store') }}" method="POST" class="d-none">
                @csrf

                <input type="hidden" name="category_id" id="category_id_hidden" value="{{ old('category_id') }}">
                <input type="hidden" name="youtube_id" id="youtube_id" value="{{ old('youtube_id') }}">
                <input type="hidden" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}">

                <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false">{{ __('panel.seo') }}</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    {{-- Content tab --}}
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="title">{{ __('panel.title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label>{{ __('panel.category') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <input type="text" id="selected_category_display" class="form-control" readonly>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="video_url">{{ __('panel.youtube_url') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <input type="text" id="video_url" name="video_url" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="description">{{ __('panel.description') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <textarea name="description" id="description" rows="8" class="form-control summernote">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label>{{ __('panel.preview') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div id="video_embed_container" style="max-width: 100%;">

                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="published_on">{{ __('panel.publish_date') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on" value="{{ old('published_on') }}"
                                        class="form-control" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label class="control-label">{{ __('panel.status') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_active"
                                        value="1" checked>
                                    <label class="form-check-label" for="status_active">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                        value="0">
                                    <label class="form-check-label"
                                        for="status_inactive">{{ __('panel.inactive') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-3 pt-2">
                                <label for="meta_title">{{ __('panel.seo_title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-2">
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                                    class="form-control">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-3 pt-2">
                                <label for="meta_description">{{ __('panel.seo_description') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-2">
                                <input type="text" name="meta_description" id="meta_description"
                                    value="{{ old('meta_description') }}" class="form-control">
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-3 pt-2">
                                <label for="meta_keywords">{{ __('panel.seo_keywords') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-2">
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
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="save"></i> {{ __('panel.save') }}
                        </button>
                        <button id="backToStep1" type="button" class="btn btn-outline-secondary">
                            <i class="icon-lg me-2" data-feather="corner-up-left"></i> {{ __('panel.back') }}
                        </button>
                        <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> {{ __('panel.cancel') }}
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const $fetchBtn = $('#fetchBtn');
            const $youtubeUrl = $('#youtube_url');
            const $fetchAlert = $('#fetchAlert');
            const $step1 = $('#step1');
            const $fullForm = $('#fullForm');
            const $categoryHidden = $('#category_id_hidden');

            function showAlert(type, msg) {
                $fetchAlert.html(`<div class="alert alert-${type}">${msg}</div>`);
            }

            $fetchBtn.on('click', function() {
                const url = $youtubeUrl.val().trim();
                const selectedCategory = $('#initial_category').val();

                $fetchAlert.html('');
                if (!selectedCategory) {
                    showAlert('warning', 'اختر التصنيف أولاً.');
                    return;
                }
                if (!url) {
                    showAlert('warning', 'أدخل رابط اليوتيوب أولاً.');
                    return;
                }

                $fetchBtn.prop('disabled', true);
                $('#fetchBtnText').text('جاري الجلب...');

                $.post("{{ route('admin.videos.fetch_data') }}", {
                        url: url
                    })
                    .done(function(res) {
                        if (res.success) {
                            $('#title').val(res.title || '');
                            $('#description').val(res.title || '');
                            $('#thumbnail_preview').attr('src', res.thumbnail ||
                                '{{ asset('backend/images/placeholder.png') }}');
                            $('#thumbnail').val(res.thumbnail || '');
                            $('#youtube_id').val(res.youtube_id || '');


                            if (res.html) {
                                $('#video_embed_container').html('<div class="ratio ratio-16x9">' + res
                                    .html + '</div>');
                            } else if (res.youtube_id) {
                                const iframe = `<div class="ratio ratio-16x9">
                                                    <iframe src="https://www.youtube.com/embed/${res.youtube_id}"
                                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
                                                </div>`;
                                $('#video_embed_container').html(iframe);
                            } else {
                                $('#video_embed_container').html(
                                    '<p class="text-muted">{{ __('panel.no_preview_available') }}</p>'
                                );
                            }

                            $('#video_url').val(res.watch_url || '');
                            const selectedCategoryText = $('#initial_category option:selected').text();
                            $('#selected_category_display').val(selectedCategoryText);

                            $categoryHidden.val(selectedCategory);

                            $step1.addClass('d-none');
                            $fullForm.removeClass('d-none');

                            if (!$('.summernote').data('summernote')) {
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
                            }

                            $fetchAlert.html('');
                        } else {
                            showAlert('danger', res.message || 'فشل في جلب بيانات الفيديو');
                        }
                    })
                    .fail(function(xhr) {
                        let msg = 'فشل في الاتصال بالخادم';
                        if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON
                            .message;
                        showAlert('danger', msg);
                    })
                    .always(function() {
                        $fetchBtn.prop('disabled', false);
                        $('#fetchBtnText').text('{{ __('panel.fetch_data') ?? 'جلب البيانات' }}');
                    });
            });

            $('#backToStep1').on('click', function() {
                $fullForm.addClass('d-none');
                $step1.removeClass('d-none');
            });

            $('#youtube_id').on('input', function() {
                const id = $(this).val().trim();
                if (id) {
                    const thumb = 'https://img.youtube.com/vi/' + id + '/hqdefault.jpg';
                    $('#thumbnail_preview').attr('src', thumb);
                    $('#thumbnail').val(thumb);
                }
            });
        });
    </script>
    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const oldDate = "{{ old('published_on') }}";

                const defaultDate = oldDate ? oldDate : new Date();

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
@endsection
