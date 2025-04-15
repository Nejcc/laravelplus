@extends('layouts.app')

@section('header')
    <div class="page-header mb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="mb-3">
                    <ol class="breadcrumb" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Administration') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Permissions') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div id="app">
        <permissions-component></permissions-component>
    </div>
@endsection

@push('scripts')
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            locale: '{{ app()->getLocale() }}'
        };
    </script>
@endpush
