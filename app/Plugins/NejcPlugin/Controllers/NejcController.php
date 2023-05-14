<?php

declare(strict_types=1);

namespace App\Plugins\NejcPlugin\Controllers;

use App\Plugins\PluginController;

final class NejcController extends PluginController
{
    public function index()
    {
        return view('nejcplugin::index');
    }
}
