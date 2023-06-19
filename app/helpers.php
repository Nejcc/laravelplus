<?php

declare(strict_types=1);

if (!function_exists('getAllLocales')) {

    function getAllLocales(): array
    {
        return \App\Helpers\Utilities\GetLocales::all();
    }
}

if (!function_exists('getLocaleByName')) {

    function getLocaleByName(string $name): array
    {
        return \App\Helpers\Utilities\GetLocales::get($name);
    }
}


if (!function_exists('plugin_enabled')) {

    function plugin_enabled(string $name): bool
    {
        return config('plugins.'.$name.'.enabled');
    }
}
