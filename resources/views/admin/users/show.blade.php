@extends('layouts.master')

@section('header')
    <div class="page-header mb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="mb-3">
                    <ol class="breadcrumb" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Administration') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                    </ol>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-lg rounded"
                          style="background-image: url({{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }})"></span>
                </div>
                <div class="col">
                    <h1 class="fw-bold">{{ $user->name }}</h1>
                    <div class="my-2">{{ $user->username ?? 'No username set' }}</div>
                    <div class="list-inline list-inline-dots text-muted">
                        <div class="list-inline-item">
                            <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>
                            <a href="mailto:{{ $user->email }}" class="text-reset">{{ $user->email }}</a>
                        </div>
                        <div class="list-inline-item">
                            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                <path d="M16 3l0 4"></path>
                                <path d="M8 3l0 4"></path>
                                <path d="M4 11l16 0"></path>
                                <path d="M8 15h2v2h-2z"></path>
                            </svg>
                            {{ __('Joined') }} {{ $user->created_at->format('M d, Y') }}
                        </div>
                        <div class="list-inline-item">
                            <!-- Download SVG icon from http://tabler-icons.io/i/shield-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 12l2 2l4 -4"></path>
                                <path d="M12 22l7 -2.5v-12l-7 -2.5l-7 2.5v12l7 2.5z"></path>
                            </svg>
                            {{ $user->roles->pluck('name')->join(', ') ?: 'No roles assigned' }}
                        </div>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            {{ __('Edit User') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('User Details') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Name') }}</label>
                                    <div class="form-control-plaintext">{{ $user->name }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Username') }}</label>
                                    <div class="form-control-plaintext">{{ $user->username ?? '---' }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <div class="form-control-plaintext">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Created At') }}</label>
                                    <div class="form-control-plaintext">{{ $user->created_at->format('Y-m-d H:i:s') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email Verified') }}</label>
                                    <div class="form-control-plaintext">
                                        @if($user->email_verified_at)
                                            {{ $user->email_verified_at->format('Y-m-d H:i:s') }}
                                        @else
                                            {{ __('Not verified') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Last Updated') }}</label>
                                    <div class="form-control-plaintext">{{ $user->updated_at->format('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('User Notifications') }}</h3>
                        @if($user->unreadNotifications->count() > 0)
                            <div class="card-actions">
                                <form action="{{ route('admin.users.notifications.markAllAsRead', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ __('Mark all as read') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($user->notifications()->paginate(10) as $notification)
                                <div class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="status-dot {{ $notification->read_at ? '' : 'status-dot-animated bg-red' }} d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="{{ $notification->data['url'] ?? '#' }}" class="text-body d-block">
                                                {{ $notification->data['title'] ?? 'Notification' }}
                                            </a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                {{ $notification->data['message'] ?? '' }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            @if(!$notification->read_at)
                                                <form action="{{ route('admin.users.notifications.markAsRead', [$user, $notification->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-sm btn-ghost-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M5 12l5 5l10 -10"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item">
                                    <div class="text-center text-muted py-3">
                                        {{ __('No notifications found') }}
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        @if($user->notifications()->count() > 0)
                            <div class="card-footer">
                                {{ $user->notifications()->paginate(10)->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('User Status') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Roles') }}</label>
                            <div class="form-control-plaintext">
                                @forelse($user->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                @empty
                                    {{ __('No roles assigned') }}
                                @endforelse
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Permissions') }}</label>
                            <div class="form-control-plaintext">
                                @forelse($user->getAllPermissions() as $permission)
                                    <span class="badge bg-secondary">{{ $permission->name }}</span>
                                @empty
                                    {{ __('No permissions assigned') }}
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
