<?php

declare(strict_types=1);

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class CreatePluginCommand extends Command
{
    protected $signature = 'make:plugin {name}';

    protected $description = 'Create a new Laravel plugin';

    private array $pluginData = [];

    public function handle(): void
    {
        $pluginName = $this->argument('name');

        $this->getData($pluginName);

        $this->info('Create new plugin ['.$this->pluginData['class_name'].']');
        $this->info(' ');

        if ( ! File::isDirectory('Plugin')) {
            File::makeDirectory('Plugin', 0755, true);
        }

        // Check if plugin class already exists
        if (class_exists($this->pluginData['namespace'].$this->pluginData['class_name'])) {
            $this->error('Plugin '.$this->pluginData['class_name'].' class already exists.');

            return;
        }

        $this->createPluginDirectories();
        $this->createPluginFiles();

//        dd($this->pluginData);

        $this->info(' ');
        $this->info($this->pluginData['class_name'].' plugin created successfully.');
    }

    protected function createPluginDirectories(): void
    {
        foreach ($this->pluginData['dirs'] as $directory) {
            if ( ! File::isDirectory(ucfirst($this->pluginData['path'].$directory))) {
                File::makeDirectory($this->pluginData['path'].ucfirst($directory), 0755, true);
            }
        }
    }

    protected function createPluginFiles(): void
    {
//        dd($this->pluginData['files'], $this->pluginData['path']);
        foreach ($this->pluginData['files'] as $key => $file) {
            switch ($key) {
                case 'controller':
                    $filePath = $this->pluginData['path'];
                    $this->checkFilePath($filePath, $file);
                    $this->makeController($filePath, $file);
                    $this->info(' - Controller was created successfully');
                    break;
                case 'model':
//                    dd($filePath, $file);
                    $filePath = $this->pluginData['path'];
                    $this->checkFilePath($filePath, $file);
                    $this->makeModel($filePath, $file);
                    $this->info(' - Model was created successfully');
                    break;
                case 'routes':
                    foreach ($file as $route) {
                        $filePath = $this->pluginData['path'];
                        $this->checkFilePath($filePath, $route);
                        $this->makeRoute($filePath, $route);
                    }
                    $this->info(' - Routes was created successfully');
                    break;
                case 'views':
//                    dd($filePath, $file);
                    foreach ($file as $view) {
                        $filePath = $this->pluginData['path'];
                        $this->checkFilePath($filePath, $view);
                        $this->makeView($filePath, $view);
                    }
                    $this->info(' - Views was created successfully');
                    break;

                default:
//                    file_put_contents($this->pluginData['path'] . $file, $content);
                    break;
            }
        }
    }

    protected function createPluginFile($name, $className, $namespace, $file, $namespaceNoEnding): void
    {
        $pluginPath = app_path('Plugins/'.ucfirst($className).'/');
        $path = $pluginPath.Str::replaceArray('/', ['\\', ''], $file);

        if ( ! File::isDirectory($pluginPath)) {
            File::makeDirectory($pluginPath, 0755, true);
        }

        $stub = File::get(resource_path('stubs/plugin/'.$file.'.stub'));

        $content = str_replace(
            ['{{className}}', '{{namespace}}', '{{pluginName}}', '{{namespaceNoEnding}}'],
            [$className, $namespace, $name, $namespaceNoEnding],
            $stub
        );

        if ($file === 'config') {
            $filePath = $path.'/'.Str::kebab($className).'.php';
            if ( ! file_exists($filePath)) {
                if ( ! File::isDirectory($path)) {
                    File::makeDirectory($path, 0755, true);
                }
                file_put_contents($filePath, $content);
            }
        } elseif ($file === 'routes') {
            $filePath = $path.'/web.php';
            if ( ! file_exists($filePath)) {
                if ( ! File::isDirectory($path)) {
                    File::makeDirectory($path, 0755, true);
                }
                file_put_contents($filePath, $content);
            }
        }
    }

    private function getData(bool|array|string|null $pluginName): void
    {
        $pluginClassName = Str::studly($pluginName);

        $suffix = 'Plugin';

        $this->pluginData['plugin_name'] = $this->argument('name').'Plugin';
        $this->pluginData['class_name'] = $pluginClassName;
        $this->pluginData['namespace'] = 'App\\Plugins\\'.$pluginClassName.'Plugin';
        $this->pluginData['path'] = app_path('Plugins/'.ucfirst($pluginClassName).$suffix.'/');
        $this->pluginData['files'] = [
            'controller' => Str::studly($pluginName).'Controller.php',
            'model'      => Str::studly($pluginName).'.php',
            'routes'      => [
                'web' => 'web.php',
                'api' => 'api.php',
            ],
            'views'      => [
//                'index'  => Str::kebab($pluginName).DIRECTORY_SEPARATOR.'index.blade.php',
//                'show'   => Str::kebab($pluginName).DIRECTORY_SEPARATOR.'show.blade.php',
//                'create' => Str::kebab($pluginName).DIRECTORY_SEPARATOR.'create.blade.php',
//                'update' => Str::kebab($pluginName).DIRECTORY_SEPARATOR.'update.blade.php',
                'index'  => 'index.blade.php',
                'show'   => 'show.blade.php',
                'create' => 'create.blade.php',
                'update' => 'update.blade.php',
            ],
            'blade'      => [
                'index'  => Str::kebab($pluginName).'::'.'index',
                'show'   => Str::kebab($pluginName).'::'.'show',
                'create' => Str::kebab($pluginName).'::'.'create',
                'update' => Str::kebab($pluginName).'::'.'update',
            ],

        ];
        $this->pluginData['dirs'] = [
            'controllers',
            'models',
            'views',
            'routes',
        ];
    }

    private function checkFilePath($filePath, mixed $file): void
    {
        if (file_exists($filePath.$file)) {
            $this->info('File ['.$filePath.$file.'] already exists!');
        }
    }

    private function makeController(string $filePath, mixed $file): void
    {
        $full_file_path = $filePath.'Controllers/'.$file;

        if ( ! file_exists($full_file_path)) {
            if ( ! File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }

            $stub = File::get(resource_path('stubs/plugin/controller.stub'));

            $content = str_replace(
                ['{{className}}', '{{namespace}}', '{{pluginName}}', '{{viewPath}}', '{{viewNamespace}}'],
                [$this->pluginData['class_name'], $this->pluginData['namespace'], $this->pluginData['plugin_name'], $this->pluginData['files']['blade']['index'], strtolower($this->pluginData['plugin_name']).'::index'],
                $stub
            );

//array:4 [ // app\Console\Commands\CreatePluginCommand.php:203
//  0 => "Example"
//  1 => "App\Plugins\ExamplePlugin"
//  2 => "ExamplePlugin"
//  3 => "example::index"
//]


//            dd([$this->pluginData['class_name'], $this->pluginData['namespace'], $this->pluginData['plugin_name'], $this->pluginData['files']['blade']['index']]);

            file_put_contents($full_file_path, $content);
        }
    }

    private function makeModel(string $filePath, mixed $file): void
    {
        $full_file_path = $filePath.'Models/'.$file;

        if ( ! file_exists($full_file_path)) {
            if ( ! File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }

            $stub = File::get(resource_path('stubs/plugin/model.stub'));

            $content = str_replace(
                ['{{className}}', '{{namespace}}', '{{pluginName}}'],
                [$this->pluginData['class_name'], $this->pluginData['namespace'], $this->pluginData['plugin_name']],
                $stub
            );

            file_put_contents($full_file_path, $content);
        }
    }

    private function makeView(string $filePath, mixed $file): void
    {
//        "C:\wamp\www\laravelplus.com\app\Plugins/ExamplePlugin/" // app\Console\Commands\CreatePluginCommand.php:227
//"example\index.blade.php" // app\Console\Commands\CreatePluginCommand.php:227

//        dd($filePath, $file);
        $full_file_path = $filePath.'Views/'.$file;
//        dd($full_file_path);
//        $view_file_path = $filePath.'Views/'.mb_strtolower(Str::kebab($this->pluginData['class_name']));
        $view_file_path = $filePath.'Views/';

//        dd($full_file_path, $view_file_path);

        if ( ! file_exists($full_file_path)) {
            if ( ! File::isDirectory($view_file_path)) {
                File::makeDirectory($view_file_path, 0755, true);
            }

            $stub = File::get(resource_path('stubs/plugin/index.blade.stub'));

            $content = str_replace(
                ['{{className}}', '{{namespace}}', '{{pluginName}}'],
                [$this->pluginData['class_name'], $this->pluginData['namespace'], $this->pluginData['plugin_name']],
                $stub
            );

            file_put_contents($full_file_path, $content);
        }
    }

    private function makeRoute(string $filePath, mixed $file): void
    {
        $full_file_path = $filePath.'Routes/'.$file;
        $view_file_path = $filePath.'Routes/';
        $stub = str_replace('.php', '.stub', $file);

        if ( ! file_exists($full_file_path)) {
            if ( ! File::isDirectory($view_file_path)) {
                File::makeDirectory($view_file_path, 0755, true);
            }

            $stub = File::get(resource_path('stubs/plugin/'.$stub));

            $content = str_replace(
                ['{{className}}', '{{namespace}}', '{{pluginName}}','{{classNameLowercase}}'],
                [$this->pluginData['class_name'], $this->pluginData['namespace'], $this->pluginData['plugin_name'], strtolower($this->pluginData['class_name'])],
                $stub
            );

            file_put_contents($full_file_path, $content);
        }
    }
}
