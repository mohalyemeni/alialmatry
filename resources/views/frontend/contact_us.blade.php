@extends('layouts.app')

@section('content')
    <div class="bac_img">
        <div class="breadcumb-wrapper"
            style="background-image: url('{{ asset('frontand/assets/img/hero/hero_5_3.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0;">
            <div class="container">
                <div class="breadcumb-content text-center text-white">
                    <h1 class="breadcumb-title">تواصل معنا</h1>
                    <ul class="breadcumb-menu list-inline justify-content-center mt-3">
                        <li class="list-inline-item">
                            <a href="{{ route('frontend.index') }}" class="text-white">الرئيسية</a>
                        </li>
                        <li class="list-inline-item text-white-50">تواصل معنا</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--==============================
                                        Contact Info Area
                                    ==============================-->
        <div class="space">
            <div class="container">
                <div class="row gy-4">
                    {{-- العنوان --}}
                    @if (isset($siteSettings['site_address']->value) && $siteSettings['site_address']->value)
                        <div class="col-xl-4 col-lg-6">
                            <div class="contact-media">
                                <div class="icon-btn">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="box-title">العنوان</h5>
                                    <p class="box-text">{{ $siteSettings['site_address']->value }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- الهاتف --}}
                    @if (isset($siteSettings['site_mobile']->value) && $siteSettings['site_mobile']->value)
                        <div class="col-xl-4 col-lg-6">
                            <div class="contact-media">
                                <div class="icon-btn">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="box-title">رقم الهاتف</h5>
                                    <p class="box-text">
                                        <a href="tel:{{ $siteSettings['site_mobile']->value }}">
                                            {{ $siteSettings['site_mobile']->value }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- الإيميل --}}
                    @if (isset($siteSettings['site_email']->value) && $siteSettings['site_email']->value)
                        <div class="col-xl-4 col-lg-6">
                            <div class="contact-media">
                                <div class="icon-btn">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="box-title">الإيميل</h5>
                                    <p class="box-text">
                                        <a href="mailto:{{ $siteSettings['site_email']->value }}">
                                            {{ $siteSettings['site_email']->value }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!--==============================
                                        Contact Area
                                    ==============================-->
        <div class="space-bottom">
            <div class="container">
                <div class="row gx-0 gy-4">
                    <div class="col-xl-6">
                        <form action="{{ route('frontend.contact.send') }}" method="POST"
                            class="contact-form2 input-smoke">
                            @csrf
                            <h3 class="h2">هل لديك أي إستفسار؟</h3>

                            {{-- رسائل النجاح --}}
                            @if (session('success'))
                                <div class="alert alert-success" id="successMessage">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- رسائل الأخطاء --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="الإسم*" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" class="form-control text-end" name="number"
                                        placeholder="*الهاتف">
                                </div>

                                <div class="form-group col-12">
                                    <input type="email" class="form-control" name="email" placeholder="الايميل*"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <textarea name="message" cols="30" rows="3" class="form-control" placeholder="اكتب رسالتك هنا*" required></textarea>
                                </div>
                                <div class="form-btn col-12">
                                    <button type="submit" class="th-btn">
                                        <span class="btn-text" data-back="ارسل الرسالة" data-front="ارسل الرسالة"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-image">
                            <img src="{{ asset('frontand/assets/img/normal/contact-image.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- سكريبت لإخفاء رسالة النجاح بعد 4 ثوانٍ --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const msg = document.getElementById("successMessage");
            if (msg) {
                setTimeout(() => {
                    msg.style.transition = "opacity 0.5s ease";
                    msg.style.opacity = "0";
                    setTimeout(() => msg.remove(), 500);
                }, 4000);
            }
        });
    </script>
@endsection
