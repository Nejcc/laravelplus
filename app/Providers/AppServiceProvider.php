<?php

declare(strict_types=1);

namespace App\Providers;

use App\Billing\Gateways\BankPaymentGateway;
use App\Billing\Gateways\CreditCardPaymentGateway;
use App\Billing\Gateways\CryptoPaymentGateway;
use App\Billing\Gateways\PayPalPaymentGateway;
use App\Billing\Gateways\StripePaymentGateway;
use App\Billing\PaymentGatewayContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {

            if (request()->has('payment_method')) {

                if (request()->input('payment_method') === 'credit') {
                    return new CreditCardPaymentGateway(config('app.default_currency'));
                }

                if (request()->input('payment_method') === 'stripe') {
                    return new StripePaymentGateway(config('app.default_currency'));
                }

                if (request()->input('payment_method') === 'paypal') {
                    return new PayPalPaymentGateway(config('app.default_currency'));
                }

                if (request()->input('payment_method') === 'crypto') {
                    return new CryptoPaymentGateway(config('app.default_currency'));
                }

                return new BankPaymentGateway(config('app.default_currency'));
            }

        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * prevent N+1  on develop.
         */
        Model::preventLazyLoading(!app()->isProduction());

        /**
         * Overide paginator.
         */
        //        Paginator::defaultView('vendor.pagination.bootstrap-5');

        /**
         * Config for database.
         */
        Schema::defaultStringLength(191);
        //        Builder::defaultStringLength(191);
    }
}
