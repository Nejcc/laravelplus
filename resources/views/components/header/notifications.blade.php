<div>
    <div class="mt-2">
        <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                    <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                </svg>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge bg-red">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Notifications') }}</h3>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <div class="card-actions">
                                <a href="{{ route('notifications.markAllAsRead') }}" class="btn btn-primary btn-sm">
                                    {{ __('Mark all as read') }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                        @forelse(auth()->user()->notifications as $notification)
                            <div class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="status-dot {{ $notification->read_at ? '' : 'status-dot-animated bg-red' }} d-block"></span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="{{ $notification->data['url'] ?? '#' }}" class="text-body d-block">{{ $notification->data['title'] ?? 'Notification' }}</a>
                                        <div class="d-block text-muted text-truncate mt-n1">
                                            {{ $notification->data['message'] ?? '' }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        @if(!$notification->read_at)
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="d-inline">
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
                                    {{ __('No notifications') }}
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>