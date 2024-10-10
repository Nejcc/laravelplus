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
<script src="{{ asset(config('app.theme.path').'dist/js/demo-theme.min.js?1674944402') }}"></script>
<div class="page page-center" id="app">
    <div class="container container-normal py-4">
        @yield('content')
    </div>
</div>
<script src="{{ asset(config('app.theme.path').'dist/js/tabler.min.js?1674944402') }}" defer></script>
<script src="{{ asset(config('app.theme.path').'dist/js/demo.min.js?1674944402') }}" defer></script>
@stack('js')
<script>
    window.translations = @json(@$translations);
</script>
</body>
</html>