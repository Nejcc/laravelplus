<div class="offcanvas offcanvas-bottom h-auto show js-cookie-consent" tabindex="-1" id="offcanvasBottom" aria-modal="true" role="dialog">
    <div class="offcanvas-body">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    {!! __('cookie-consent::texts.message') !!}
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="offcanvas">
                        {{ __('Essential Cookies Only') }}
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary js-cookie-consent-agree" data-bs-dismiss="offcanvas">
                        {{ __('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>