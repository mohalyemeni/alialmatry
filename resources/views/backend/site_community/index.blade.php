@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-users"></i> المجتمع والتطبيق
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.community_links.edit', 7) }}" method="POST">
                @csrf

                {{-- رابط المجتمع --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_community_link" class="form-label">رابط المجتمع</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_community_link" id="site_community_link" class="form-control"
                            value="{{ $site_community_link->value ?? '' }}">
                    </div>
                </div>

                {{-- رابط التطبيق --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_app_link" class="form-label">رابط التطبيق</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_app_link" id="site_app_link" class="form-control"
                            value="{{ $site_app_link->value ?? '' }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> حفظ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
