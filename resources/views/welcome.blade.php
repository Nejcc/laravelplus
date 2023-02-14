<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('dist/css/tabler.min.css?1674944402') }}" rel="stylesheet"/>
{{--    <link href="{{ asset('dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ asset('dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ asset('dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ asset('dist/css/demo.min.css?1674944402') }}" rel="stylesheet"/>--}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body  class=" d-flex flex-column" id="app">
<script src="{{ asset('dist/js/demo-theme.min.js?1674944402') }}"></script>
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
{{--<script src="{{ asset('dist/js/tabler.min.js?1674944402') }}" defer></script>--}}
{{--<script src="{{ asset('dist/js/demo.min.js?1674944402') }}" defer></script>--}}
</body>
</html>