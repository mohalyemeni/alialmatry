@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_video_category') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /
                    </li>
                    <li class="ms-1">
                        <a href="{{ route('admin.video_categories.index') }}">{{ __('panel.manage_video_categories') }}</a>
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

            <form action="{{ route('admin.video_categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO" type="button"
                            role="tab" aria-controls="SEO" aria-selected="false">{{ __('panel.seo') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        {{-- Title --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="title">{{ __('panel.title') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="description">{{ __('panel.content') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10" class="form-control summernote">{!! old('description', '') !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="img">
                                    {{ __('panel.image') }}
                                    <br>
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

                        {{-- Publish Date --}}
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

                        {{-- Status --}}
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">{{ __('panel.status') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3 d-flex align-items-center gap-3">
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
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Featured (star-button style) --}}
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="featured" class="control-label">{{ __('panel.featured') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3 d-flex align-items-center gap-3">
                                {{-- hidden input + star button --}}
                                <input type="hidden" name="featured" id="featured_input"
                                    value="{{ old('featured') ? 1 : 0 }}">
                                <button type="button" id="featured_btn" class="btn btn-light p-2"
                                    aria-pressed="{{ old('featured') ? 'true' : 'false' }}"
                                    title="{{ __('panel.toggle_featured') ?? 'تبديل المميز' }}">
                                    <i id="featured_icon"
                                        class="{{ old('featured') ? 'fas fa-star text-warning' : 'far fa-star text-muted' }}"
                                        style="font-size:1.6em;"></i>
                                </button>
                                @error('featured')
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- SEO --}}
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
                                <input name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}"
                                    class="form-control" />
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                        <div class="col-sm-12 col-md-10 pt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-lg me-2" data-feather="corner-down-left"></i>
                                {{ __('panel.save') }}
                            </button>
                            <a href="{{ route('admin.video_categories.index') }}" class="btn btn-outline-danger">
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

    {{-- Featured toggle script (star behavior) --}}
    <script>
        $(function() {
            $('#featured_btn').on('click', function() {
                var $input = $('#featured_input');
                var $icon = $('#featured_icon');
                // treat '1', 1, true as set
                var val = $input.val();
                var is = (val === '1' || val === 1 || val === 'true');
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
