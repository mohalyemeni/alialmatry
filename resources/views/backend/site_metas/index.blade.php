@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-search"></i> إعدادات محركات البحث (SEO)
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.site_meta.edit', 6) }}" method="POST">
                @csrf

                {{-- عنوان الموقع لمحركات البحث --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_name_meta" class="form-label">عنوان الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_name_meta" id="site_name_meta" class="form-control"
                            value="{{ $site_name_meta->value ?? '' }}">
                    </div>
                </div>

                {{-- وصف الموقع لمحركات البحث --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_description_meta" class="form-label">وصف الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="site_description_meta" id="site_description_meta" class="form-control" rows="4">{{ $site_description_meta->value ?? '' }}</textarea>
                    </div>
                </div>

                {{-- رابط الموقع --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_link_meta" class="form-label">رابط الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_link_meta" id="site_link_meta" class="form-control"
                            value="{{ $site_link_meta->value ?? '' }}">
                    </div>
                </div>

                {{-- الكلمات المفتاحية --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_keywords_meta" class="form-label">الكلمات المفتاحية</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_keywords_meta" id="site_keywords_meta" class="form-control"
                            value="{{ $site_keywords_meta->value ?? '' }}">
                    </div>
                </div>

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
