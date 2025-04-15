@props(['notifications' => auth()->user()->notifications])

<div>
    <div class="mt-2">
        <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <i class="ti ti-bell"></i>
                @if($notifications->where('read_at', null)->count() > 0)
                    <span class="badge bg-red">{{ $notifications->where('read_at', null)->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Notifications') }}</h3>
                        @if($notifications->where('read_at', null)->count() > 0)
                            <div class="card-actions">
                                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ __('Mark all as read') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                        @forelse($notifications as $notification)
                            <div class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="status-dot {{ $notification->read_at ? '' : 'status-dot-animated bg-red' }} d-block"></span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="{{ $notification->data['url'] ?? '#' }}" 
                                           class="text-body d-block"
                                           @if(!$notification->read_at)
                                               onclick="markAsRead('{{ $notification->id }}')"
                                           @endif>
                                            {{ $notification->data['title'] ?? 'Notification' }}
                                        </a>
                                        <div class="d-block text-muted text-truncate mt-n1">
                                            {{ $notification->data['message'] ?? '' }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="col-auto">
                                        @if(!$notification->read_at)
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  id="markAsReadForm-{{ $notification->id }}">
                                                @csrf
                                                <button type="submit" class="btn btn-icon btn-sm btn-ghost-secondary">
                                                    <i class="ti ti-check"></i>
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

@push('scripts')
<script>
    function markAsRead(notificationId) {
        const form = document.getElementById(`markAsReadForm-${notificationId}`);
        if (form) {
            form.submit();
        }
    }
</script>
@endpush