@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i> {{ __('panel.edit_fatwa') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index_route') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a href="{{ route('admin.fatawa.index') }}">{{ __('panel.manage_fatawa') }}</a> /</li>
                    <li class="ms-1"> <a href=""> {{ $fatwa->title }}</a></li>
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
            <form id="editFatwaForm" action="{{ route('admin.fatawa.update', $fatwa->id) }}" method="POST"
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
                            <label for="category_id" class="col-sm-12 col-md-2 pt-3">{{ __('panel.category') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">{{ __('panel.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $fatwa->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="title" class="col-sm-12 col-md-2 pt-3">{{ __('panel.title') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $fatwa->title) }}"
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
                                    class="form-control summernote @error('description') is-invalid @enderror">{!! old('description', $fatwa->description) !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- صورة الفتوى -->
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

                        <!-- ملف الصوت -->
                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3">{{ __('panel.current_audio_file') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                @if ($fatwa->audio_file)
                                    <audio controls style="width: 100%; max-width: 400px;">
                                        <source src="{{ asset('assets/fatawa/files/' . $fatwa->audio_file) }}"
                                            type="audio/mpeg">
                                        {{ __('panel.audio_not_supported') }}
                                    </audio>
                                @else
                                    <p>{{ __('panel.no_audio_uploaded') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="audio_file"
                                class="col-sm-12 col-md-2 pt-3">{{ __('panel.change_audio_file') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="file" name="audio_file" id="audio_file" class="form-control"
                                    accept="audio/*">
                                <small class="text-muted">{{ __('panel.leave_empty_to_keep_current_audio') }}</small>
                                @error('audio_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- تاريخ النشر -->
                        <div class="row mt-3">
                            <label class="col-sm-12 col-md-2 pt-3">{{ __('panel.publish_date') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="{{ old('published_on', $fatwa->published_on?->format('Y-m-d H:i')) }}"
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

                        <!-- حالة الفتوى -->
                        <div class="row mt-3">
                            <label for="status"
                                class="col-sm-12 col-md-2 pt-3 control-label">{{ __('panel.status') }}</label>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', $fatwa->status) == '1' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="status_active">{{ __('panel.active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status', $fatwa->status) == '0' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label"
                                        for="status_inactive">{{ __('panel.inactive') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- قسم SEO -->
                    <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                        <div class="row mt-3">
                            <label for="meta_slug" class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_slug') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <input type="text" name="meta_slug" id="meta_slug"
                                    value="{{ old('meta_slug', $fatwa->meta_slug) }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 pt-3">
                                <label for="meta_keywords">{{ __('panel.seo_keywords') }}</label>
                            </div>
                            <div class="col-md-9">
                                <div class="card p-2">
                                    <input name="meta_keywords" id="tags"
                                        value="{{ old('meta_keywords', $fatwa->meta_keywords ?? '') }}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="meta_description"
                                class="col-sm-12 col-md-3 pt-3">{{ __('panel.seo_description') }}</label>
                            <div class="col-sm-12 col-md-9 pt-3">
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control">{{ old('meta_description', $fatwa->meta_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار -->
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary" id="updateBtn">
                            <i class="icon-lg me-2" data-feather="save"></i> <span
                                id="updateBtnText">{{ __('panel.update') }}</span>
                        </button>
                        <a href="{{ route('admin.fatawa.index') }}" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> {{ __('panel.cancel') }}
                        </a>
                        <div id="uploadStatus" class="mt-2" aria-live="polite"></div>
                    </div>
                </div>

                <!-- البروجريس بار -->
                <div class="modern-progress-wrapper" id="globalProgressWrapper" style="height: 28px; display:none;">
                    <div id="uploadProgress" class="modern-progress-bar" style="width: 0%;">
                        <span class="modern-progress-label" id="uploadProgressLabel">0%</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const $form = $('#editFatwaForm');
            const $btn = $('#updateBtn');
            const $btnText = $('#updateBtnText');
            const $progressWrapper = $('#globalProgressWrapper');
            const $progress = $('#uploadProgress');
            const $progressLabel = $('#uploadProgressLabel');
            const $status = $('#uploadStatus');

            function resetUI() {
                $progressWrapper.hide();
                $progress.css('width', '0%').removeClass('bg-success bg-danger').addClass(
                    'progress-bar-animated bg-primary');
                $progressLabel.text('0%');
                $status.html('');
                $btn.prop('disabled', false);
                $btnText.text("{{ __('panel.update') }}");
            }
            resetUI();

            $form.on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $btn.prop('disabled', true);
                $btnText.html(
                '<span class="spinner-border spinner-border-sm me-2"></span> جاري التحديث...');
                $progressWrapper.show();
                $.ajax({
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                let percent = Math.round((e.loaded / e.total) * 100);
                                $progress.css('width', percent + '%');
                                $progressLabel.text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        $progress.removeClass('bg-primary').addClass('bg-success');
                        $status.html('<i class="fa fa-check-circle me-1"></i> تم التحديث بنجاح')
                            .addClass('text-success');
                        setTimeout(() => window.location.href =
                            "{{ route('admin.fatawa.index') }}", 1200);
                    },
                    error: function(err) {
                        $progress.removeClass('bg-primary').addClass('bg-danger');
                        $status.html(
                                '<i class="fa fa-times-circle me-1"></i> حدث خطأ أثناء التحديث')
                            .addClass('text-danger');
                        setTimeout(resetUI, 2000);
                    }
                });
            });
        });
    </script>
@endsection
