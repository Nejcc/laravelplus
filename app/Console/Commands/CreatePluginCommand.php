<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreatePluginCommand extends Command
{
    protected $signature = 'plugin:create {name}';

    protected $description = 'Create a new plugin';

    public function handle()
    {
        $name = $this->argument('name');

        $this->createPluginDirectory($name);
        $this->createPluginFiles($name);
    }

    protected function createPluginDirectory($name)
    {
        $directory = app_path('Plugins/' . ucfirst($name));

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    protected function createPluginFiles($name)
    {
        $namespace = 'App\\Plugins\\' . ucfirst($name);

        $this->call('make:controller', [
            'name'   => $namespace . '\\Controllers\\HomeController',
            '--stub' => 'controller.stub',
        ]);
        $this->call('make:model', [
            'name'   => $namespace . '\\Models\\' . ucfirst($name),
            '--stub' => 'model.stub',
        ]);

        $this->call('make:middleware', [
            'name'   => $namespace . '\\Middleware\\' . ucfirst($name),
            '--stub' => 'middleware.stub',
        ]);

        $this->call('make:seeder', [
            'name'   => $namespace . '\\Database\\Seeders\\' . ucfirst($name) . 'Seeder',
            '--stub' => 'seeder.stub',
        ]);

        // Generate views
        $viewsDirectory = app_path('Plugins/' . ucfirst($name) . '/views/');
        if (!file_exists($viewsDirectory)) {
            mkdir($viewsDirectory, 0755, true);
        }
        file_put_contents($viewsDirectory . 'index.blade.php', '');

        // Generate routes
        $routesFile = app_path('Plugins/' . ucfirst($name) . '/routes/web.php');
        if (!file_exists($routesFile)) {
            file_put_contents($routesFile, "<?php\n\n");
        }

        $this->info('Plugin created successfully!');
    }
}


