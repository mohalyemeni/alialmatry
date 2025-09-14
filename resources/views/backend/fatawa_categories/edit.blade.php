@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_fatawa_category') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /
                    </li>
                    <li class="ms-1">
                        <a href="{{ route('admin.fatawa_categories.index') }}">{{ __('panel.manage_fatawa_categories') }}</a>
                        /
                    </li>
                    <li class="ms-1">{{ $category->title }}</li>
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
            <form action="{{ route('admin.fatawa_categories.update', $category->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            {{ __('panel.content') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false">
                            {{ __('panel.seo') }}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="title">{{ __('panel.title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $category->title) }}" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="description">{{ __('panel.content') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10" class="form-control summernote">{!! old('description', $category->description) !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="img">
                                    {{ __('panel.image') }}<br>
                                    <small>{{ __('panel.best_size') }}</small>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="img" id="img" class="file-input-overview">
                                </div>
                                @error('img')
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
                                    <input type="text" name="published_on"
                                        value="{{ old('published_on', optional($category->published_on)->format('Y-m-d H:i')) }}"
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

                        <!-- status -->
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">{{ __('panel.status') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', $category->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status', $category->status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ __('panel.inactive') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- featured   -->
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="featured">{{ __('panel.featured') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="hidden" name="featured" value="0">
                                <div class="form-check form-check-inline ms-4">
                                    <input type="checkbox" class="form-check-input" name="featured" id="featured"
                                        value="1" {{ old('featured', $category->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="featured">{{ __('panel.featured') ?? 'مميز' }}</label>
                                </div>

                                @error('featured')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="metadata_title">{{ __('panel.seo_title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="metadata_title" id="metadata_title"
                                    value="{{ old('metadata_title', $category->metadata_title) }}" class="form-control">
                                @error('metadata_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="metadata_description">{{ __('panel.seo_description') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="metadata_description" id="metadata_description"
                                    value="{{ old('metadata_description', $category->metadata_description) }}"
                                    class="form-control">
                                @error('metadata_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="metadata_keywords">{{ __('panel.seo_keywords') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input name="metadata_keywords" id="tags1"
                                    value="{{ old('metadata_keywords', $category->metadata_keywords) }}"
                                    class="form-control" />
                                @error('metadata_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                            <a href="{{ route('admin.fatawa_categories.index') }}" class="btn btn-outline-danger">
                                <i class="icon-lg me-2" data-feather="x"></i>
                                {{ __('panel.cancel') }}
                            </a>
                        </div>
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
                maxFileCount: 1,
                initialPreview: [
                    @if ($category->img)
                        "{{ asset('assets/fatawa_categories/' . $category->img) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($category->img)
                        {
                            caption: "{{ basename($category->img) }}",
                            url: "{{ route('admin.fatawa_categories.remove_image') }}",
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
@endsection
