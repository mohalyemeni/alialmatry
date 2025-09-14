@extends('layouts.admin-auth')

@section('content')
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card text_rig">
                <div class="row">
                    <div class="col-md-5 pe-md-0">
                        <div class="auth-side-wrapper">

                        </div>
                    </div>
                    <div class="col-md-7 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Era<span>Tecnology</span></a>
                            <h5 class="text-muted fw-normal mb-4">مرحبا بعودتك! سجل دخولك.</h5>
                            {{-- method="POST" action="{{ route('admin.show_login_form') }}" --}}
                            <form action="{{ route('login') }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">اسم المستخدم</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username') }}"
                                        placeholder="ُEnter Your User Name">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">كلمة المرور</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="current-password"
                                        placeholder="Enter Your Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">تذكرني</label>
                                </div>

                                <div class="d-flex rig">
                                    <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">
                                        دخول
                                    </button>
                                </div>

                                <a href="{{ route('admin.forgot_password') }}" class="d-block mt-3 text-muted">
                                    نسيت كلمة المرور؟
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
