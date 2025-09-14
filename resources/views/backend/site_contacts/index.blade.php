@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-address-book"></i> بيانات التواصل
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.site_contacts.edit', 2) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- العنوان --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_address" class="form-label">العنوان</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_address" id="site_address" class="form-control"
                            value="{{ $site_address->value ?? '' }}">
                    </div>
                </div>

                {{-- الهاتف --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_mobile" class="form-label">الهاتف</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_mobile" id="site_mobile" class="form-control"
                            value="{{ $site_mobile->value ?? '' }}">
                    </div>
                </div>

                {{-- الفاكس --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_fax" class="form-label">الفاكس</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_fax" id="site_fax" class="form-control"
                            value="{{ $site_fax->value ?? '' }}">
                    </div>
                </div>

                {{-- البريد الإلكتروني --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_email" class="form-label">البريد الإلكتروني</label>
                    </div>
                    <div class="col-md-10">
                        <input type="email" name="site_email" id="site_email" class="form-control"
                            value="{{ $site_email->value ?? '' }}">
                    </div>
                </div>

                {{-- أوقات العمل --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_workTime" class="form-label">أوقات العمل</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_workTime" id="site_workTime" class="form-control"
                            value="{{ $site_workTime->value ?? '' }}">
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
