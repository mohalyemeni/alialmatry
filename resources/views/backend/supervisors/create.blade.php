@extends('layouts.admin')

@section('style')
    <link href="{{ asset('backend/vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_supervisor') }}
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

            <form action="{{ route('admin.supervisors.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="first_name">{{ __('panel.first_name') }}</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                            class="form-control">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="last_name">{{ __('panel.last_name') }}</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                            class="form-control">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="username">{{ __('panel.username') }}</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="form-control">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="email">{{ __('panel.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="mobile">{{ __('panel.mobile') }}</label>
                        <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                            class="form-control">
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="password">{{ __('panel.password') }}</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 pt-3">
                        <label for="status">{{ __('panel.status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', '1') === '1' ? 'selected' : '' }}>
                                {{ __('panel.active') }}</option>
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
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
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}"
                                    {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ $permission->display_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-12 pt-3">
                        <label for="supervisor-image">{{ __('panel.profile_image') }}</label>
                        <input type="file" name="user_image" id="supervisor-image" class="file-input-overview">
                        <small class="form-text text-muted">{{ __('panel.image_recommendation') }}</small>
                        @error('user_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="corner-down-left"></i> {{ __('panel.save') }}
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
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                placeholder: '{{ __('panel.select_permissions') }}',
                width: '100%',
                closeOnSelect: false
            });

            $('#supervisor-image').fileinput({
                theme: 'fa',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
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
