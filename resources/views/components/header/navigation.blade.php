@props(['active' => false])

<div>
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    @foreach(config('navigation.items') as $item)
                        @php
                            $hasRoles = isset($item['roles']);
                            $hasItems = isset($item['items']);
                            $isActive = isset($item['active']) ? request()->is($item['active']) : false;
                        @endphp

                        @if(!$hasRoles || ($hasRoles && auth()->user()->hasAnyRole($item['roles'])))
                            <li class="nav-item {{ $isActive ? 'active' : '' }} {{ $hasItems ? 'dropdown' : '' }}">
                                <a class="nav-link {{ $hasItems ? 'dropdown-toggle' : '' }}" 
                                   href="{{ $hasItems ? '#' : route($item['route'] ?? '#') }}"
                                   @if($hasItems)
                                       data-bs-toggle="dropdown"
                                       data-bs-auto-close="outside"
                                       role="button"
                                       aria-expanded="false"
                                   @endif>
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-{{ $item['icon'] ?? 'circle' }}"></i>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __($item['title']) }}
                                    </span>
                                </a>

                                @if($hasItems)
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                @foreach($item['items'] as $subItem)
                                                    @if(isset($subItem['items']))
                                                        <div class="dropend">
                                                            <a class="dropdown-item dropdown-toggle" 
                                                               href="#"
                                                               data-bs-toggle="dropdown"
                                                               data-bs-auto-close="outside"
                                                               role="button"
                                                               aria-expanded="false">
                                                                {{ __($subItem['title']) }}
                                                                @if(isset($subItem['badge']))
                                                                    <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">
                                                                        {{ $subItem['badge'] }}
                                                                    </span>
                                                                @endif
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                @foreach($subItem['items'] as $nestedItem)
                                                                    <a href="{{ route($nestedItem['route'] ?? '#') }}" 
                                                                       class="dropdown-item">
                                                                        {{ __($nestedItem['title']) }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-item" 
                                                           href="{{ route($subItem['route'] ?? '#') }}">
                                                            @if(isset($subItem['icon']))
                                                                <i class="ti ti-{{ $subItem['icon'] }} me-2"></i>
                                                            @endif
                                                            {{ __($subItem['title']) }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="input-icon">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                  d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/><path d="M21 21l-6 -6"/></svg>
                    </span>
                            <input type="text" value="" class="form-control" placeholder="Search…"
                                   aria-label="Search in website">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>