<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS files -->
    <link href="{{ asset(config('app.theme.path').'dist/css/tabler.min.css?1674944402') }}" rel="stylesheet"/>
    <link href="{{ asset(config('app.theme.path').'dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet"/>
    <link href="{{ asset(config('app.theme.path').'dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet"/>
    <link href="{{ asset(config('app.theme.path').'dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet"/>
    <link href="{{ asset(config('app.theme.path').'dist/css/demo.min.css?1674944402') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    @stack('css')
</head>
<body>
<script src="{{ asset(config('app.theme.path').'dist/js/demo-theme.min.js') }}"></script>
<div class="page" id="app">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md d-print-none" data-bs-theme="dark">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('home') }}">
                    <h2 class="mt-2">{{ config('app.name') }}</h2>
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list overide-dark">
                        <x-utilities.switch-user></x-utilities.switch-user>
                    </div>
                </div>
                <div class="d-none d-md-flex">
                    <x-locale></x-locale>
                    <a href="?theme=dark" class="nav-link px-0 mt-1 hide-theme-dark" title="Enable dark mode"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 mt-1 hide-theme-light" title="Enable light mode"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"/>
                        </svg>
                    </a>
                    <x-header.notifications></x-header.notifications>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->email ?? '---' }}</div>
                            <div class="mt-1 small text-muted">{{ ucfirst(auth()->user()->getRoleNames()[0] ?? '---') }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">
                                <i class="ti ti-logout me-2"></i>
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="navbar-expand-md">
        <x-header.navigation></x-header.navigation>
    </header>
    <div class="page-wrapper">
        @yield('header')
        @yield('content')

        @if(config('theme.has.footer'))
            <x-footer.general></x-footer.general>
        @endif
    </div>
    @yield('modals')
</div>
<!-- Libs JS -->
<script src="{{ asset(config('app.theme.path').'dist/libs/nouislider/dist/nouislider.min.js?1674944402') }}"
        defer></script>
<script src="{{ asset(config('app.theme.path').'dist/libs/litepicker/dist/litepicker.js?1674944402') }}" defer></script>
<script src="{{ asset(config('app.theme.path').'dist/libs/tom-select/dist/js/tom-select.base.min.js?1674944402') }}"
        defer></script>
<!-- Tabler Core -->
<script src="{{ asset(config('app.theme.path').'dist/js/tabler.min.js?1674944402') }}" defer></script>
<script src="{{ asset(config('app.theme.path').'dist/js/demo.min.js?1674944402') }}" defer></script>
@stack('js')
<script>
    window.translations = @json(session()->get('translations', []));
</script>
</body>
</html>
