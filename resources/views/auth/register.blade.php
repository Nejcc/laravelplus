@extends('layouts.auth')

@section('content')
<div class="row align-items-center g-4">
    <div class="col-lg">
        <div class="container-tight">
            <div class="text-center mb-4">
                <a href="{{ route('welcome') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset(config('app.theme.path').'static/logo.svg') }}" height="36" alt="">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{ __('Create new account') }}</h2>
                    <form action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        @if(config('theme.has.register_name'))
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="email" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter your name') }}"
                                       name="name" value="{{ old('name') }}" required  autocomplete="name" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email address') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}"
                                   name="email" value="{{ old('email') }}" required  autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                {{ __('Password') }}
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Your password') }}"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="input-group-text">
                                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <i class="ti ti-eye"></i>
                                  </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                {{ __('Password Again') }}
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Your password') }}"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="input-group-text">
                                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <i class="ti ti-eye"></i>
                                  </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <span class="form-check-label">{!!  __('Agree the <a href=":url" tabindex="-1">terms and policy</a>', ['url' => route('tos')]) !!}.</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                {{ __('Already have account') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
            </div>
        </div>
    </div>
    @if(config('theme.login.ilustration'))
        <div class="col-lg d-none d-lg-block">
            <img src="{{ asset(config('app.theme.path').'static/illustrations/undraw_secure_login_pdn4.svg') }}"
                 height="300" class="d-block mx-auto"
                 alt="{{ asset(config('app.theme.path').'static/illustrations/undraw_secure_login_pdn4.svg') }}">
        </div>
    @endif
</div>
@endsection
