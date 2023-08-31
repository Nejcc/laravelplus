@extends('layouts.master')

@section('title', __('Dashboard'))

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{__('Admin')}}
                    </div>
                    <h2 class="page-title">
                        {{__('Dashboard')}}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">New view</a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                           data-bs-target="#modal-report" aria-label="Create new report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container my-3">
        <div class="row mt-3">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Manage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><b>Active users:</b>{{ \App\Models\User::query()->where('status', \App\Enums\User\UserStatusEnum::ONLINE)->count() }} </p>
                        <p><b>Inactive users:</b>{{ \App\Models\User::query()->where('status', \App\Enums\User\UserStatusEnum::OFFLINE)->count() }}</p>
                        <p><b>Away users:</b>{{ \App\Models\User::query()->where('status', \App\Enums\User\UserStatusEnum::AWAY)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Card with action</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Manage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem, beatae cumque cupiditate
                        debitis deleniti dolorem, ea facilis illum nam numquam optio perferendis quasi quod rem repellat
                        rerum sapiente tenetur?
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Card with action</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Manage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem, beatae cumque cupiditate
                        debitis deleniti dolorem, ea facilis illum nam numquam optio perferendis quasi quod rem repellat
                        rerum sapiente tenetur?
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Card with action</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Manage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem, beatae cumque cupiditate
                        debitis deleniti dolorem, ea facilis illum nam numquam optio perferendis quasi quod rem repellat
                        rerum sapiente tenetur?
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection