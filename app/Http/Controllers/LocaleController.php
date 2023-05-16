<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class LocaleController extends Controller
{
    public function __invoke($locale)
    {
        if ( ! in_array($locale, config('app.available_locales'))) {
            return redirect()->back();
        }

        app()->setLocale($locale);
        session()->put('locale', $locale);

        // Redirect back to the previous page or a specific route
        return redirect()->back()->with('locale', $locale);
    }
}
