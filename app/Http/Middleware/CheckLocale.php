<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class CheckLocale
{
    /**
     * @param Request $request
     * @param Closure $next
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
