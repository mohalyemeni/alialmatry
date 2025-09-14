@extends('layouts.admin')

@section('style')
    <link href="{{ asset('backend/vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_supervisor') }} ({{ $supervisor->full_name }})
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> /</li>
                    <li class="ms-1"><a
                            href="{{ route('admin.supervisors.index') }}">{{ __('panel.manage_supervisors') }}</a></li>
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

            <form action="{{ route('admin.supervisors.update', $supervisor->id) }}" method="post"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="first_name">{{ __('panel.first_name') }}</label>
                        <input type="text" name="first_name" id="first_name"
                            value="{{ old('first_name', $supervisor->first_name) }}" class="form-control">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="last_name">{{ __('panel.last_name') }}</label>
                        <input type="text" name="last_name" id="last_name"
                            value="{{ old('last_name', $supervisor->last_name) }}" class="form-control">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="username">{{ __('panel.username') }}</label>
                        <input type="text" name="username" id="username"
                            value="{{ old('username', $supervisor->username) }}" class="form-control">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="email">{{ __('panel.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $supervisor->email) }}"
                            class="form-control">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="mobile">{{ __('panel.mobile') }}</label>
                        <input type="text" name="mobile" id="mobile"
                            value="{{ old('mobile', $supervisor->mobile) }}" class="form-control">
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="password">{{ __('panel.password') }}</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="{{ __('panel.leave_blank_keep_current') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="status">{{ __('panel.status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', $supervisor->status) == 1 ? 'selected' : '' }}>
                                {{ __('panel.active') }}</option>
                            <option value="0" {{ old('status', $supervisor->status) == 0 ? 'selected' : '' }}>
                                {{ __('panel.inactive') }}</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-12 pt-3">
                        <label for="permissions">{{ __('panel.permissions') }}</label>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                            @foreach ($permissions as $perm)
                                <option value="{{ $perm->id }}"
                                    {{ in_array($perm->id, old('permissions', $supervisorPermissions)) ? 'selected' : '' }}>
                                    {{ $perm->display_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-12 pt-3">
                        <label for="supervisor-image">{{ __('panel.profile_image') }}</label>
                        <input type="file" name="user_image" id="supervisor-image"
                            class="file-input-overview form-control-file">
                        <small class="form-text text-muted">{{ __('panel.image_recommendation') }}</small>
                        @error('user_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i> {{ __('panel.update') }}
                        </button>
                        <a href="{{ route('admin.supervisors.index') }}" class="btn btn-outline-danger">
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
            $('#permissions').select2({
                tags: true,
                placeholder: '{{ __('panel.select_permissions') }}',
                closeOnSelect: false,
                width: '100%'
            });

            $('#supervisor-image').fileinput({
                theme: 'fa',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                showZoom: true,
                @if ($supervisor->user_image)
                    initialPreview: ["{{ asset('assets/users/' . $supervisor->user_image) }}"],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [{
                        caption: "{{ $supervisor->user_image }}",
                        size: {{ file_exists(public_path("assets/users/{$supervisor->user_image}")) ? filesize(public_path("assets/users/{$supervisor->user_image}")) : 0 }},
                        width: "120px",
                        url: "{{ route('admin.supervisors.remove_image', ['supervisor_id' => $supervisor->id, '_token' => csrf_token()]) }}",
                        key: {{ $supervisor->id }}
                    }],
                @endif
                fileActionSettings: {
                    showZoom: true,
                    showRemove: true,
                    showDrag: true,
                    zoomIcon: '<i class="fas fa-search-plus"></i>',
                    removeIcon: '<i class="fas fa-trash"></i>',
                    dragIcon: '<i class="fas fa-arrows-alt"></i>',
                    rotateIcon: '<i class="fas fa-sync-alt"></i>'
                }
            });
        });
    </script>
@endsection
