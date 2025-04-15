<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

final class LocaleController extends Controller
{
    /**
     * Set the application locale.
     */
    public function __invoke(string $locale): RedirectResponse
    {
        $availableLocales = config('app.available_locales', ['en']);
        if (!is_array($availableLocales)) {
            $availableLocales = ['en'];
        }

        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.fallback_locale', 'en');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        // Load translations for the new locale
        $translations = [];
        $translationPath = resource_path('js/translations/' . $locale . '.json');
        if (File::exists($translationPath)) {
            $translations = json_decode(File::get($translationPath), true);
        }

        Session::put('translations', $translations);

        return back();
    }
}
