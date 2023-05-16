<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CheckLocale
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session()->get('locale', config('app.fallback_locale'));
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return $next($request);
    }
}
