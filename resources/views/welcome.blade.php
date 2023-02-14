<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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