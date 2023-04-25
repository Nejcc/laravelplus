<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class CreatePluginCommand extends Command
{
    protected $signature = 'make:plugin {name}';

    protected $description = 'Create a new Laravel plugin';

    public function handle()
    {
        $pluginName = $this->argument('name');
        $pluginClassName = Str::studly($pluginName);
        $pluginNamespace = 'App\\Plugins\\' . $pluginClassName . '\\';
        $pluginPath = app_path('Plugins/' . ucfirst($pluginClassName) . '/');

        // Check if plugin class already exists
        if (class_exists($pluginNamespace . $pluginClassName)) {
            $this->error('Plugin class already exists.');
            return;
        }

        $this->createPluginDirectories();
        $this->createPluginFiles($pluginName, $pluginClassName, $pluginNamespace);

        $this->info($pluginClassName . ' plugin created successfully.');
    }

    protected function createPluginDirectories()
    {
        $directories = [
            app_path('Plugins'),
//            app_path('Plugins/.gitignore')
        ];

        foreach ($directories as $directory) {

            if (! File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
        }
    }

    protected function createPluginFiles($name, $className, $namespace)
    {
        $files = [
            'config',
            'Controllers/Controller',
            'Models/Model',
            'routes',
            'views/index',
        ];

        foreach ($files as $file) {
            $this->createPluginFile($name, $className, $namespace, $file);
        }
    }

    protected function createPluginFile($name, $className, $namespace, $file)
    {
        $pluginPath = app_path('Plugins/' . ucfirst($className) . '/');
        $path = $pluginPath . Str::replaceArray('/', ['\\', ''], $file) . '.php';

        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        $stub = File::get(resource_path('stubs/plugin/' . $file . '.stub'));

        $content = str_replace(
            ['{{className}}', '{{namespace}}', '{{pluginName}}'],
            [$className, $namespace, $name],
            $stub
        );

        File::put($path, $content);
    }
}