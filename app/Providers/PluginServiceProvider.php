<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register any dependencies or services required by your plugin here
    }

    public function boot()
    {
        $plugins = config('plugins');

        foreach ($plugins as $plugin) {
            $namespace = 'App\\Plugins\\' . ucfirst($plugin) . '\\';
            $path = app_path('Plugins/' . ucfirst($plugin) . '/');

            // Load routes

            if (file_exists($path . 'routes/api.php')) {
                $this->loadRoutesFrom($path . 'routes/api.php');
            }

            if (file_exists($path . 'routes/web.php')) {
                $this->loadRoutesFrom($path . 'routes/web.php');
            }

            // Load views
            if (is_dir($path . 'views')) {
                $this->loadViewsFrom($path . 'views', $namespace . 'views');
            }

            // Load migrations
            if (is_dir($path . 'database/migrations')) {
                $this->loadMigrationsFrom($path . 'database/migrations');
            }

            // Load seeder
            if (is_dir($path . 'database/seeders')) {
                $this->loadMigrationsFrom($path . 'database/seeders');
            }

            // Load translations
            if (is_dir($path . 'lang')) {
                $this->loadTranslationsFrom($path . 'lang', $namespace . 'lang');
            }

            // Load controllers
            if (is_dir($path . 'Controllers')) {
                $this->app->make($namespace . 'Controllers\\HomeController');
            }
        }
    }
}