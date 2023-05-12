<div>
    <div class="modal modal-blur fade show" id="modal-success" tabindex="-1"
         style="{{ (auth()->user()->is_read_news != true) ? 'display: block;' : '' }}" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
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
                    <h3>{{ __('What is new?') }}</h3>
                    <div class="text-muted">
                        {{ __('Welcome to new version') }}
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
