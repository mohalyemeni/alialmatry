@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-image"></i> تنسيقات الموقع
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.site_style.edit', 5) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- شعار فاتح --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_logo_light" class="form-label">شعار فاتح</label>
                    </div>
                    <div class="col-md-10">
                        @if (isset($site_logo_light->value))
                            <img src="{{ asset('assets/site_settings/' . $site_logo_light->value) }}"
                                class="img-thumbnail mb-2" style="max-height: 80px;">
                        @endif
                        <input type="file" name="site_logo_light" id="site_logo_light" class="form-control">
                    </div>
                </div>

                {{-- شعار داكن --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_logo_dark" class="form-label">شعار داكن</label>
                    </div>
                    <div class="col-md-10">
                        @if (isset($site_logo_dark->value))
                            <img src="{{ asset('assets/site_settings/' . $site_logo_dark->value) }}"
                                class="img-thumbnail mb-2" style="max-height: 80px;">
                        @endif
                        <input type="file" name="site_logo_dark" id="site_logo_dark" class="form-control">
                    </div>
                </div>

                {{-- الفافيكون --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_favicon" class="form-label">فافيكون</label>
                    </div>
                    <div class="col-md-10">
                        @if (isset($site_favicon->value))
                            <img src="{{ asset('assets/site_settings/' . $site_favicon->value) }}"
                                class="img-thumbnail mb-2" style="max-height: 50px;">
                        @endif
                        <input type="file" name="site_favicon" id="site_favicon" class="form-control">
                    </div>
                </div>

                {{-- أزرار الحفظ والإلغاء --}}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> حفظ
                        </button>
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-danger">
                            <i class="fa fa-times me-2"></i> إلغاء
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
