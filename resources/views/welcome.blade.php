<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} - The Ultimate Laravel Missing Backend</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="LaravelPlus is the missing Laravel backend that provides a prepared structure to work with, saving you time and effort in developing web applications or websites with Laravel. With pre-built components and modules, LaravelPlus makes it easy to customize and integrate functionality into your project, making it the ultimate Laravel backend framework.">
    <meta name="keywords" content="LaravelPlus,Laravel Plus,Laravel, Administration, framework,Laravel Admin, Laravel components, web application development">
    <meta property="og:title" content="LaravelPlus - The Ultimate Laravel Backend Framework">
    <meta property="og:description" content="LaravelPlus is the missing Laravel backend that provides a prepared structure to work with, saving you time and effort in developing web applications or websites with Laravel.">
    <meta property="og:image" content="https://example.com/images/laravelplus-logo.png">
    <meta property="og:url" content="https://laravelplus.com/">
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KHRWQJJWYD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-KHRWQJJWYD');
    </script>
</head>
<body class="d-flex flex-column bg-dark" id="app">
<div class="page page-center">
    <div class="container container-tight py-4">
        {{--        <div class="text-center mb-4">--}}
        {{--            <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('static/logo.svg') }}" height="36" alt=""></a>--}}
        {{--        </div>--}}
        <div class="text-center">
            <div class="my-5">
                <h1 class="text-danger">Laravel<b class="text-primary">Plus</b></h1>
                <p class="fs-h3 text-muted">
                    Skip init start working!
                </p>
                <a href="https://github.com/nejcc/laravelplus" target="_blank">Join us on Github</a>
            </div>
        </div>
    </div>
</div>
{{--<script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('dist/js/demo.min.js') }}" defer></script>--}}
</body>
</html>