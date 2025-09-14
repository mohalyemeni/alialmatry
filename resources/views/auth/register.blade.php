@extends('layouts.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('Register') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-end">

                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{{ __('Register') }}</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="first_name">First Name</label>
                                <input class="form-control form-control-lg" type="text" id="first_name" name="first_name"
                                    value="{{ old('first_name') }}" placeholder="Enter Your First Name">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="last_name">Last Name</label>
                                <input class="form-control form-control-lg" type="text" id="last_name" name="last_name"
                                    value="{{ old('last_name') }}" placeholder="Enter Your Last Name">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="username">Username</label>
                                <input class="form-control form-control-lg" type="text" id="username" name="username"
                                    value="{{ old('username') }}" placeholder="Enter Your User Name">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="email">Email</label>
                                <input class="form-control form-control-lg" type="email" id="email" name="email"
                                    placeholder="Enter Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="mobile">Mobile</label>
                                <input class="form-control form-control-lg" type="text" id="mobile" name="mobile"
                                    placeholder="Enter Your Mobile Number" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="password">Password</label>
                                <input class="form-control form-control-lg" type="password" id="password" name="password"
                                    placeholder="Enter Your Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-small text-uppercase" for="password_confirmation">Confirm
                                    Password</label>
                                <input class="form-control form-control-lg" type="password" id="password_confirmation"
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-dark" type="submit">{{ __('Register') }}</button>

                                @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('Have an account?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

            </div>


        </div>
        </div>
    </section>
@endsection
