@extends('layouts.auth')

@section('content')
    <div class="row align-items-center g-4">
        <div class="col-lg">
            <div class="container-tight">
                <div class="text-center mb-4">
                    <a href="{{ route('welcome') }}" class="navbar-brand navbar-brand-autodark">
                        {{--                        <img src="{{ asset(config('app.theme.path').'static/logo.svg') }}" height="36" alt="">--}}
                        <h2>{{ config('app.name') }}</h2>
                    </a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
                        <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                            @csrf
                            <div class="mb-3">
                                <x-form.input-text
                                name="email"
                                label="Email address"
                                ></x-form.input-text>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">
                                    {{ __('Password') }}
                                    @if (Route::has('password.request'))
                                    <span class="form-label-description">
                                        <a href="{{ route('password.request') }}">{{ __('I forgot password') }}</a>
                                    </span>
                                    @endif
                                </label>
                                <x-form.input-password
                                    name="password"
                                    label="password"
                                ></x-form.input-password>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="hr-text">{{ __('or') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('sociolite.github.login') }}" class="btn w-100">
                                    <i class="ti ti-brand-github"></i>
                                    {{ __('Login with Github') }}
                                </a>
                            </div>
                            <div class="col">
                                <a href="#" class="btn w-100">
                                    <i class="ti ti-brand-twitter"></i>
                                    {{ __('Login with Twitter' )}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center text-muted mt-3">
                    {{ __('Don\'t have account yet?') }} <a href="{{ route('register') }}"
                                                            tabindex="-1">{{ __('Sign up') }}</a>
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
