@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_fatwa') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a href="{{ route('admin.fatawa.index') }}">{{ __('panel.manage_fatawa') }}</a></li>
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
            <form action="{{ route('admin.fatawa.store') }}" method="POST" enctype="multipart/form-data">
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
                        <!-- اختيار التصنيف -->
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="category_id">{{ __('panel.category') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">{{ __('panel.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- عنوان الفتوى -->
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
                        <!-- وصف الفتوى -->
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
                        <!-- صورة الفتوى -->
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
                                <label for="audio_file">{{ __('panel.audio_file') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="file" name="audio_file" id="audio_file" class="form-control"
                                    accept="audio/*">
                                @error('audio_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">{{ __('panel.optional_audio_file') }}</small>
                            </div>
                        </div>
                        <!-- تاريخ النشر -->
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
                        <!-- الحالة -->
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
                                <label for="metadata_title">{{ __('panel.seo_title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="metadata_title" id="metadata_title"
                                    value="{{ old('metadata_title') }}" class="form-control">
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
                                    value="{{ old('metadata_description') }}" class="form-control">
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
                                <input name="metadata_keywords" id="tags1" value="{{ old('metadata_keywords') }}"
                                    class="form-control" />
                                @error('metadata_keywords')
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
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i> {{ __('panel.save') }}
                        </button>
                        <a href="{{ route('admin.fatawa.index') }}" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> {{ __('panel.cancel') }}
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
@endsection
