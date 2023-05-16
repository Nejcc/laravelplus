<?php

namespace App\Helpers\Utilities;

final class GetLocales
{
    public static function all(): array
    {
        return config('app.available_locales');
    }

    public static function get($name): array
    {
        return in_array($name, config('app.available_locales'), true);
    }
}
