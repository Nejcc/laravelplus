<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

final class PluginServiceProvider extends ServiceProvider
{
    //    private array $plugins;
    //
    //    public function __construct()
    //    {
    //        $this->plugins = config('plugins');
    //    }

    public function register(): void
    {
        $plugins = config('plugins');

        foreach ($plugins as $key => $plugin) {

            if ($plugin['enabled'] === true) {
                $className = Str::studly($key);

                $namespace = 'App\\Plugins\\'.ucfirst($className).'\\';
                $path = app_path('Plugins/'.ucfirst($className).'/');

                var_dump($path,$className);

                // Register any dependencies or services required by your plugin here
                if (is_dir($path.'Views')) {
                    $this->loadViewsFrom($path.'Views', str_replace('Plugin', '', mb_strtolower($className)));
//                    $this->loadViewsFrom($path.'Views');
                }
            }
        }
    }

    public function boot(): void
    {
        $plugins = config('plugins');

        //        dd($plugins);

        foreach ($plugins as $key => $plugin) {

            if ($plugin['enabled'] === true) {
                $className = Str::studly($key);

                $namespace = 'App\\Plugins\\'.ucfirst($className).'\\';
                $path = app_path('Plugins/'.ucfirst($className).'/');

                // Load routes
                if (file_exists($path.'Routes/api.php')) {
                    $this->loadRoutesFrom($path.'Routes/api.php');
                }

                if (file_exists($path.'Routes/web.php')) {
                    $this->loadRoutesFrom($path.'Routes/web.php');
                }
            }

            // Load views
            //            if (is_dir($path . 'Views')) {
            //                $this->loadViewsFrom($path . 'Views', $namespace . 'views');
            //                View::addNamespace($className, $path . 'Views');
            //            }

            //            // Load migrations
            //            if (is_dir($path.'database/migrations')) {
            //                $this->loadMigrationsFrom($path.'database/migrations');
            //            }
            //
            //            // Load seeder
            //            if (is_dir($path.'database/seeders')) {
            //                $this->loadMigrationsFrom($path.'database/seeders');
            //            }
            //
            //            // Load translations
            //            if (is_dir($path.'lang')) {
            //                $this->loadTranslationsFrom($path.'lang', $namespace.'lang');
            //            }

            //            dd($path);
            //            dd($namespace.'Controllers');
            // Load controllers
            //            if (is_dir($path . 'Controllers')) {
            ////                $this->app->make($namespace . 'Controllers')->hintPath($path . 'Controllers');
            //                $this->app->make($namespace . 'Controllers');
            //            }
        }
    }
}
