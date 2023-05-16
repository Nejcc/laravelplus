<?php

if ( ! function_exists('getAllLocales')) {
    /**
     * @return array
     */
    function getAllLocales(): array
    {
        return \App\Helpers\Utilities\GetLocales::all();
    }
}

if ( ! function_exists('getLocaleByName')) {
    /**
     * @return array
     */
    function getLocaleByName(string $name): array
    {
        return \App\Helpers\Utilities\GetLocales::get($name);
    }
}