@extends('layouts.master')

@section('title', __('Dashboard'))

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Roles / {{ $role->name }}
                    </h2>
                    <div class="text-muted mt-1">1-12 of 241 photos</div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" name="" class="form-control" placeholder="Search…">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                       fill="none"></path><path
                                                d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path
                                                d="M21 21l-6 -6"></path></svg>
                                  </span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Create new Permission
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container my-3">
        <div class="row">
            @foreach($permission_groups as $key => $permissions)
            <div class="col-3  mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{ ucfirst($key) }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach($permissions as $permission)

{{--                            {{ dd($user_permissions) }}--}}
                        <div class="row align-items-center">
                            <div class="col-auto">
                                {{ ucfirst($permission->name) }}
                            </div>
                            <div class="col-auto ms-auto">
                                <label class="form-check form-switch m-0">
                                    <input class="form-check-input position-static" type="checkbox" {{ (in_array($permission->id, $role_permissions) == true) ? 'checked' : '' }}>
                                </label>
                            </div>
                        </div>
                        <p class="text-muted">{{ $permission->description ?? '' }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('modal')

@endsection

@push('css')

@endpush

@push('js')

@endpush
