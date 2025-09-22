@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i> {{ __('panel.edit_book') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index_route') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a href="{{ route('admin.books.index') }}">{{ __('panel.manage_books') }}</a> /</li>
                    <li class="ms-1"><a href="">{{ $book->title }}</a></li>
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

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data"
                novalidate>
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
                        <!-- Title -->
                        <div class="row mt-3">
                            <label for="title" class="col-sm-12 col-md-2 pt-3">{{ __('panel.title') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $book->title) }}"
                                    class="form-control @error('title') is-invalid @enderror" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mt-3">
                            <label for="description" class="col-sm-12 col-md-2 pt-3">{{ __('panel.description') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <textarea name="description" id="description" rows="10"
                                    class="form-control summernote @error('description') is-invalid @enderror">{!! old('description', $book->description) !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Book Cover Image -->
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

                        <!-- Current Book File -->
                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3">{{ __('panel.current_file') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                @if ($book->file)
                                    <a href="{{ asset('assets/books/files/' . $book->file) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> {{ __('panel.preview_book') }}
                                    </a>
                                    <a href="{{ asset('assets/books/files/' . $book->file) }}" download
                                        class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-download"></i> {{ __('panel.download') }}
                                    </a>
                                @else
                                    <p>{{ __('panel.no_file_uploaded') }}</p>
                                @endif
                            </div>
                        </div>


                        <!-- Change Book File -->
                        <div class="row mt-3">
                            <label for="file" class="col-sm-12 col-md-2 pt-3">{{ __('panel.change_file') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="file" name="file" id="file" class="form-control"
                                    accept=".doc,.docx,.pdf">
                                <small class="text-muted">{{ __('panel.leave_empty_to_keep_current_file') }}</small>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Publish Date -->
                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3">{{ __('panel.publish_date') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="{{ old('published_on', $book->published_on?->format('Y-m-d H:i')) }}"
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

                        <!-- Status -->
                        <div class="row mt-3">
                            <label for="status"
                                class="col-sm-12 col-md-2 pt-3 control-label">{{ __('panel.status') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', $book->status) == '1' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="status_active">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status', $book->status) == '0' ? 'checked' : '' }}
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

                    <!-- SEO Tab -->
                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row mt-3">
                            <label for="meta_slug" class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_slug') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug"
                                    value="{{ old('meta_slug', $book->meta_slug) }}" class="form-control">
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
                                    value="{{ old('meta_keywords', $book->meta_keywords) }}" class="form-control" />
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="meta_description"
                                class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_description') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control">{{ old('meta_description', $book->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="save"></i> {{ __('panel.update') }}
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-danger">
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
            // Summernote
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

            // Flatpickr
            const locale = "ar";
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "{{ old('published_on', $book->published_on?->format('Y-m-d H:i')) }}" ||
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

            // Book Cover Image fileinput
            $("#img").fileinput({
                theme: "fa5",
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                maxFileCount: 1,
                initialPreview: [
                    @if ($book->img)
                        "{{ asset('assets/books/images/' . $book->img) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($book->img)
                        {
                            caption: "{{ basename($book->img) }}",
                            url: "{{ route('admin.books.remove_image') }}",
                            key: "{{ $book->id }}",
                            extra: {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $book->id }}"
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

            // Book File fileinput
            $("#file").fileinput({
                theme: "fa5",
                allowedFileTypes: ['office', 'document', 'pdf'],
                showCancel: true,
                showRemove: true,
                showUpload: false,
                overwriteInitial: false,
                maxFileCount: 1,
                initialPreview: [
                    @if ($book->file)
                        "{{ asset('assets/books/files/' . $book->file) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'object',
                initialPreviewConfig: [
                    @if ($book->file)
                        {
                            caption: "{{ basename($book->file) }}",
                            url: "{{ route('admin.books.remove_file') }}",
                            key: "{{ $book->id }}",
                            extra: {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $book->id }}"
                            }
                        }
                    @endif
                ],
                fileActionSettings: {
                    showZoom: false,
                    showRemove: true,
                    removeIcon: '<i class="fas fa-trash"></i>',
                }
            });
        });
    </script>
@endsection
