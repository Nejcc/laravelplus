<?php

declare(strict_types=1);

namespace App\Plugins;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PluginController extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
