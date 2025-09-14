@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i> {{ __('panel.edit_sheikh_page') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a
                            href="{{ route('admin.sheikh_pages.index') }}">{{ __('panel.manage_sheikh_pages') }}</a> /</li>
                    <li class="ms-1"><a href="">{{ $sheikhPage->title }}</a></li>
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

            <form action="{{ route('admin.sheikh_pages.update', $sheikhPage->id) }}" method="POST"
                enctype="multipart/form-data" novalidate>
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
                        <div class="row mt-3">
                            <label for="title" class="col-sm-12 col-md-2 pt-3">{{ __('panel.title') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $sheikhPage->title) }}"
                                    class="form-control @error('title') is-invalid @enderror" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="description" class="col-sm-12 col-md-2 pt-3">{{ __('panel.description') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10"
                                    class="form-control summernote @error('description') is-invalid @enderror">{!! old('description', $sheikhPage->description) !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="img" class="col-sm-12 col-md-2 pt-3">{{ __('panel.change_image') }}
                                <br><small>{{ __('panel.best_size') }}</small></label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="file" name="img" id="img" class="file-input-overview"
                                    accept="image/*">
                                <small class="text-muted">{{ __('panel.leave_empty_to_keep_current') }}</small>
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3">{{ __('panel.publish_date') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="{{ old('published_on', $sheikhPage->published_on?->format('Y-m-d H:i')) }}"
                                        class="form-control" placeholder="{{ __('panel.publish_date') }}" data-input
                                        required>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="status"
                                class="col-sm-12 col-md-2 pt-3 control-label">{{ __('panel.status') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', $sheikhPage->status) == '1' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="status_active">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status', $sheikhPage->status) == '0' ? 'checked' : '' }}
                                        required>
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
                        <div class="row mt-3">
                            <label for="meta_slug" class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_slug') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug"
                                    value="{{ old('meta_slug', $sheikhPage->meta_slug) }}" class="form-control">
                                @error('meta_slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="meta_keywords"
                                class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_keywords') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input name="meta_keywords" id="tags1"
                                    value="{{ old('meta_keywords', $sheikhPage->meta_keywords) }}"
                                    class="form-control" />
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="meta_description"
                                class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_description') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control">{{ old('meta_description', $sheikhPage->meta_description) }}</textarea>
                                @error('meta_description')
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
                            <i class="icon-lg me-2" data-feather="save"></i> {{ __('panel.update') }}
                        </button>
                        <a href="{{ route('admin.sheikh_pages.index') }}" class="btn btn-outline-danger">
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
                    @if ($sheikhPage->img)
                        "{{ asset('assets/sheikh_pages/images/' . $sheikhPage->img) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($sheikhPage->img)
                        {
                            caption: "{{ basename($sheikhPage->img) }}",
                            url: "{{ route('admin.sheikh_pages.remove_image') }}",
                            key: "{{ $sheikhPage->id }}",
                            extra: {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $sheikhPage->id }}"
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

            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "{{ old('published_on', $sheikhPage->published_on?->format('Y-m-d H:i')) }}" ||
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
@endsection
