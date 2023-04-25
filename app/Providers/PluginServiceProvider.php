<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

final class PluginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register any dependencies or services required by your plugin here
    }

    public function boot(): void
    {
        $plugins = config('plugins');

//        dd($plugins);

        foreach ($plugins as $key => $plugin) {

            $className = Str::studly($key);

            $namespace = 'App\\Plugins\\'.ucfirst($className).'\\';
            $path = app_path('Plugins/'.ucfirst($className).'/');

            if (class_exists($namespace.$className)) {
                $this->error('Plugin class already exists.');

                return;
            }

//            dd($path);

            // Load routes

            if (file_exists($path.'routes/api.php')) {
                $this->loadRoutesFrom($path.'routes/api.php');
            }

            if (file_exists($path.'routes/web.php')) {
                $this->loadRoutesFrom($path.'routes/web.php');
            }

            // Load views
            if (is_dir($path.'views')) {
                $this->loadViewsFrom($path.'views', $namespace.'views');
            }

            // Load migrations
            if (is_dir($path.'database/migrations')) {
                $this->loadMigrationsFrom($path.'database/migrations');
            }

            // Load seeder
            if (is_dir($path.'database/seeders')) {
                $this->loadMigrationsFrom($path.'database/seeders');
            }

            // Load translations
            if (is_dir($path.'lang')) {
                $this->loadTranslationsFrom($path.'lang', $namespace.'lang');
            }

//            dd($path);
            // Load controllers
            if (is_file($path.'Controllers')) {
                $this->app->make($namespace.'Controllers');
            }
        }
    }
}
