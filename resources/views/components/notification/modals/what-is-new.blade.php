<div>
    <div class="modal modal-blur fade show" id="modal-success" tabindex="-1"
         style="{{ (auth()->user()->is_read_news != true) ? 'display: block;' : '' }}" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-status bg-success"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M9 12l2 2l4 -4"/>
                    </svg>
                    <h2 id="what-is-tabler">{{ __('Welcome to new version') }}</h2>
                    <div class="text-start">

                        <p class="text-start">We are excited to announce the latest additions to the LaravelPlus
                            platform,
                            which are designed to enhance the development experience and provide powerful tools for
                            administrators and developers alike. </p><p> Let's take a closer look at the new features: </p>
                        <h4>Remote Modules:</h4>
                        <p>Remote Access Modules offer administrators easy access to all users' views within the LaravelPlus
                            platform. This feature enables administrators to remotely view and manage user interfaces,
                            allowing for seamless troubleshooting and support. With Remote Modules, administrators can
                            efficiently assist users, identify and resolve issues, and provide a smoother user
                            experience.</p>

                        <h4>Plugin Modules:</h4>
                        <p>Plugin Modules introduce a powerful tool for building HMVC (Hierarchical
                            Model-View-Controller)
                            architecture within Laravel projects. This feature enables developers to create modular,
                            scalable, and maintainable applications. With Plugin Modules, developers can easily extend
                            and
                            customize their Laravel projects, promoting code reusability and efficient development..</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('ajax.read.news') }}" method="post">
                                    <input type="hidden" name="user_news" value="1">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Go to dashboard') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success w-100">
                                    {{ __('Read more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
