@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-info-circle"></i> بيانات الموقع
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.site_infos.edit', 1) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- اسم الموقع --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_name" class="form-label">اسم الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_name" id="site_name" class="form-control"
                            value="{{ $site_name->value ?? '' }}">
                    </div>
                </div>

                {{-- وصف الموقع --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_description" class="form-label">وصف الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="site_description" id="site_description" class="form-control" rows="5">{{ $site_description->value ?? '' }}</textarea>
                    </div>
                </div>

                {{-- الكلمات المفتاحية --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="tags" class="form-label">الكلمات المفتاحية</label>
                    </div>
                    <div class="col-md-10">
                        <div class="card p-2">

                            <input name="site_keywords" id="tags" value="{{ $site_keywords->value ?? '' }}" />
                        </div>
                    </div>
                </div>

                {{-- رابط الموقع --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_link" class="form-label">رابط الموقع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_link" id="site_link" class="form-control"
                            value="{{ $site_link->value ?? '' }}">
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
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('#tags').tagsInput({
            'defaultText': 'أضف كلمة مفتاحية',
            'height': 'auto',
            'width': '100%'
        });


        $('#tags_meta').tagsInput({
            'defaultText': 'أضف كلمة مفتاحية',
            'height': 'auto',
            'width': '100%'
        });
    });
</script>
@endsection
