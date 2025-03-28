@extends('layouts.master')

@section('title', __('Roles'))

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Roles') }}
                    </h2>
{{--                    <div class="text-muted mt-1">1-12 of 241 photos</div>--}}
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" name="" class="form-control" placeholder="{{ __('Search…') }}">
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
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            {{ __('Create new Role') }}
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
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Guard name') }}</th>
                                <th>{{ __('Users') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th class="w-1">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th>{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td><a href="{{ route('admin.roles.users.show', $role) }}">{{ $role->users_count }}</a></td>
                                    <td>{{ $role->description }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-primary btn-sm mx-1">
                                            {{ __('Show') }}
                                        </a>
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm mx-1">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('{{ __('Are you sure you want to delete this role?') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@push('css')

@endpush

@push('js')

@endpush
