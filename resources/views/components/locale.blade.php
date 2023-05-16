<div>
    <div class="mt-2">
        <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Change languages">
                {{ strtoupper(app()->getLocale()) }} &nbsp;<i class="ti ti-chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
                    {{--                    <div class="card-header">--}}
                    {{--                        <h3 class="card-title">{{ __('Languages') }}</h3>--}}
                    {{--                    </div>--}}
                    <div class="list-group list-group-flush list-group-hoverable">
                        @foreach(getAllLocales() as $lang)
                            @if($lang['slug'] !== app()->getLocale())
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="status-dot status-dot-animated bg-red d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="{{ route('set.locale', $lang['slug']) }}" class="text-body d-block">{{ ucfirst($lang['name']) }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>