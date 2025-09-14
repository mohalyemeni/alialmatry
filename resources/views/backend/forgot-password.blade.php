@extends('layouts.admin_rescet')
@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">هل نسيت كلمة المرور؟</h1>
                                    <p class="mb-4">نفهم أن الأمور قد تحدث. فقط أدخل بريدك الإلكتروني بالأسفل
                                        وسنرسل لك رابطًا لإعادة تعيين كلمة المرور الخاصة بك!</p>
                                </div>

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group mr">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control form-control-user" placeholder="أدخل بريدك الإلكتروني...">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        إعادة تعيين كلمة المرور
                                    </button>
                                </form>
                                <hr>

                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.login') }}">لديك حساب بالفعل؟ سجل الدخول!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
