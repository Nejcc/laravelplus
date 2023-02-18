<div>
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ (request()->is('home') ? 'active' : '') }}">
                        <a class="nav-link" href="{{ route('home') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                  d="M5 12l-2 0l9 -9l9 9l-2 0"/><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path
                                  d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                    </span>
                            <span class="nav-link-title">
                      {{ __('Home') }}
                    </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                  d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"/><path d="M12 12l8 -4.5"/><path
                                  d="M12 12l0 9"/><path d="M12 12l-8 -4.5"/><path d="M16 5.25l-8 4.5"/></svg>
                    </span>
                            <span class="nav-link-title">
                      {{ __('submenu' )}}
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./empty.html">
                                        Empty page
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards"
                                           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                           aria-expanded="false">
                                            Cards
                                            <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="./cards.html" class="dropdown-item">
                                                Sample cards
                                            </a>
                                            <a href="./card-actions.html" class="dropdown-item">
                                                Card actions
                                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                            </a>
                                            <a href="./cards-masonry.html" class="dropdown-item">
                                                Cards Masonry
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./pagination.html">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/pie-chart -->
                                        Pagination
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication"
                                           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                           aria-expanded="false">
                                            Authentication
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="./sign-in.html" class="dropdown-item">
                                                Sign in
                                            </a>
                                            <a href="./sign-in-link.html" class="dropdown-item">
                                                Sign in link
                                            </a>
                                            <a href="./sign-in-illustration.html" class="dropdown-item">
                                                Sign in with illustration
                                            </a>
                                            <a href="./sign-in-cover.html" class="dropdown-item">
                                                Sign in with cover
                                            </a>
                                            <a href="./sign-up.html" class="dropdown-item">
                                                Sign up
                                            </a>
                                            <a href="./forgot-password.html" class="dropdown-item">
                                                Forgot password
                                            </a>
                                            <a href="./terms-of-service.html" class="dropdown-item">
                                                Terms of service
                                            </a>
                                            <a href="./auth-lock.html" class="dropdown-item">
                                                Lock screen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @role('super-admin|admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                  d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"/><path d="M12 12l8 -4.5"/><path
                                  d="M12 12l0 9"/><path d="M12 12l-8 -4.5"/><path d="M16 5.25l-8 4.5"/></svg>
                    </span>
                            <span class="nav-link-title">
                      {{ __('Administration' )}}
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                        {{ __('Roles') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.permissions.index') }}">
                                        {{ __('Permissions') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endrole
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