<?php

declare(strict_types=1);

namespace App\Plugins\ExamplePlugin\Controllers;

use App\Plugins\PluginController;

final class ExampleController extends PluginController
{
    public function index()
    {
        return view('exampleplugin::index');
    }
}
