<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
