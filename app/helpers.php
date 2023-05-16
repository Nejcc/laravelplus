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
