<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Get all available locales with their names.
     */
    public static function getAllLocales(): array
    {
        $locales = [];
        $availableLocales = config('app.available_locales', ['en']);

        foreach ($availableLocales as $locale) {
            $locales[] = [
                'slug' => $locale,
                'name' => self::getLocaleName($locale),
                'native' => self::getLocaleNativeName($locale),
                'flag' => self::getLocaleFlag($locale),
            ];
        }

        return $locales;
    }

    /**
     * Get the display name of a locale.
     */
    public static function getLocaleName(string $locale): string
    {
        return match ($locale) {
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'de' => 'German',
            'it' => 'Italian',
            'pt' => 'Portuguese',
            'ru' => 'Russian',
            'ja' => 'Japanese',
            'zh' => 'Chinese',
            'ar' => 'Arabic',
            default => ucfirst($locale),
        };
    }

    /**
     * Get the native name of a locale.
     */
    public static function getLocaleNativeName(string $locale): string
    {
        return match ($locale) {
            'en' => 'English',
            'es' => 'Español',
            'fr' => 'Français',
            'de' => 'Deutsch',
            'it' => 'Italiano',
            'pt' => 'Português',
            'ru' => 'Русский',
            'ja' => '日本語',
            'zh' => '中文',
            'ar' => 'العربية',
            default => ucfirst($locale),
        };
    }

    /**
     * Get the flag emoji for a locale.
     */
    public static function getLocaleFlag(string $locale): string
    {
        return match ($locale) {
            'en' => '🇬🇧',
            'es' => '🇪🇸',
            'fr' => '🇫🇷',
            'de' => '🇩🇪',
            'it' => '🇮🇹',
            'pt' => '🇵🇹',
            'ru' => '🇷🇺',
            'ja' => '🇯🇵',
            'zh' => '🇨🇳',
            'ar' => '🇸🇦',
            default => '🌐',
        };
    }
} 