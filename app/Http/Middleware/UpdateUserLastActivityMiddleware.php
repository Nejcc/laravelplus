<?php

namespace App\Http\Middleware;

use App\Enums\User\UserStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class UpdateUserLastActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (auth()->check()) {
            $test = auth()->user()->update([
                'status'           => UserStatusEnum::ONLINE,
                'last_activity_at' => now()
            ]);
        }

        return $next($request);
    }
}
