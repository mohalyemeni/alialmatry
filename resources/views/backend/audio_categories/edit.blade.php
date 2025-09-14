@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_audio_category') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /
                    </li>
                    <li class="ms-1">
                        <a href="{{ route('admin.audio_categories.index') }}">{{ __('panel.manage_audio_categories') }}</a> /
                    </li>
                    <li class="ms-1">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.audio_categories.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-tabs mb-4" id="editTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            {{ __('panel.content') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false">
                            {{ __('panel.seo') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="editTabContent">

                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label">{{ __('panel.title') }}</label>
                            <div class="col-md-10">
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $category->title) }}">
                                @error('title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">{{ __('panel.content') }}</label>
                            <div class="col-md-10">
                                <textarea id="description" name="description" class="form-control summernote" rows="6">{!! old('description', $category->description) !!}</textarea>
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="img" class="col-md-2 col-form-label">
                                {{ __('panel.image') }}<br><small>{{ __('panel.best_size') }}</small>
                            </label>
                            <div class="col-md-10">
                                <input type="file" id="img" name="img"
                                    class="form-control-file file-input-overview">
                                @error('img')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="published_on"
                                class="col-md-2 col-form-label">{{ __('panel.publish_date') }}</label>
                            <div class="col-md-10">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" id="published_on" name="published_on" class="form-control"
                                        placeholder="{{ __('panel.publish_date') }}" data-input
                                        value="{{ old('published_on', optional($category->published_on)->format('Y-m-d H:i')) }}">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('published_on')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">{{ __('panel.status') }}</label>
                            <div class="col-md-10 d-flex align-items-center gap-3 flex-wrap">
                                <div class="form-check form-check-inline me-3">
                                    <input type="radio" id="status_active" name="status" value="1"
                                        class="form-check-input"
                                        {{ old('status', (string) $category->status) == '1' ? 'checked' : '' }}>
                                    <label for="status_active" class="form-check-label">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline me-3">
                                    <input type="radio" id="status_inactive" name="status" value="0"
                                        class="form-check-input"
                                        {{ old('status', (string) $category->status) == '0' ? 'checked' : '' }}>
                                    <label for="status_inactive"
                                        class="form-check-label">{{ __('panel.inactive') }}</label>
                                </div>
                                @error('status')
                                    <div class="text-danger small d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Featured (star style like the other file) --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label"
                                for="featured">{{ __('panel.featured') ?? 'مميز' }}</label>
                            <div class="col-md-10">
                                {{-- نستخدم hidden input + زر نجمة لتطابق الشكل --}}
                                <input type="hidden" name="featured" id="featured_input"
                                    value="{{ old('featured', $category->featured) ? 1 : 0 }}">
                                <button type="button" id="featured_btn" class="btn btn-light p-2"
                                    aria-pressed="{{ old('featured', $category->featured) ? 'true' : 'false' }}">
                                    <i id="featured_icon"
                                        class="{{ old('featured', $category->featured) ? 'fas fa-star text-warning' : 'far fa-star text-muted' }}"
                                        style="font-size:1.6em;"></i>
                                </button>
                                @error('featured')
                                    <div class="text-danger small d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="mb-3 row">
                            <label for="meta_slug" class="col-md-3 col-form-label">{{ __('panel.seo_slug') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="meta_slug" name="meta_slug" class="form-control"
                                    value="{{ old('meta_slug', $category->meta_slug) }}">
                                @error('meta_slug')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="meta_description"
                                class="col-md-3 col-form-label">{{ __('panel.seo_description') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="meta_description" name="meta_description" class="form-control"
                                    value="{{ old('meta_description', $category->meta_description) }}">
                                @error('meta_description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="meta_keywords"
                                class="col-md-3 col-form-label">{{ __('panel.seo_keywords') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="meta_keywords" name="meta_keywords" class="form-control"
                                    value="{{ old('meta_keywords', $category->meta_keywords) }}">
                                @error('meta_keywords')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i>
                            {{ __('panel.save_changes') }}
                        </button>
                        <a href="{{ route('admin.audio_categories.index') }}" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i>
                            {{ __('panel.cancel') }}
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/vendors/select2/select2.min.js') }}"></script>

    <script>
        $(function() {
            $("#img").fileinput({
                theme: "fa5",
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                maxFileCount: 1,
                initialPreview: [
                    @if ($category->img)
                        "{{ asset('assets/audio_categories/' . $category->img) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($category->img)
                        {
                            caption: "{{ basename($category->img) }}",
                            url: "{{ route('admin.audio_categories.remove_image') }}",
                            key: "{{ $category->id }}",
                            extra: {
                                _token: "{{ csrf_token() }}",
                                key: "{{ $category->id }}"
                            }
                        }
                    @endif
                ],
                fileActionSettings: {
                    showZoom: true,
                    showRemove: true,
                    zoomIcon: '<i class="fas fa-search-plus"></i>',
                    removeIcon: '<i class="fas fa-trash"></i>',
                }
            });
        });
    </script>

    <script>
        $(function() {
            'use strict';
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate =
                    "{{ old('published_on', optional($category->published_on)->format('Y-m-d H:i')) }}" ?
                    "{{ old('published_on', optional($category->published_on)->format('Y-m-d H:i')) }}" :
                    new Date();
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

    <script>
        $(function() {
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
        });
    </script>

    {{-- Featured toggle script (same behavior as create page) --}}
    <script>
        $(function() {
            $('#featured_btn').on('click', function() {
                var $input = $('#featured_input');
                var $icon = $('#featured_icon');
                var is = $input.val() === '1' || $input.val() === 1 || $input.val() === 'true';
                if (is) {
                    $input.val('0');
                    $icon.removeClass('fas text-warning').addClass('far text-muted');
                    $(this).attr('aria-pressed', 'false');
                } else {
                    $input.val('1');
                    $icon.removeClass('far text-muted').addClass('fas text-warning');
                    $(this).attr('aria-pressed', 'true');
                }
            });
        });
    </script>
@endsection
