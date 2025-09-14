@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-share-alt"></i> وسائل التواصل الاجتماعي
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.site_socials.edit', 3) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- فيسبوك --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_facebook" class="form-label"><i class="fab fa-facebook me-1"></i> فيسبوك</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_facebook" id="site_facebook" class="form-control"
                            value="{{ $site_facebook->value ?? '' }}">
                    </div>
                </div>

                {{-- تويتر --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_twitter" class="form-label"><i class="fab fa-twitter me-1"></i> تويتر</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_twitter" id="site_twitter" class="form-control"
                            value="{{ $site_twitter->value ?? '' }}">
                    </div>
                </div>

                {{-- واتساب --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_whatsapp" class="form-label"><i class="fab fa-whatsapp me-1"></i> واتساب</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_whatsapp" id="site_whatsapp" class="form-control"
                            value="{{ $site_whatsapp->value ?? '' }}">
                    </div>
                </div>

                {{-- لينكدإن --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_linkedin" class="form-label"><i class="fab fa-linkedin me-1"></i> لينكدإن</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_linkedin" id="site_linkedin" class="form-control"
                            value="{{ $site_linkedin->value ?? '' }}">
                    </div>
                </div>

                {{-- انستاجرام --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_instagram" class="form-label"><i class="fab fa-instagram me-1"></i>
                            انستاجرام</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_instagram" id="site_instagram" class="form-control"
                            value="{{ $site_instagram->value ?? '' }}">
                    </div>
                </div>

                {{-- سناب شات --}}
                <div class="row mb-3">
                    <div class="col-md-2 pt-2">
                        <label for="site_snapchat" class="form-label"><i class="fab fa-snapchat me-1"></i> سناب شات</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_snapchat" id="site_snapchat" class="form-control"
                            value="{{ $site_snapchat->value ?? '' }}">
                    </div>
                </div>

                {{-- يوتيوب --}}
                <div class="row mb-4">
                    <div class="col-md-2 pt-2">
                        <label for="site_youtube" class="form-label"><i class="fab fa-youtube me-1"></i> يوتيوب</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="site_youtube" id="site_youtube" class="form-control"
                            value="{{ $site_youtube->value ?? '' }}">
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
