@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger pt-0 pb-0 mb-3">
            <ul class="px-2 py-2 m-0" style="list-style-type: circle">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="font-weight-bold text-primary">
                <i class="fa fa-cogs"></i> {{ __('panel.account_settings') }}
            </h3>
            <a href="{{ route('admin.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> {{ __('panel.back_to_dashboard') }}
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.update_account_settings') }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Hidden username --}}
                <input type="hidden" name="username" value="{{ auth()->user()->username }}">

                {{-- Personal Information --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>{{ __('panel.first_name') }}</label>
                        <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}"
                            class="form-control @error('first_name') is-invalid @enderror">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('panel.last_name') }}</label>
                        <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}"
                            class="form-control @error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Account Credentials --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>{{ __('panel.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('panel.mobile') }}</label>
                        <input type="text" name="mobile" value="{{ old('mobile', auth()->user()->mobile) }}"
                            class="form-control @error('mobile') is-invalid @enderror">
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Security --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>{{ __('panel.new_password') }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('panel.leave_blank_keep_current') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ __('panel.update_account') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
