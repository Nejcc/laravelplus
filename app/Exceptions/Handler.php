<?php

declare(strict_types=1);

namespace App\Exceptions;

use http\Client\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Events\TokenAuthenticated;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

final class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [

    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {

        // if your api client has the correct content-type this expectsJson()
        // should work. if not you may use $request->is('/api/*') to match the url.


        if($request->expectsJson())
        {

            if($e instanceof TokenAuthenticated) {

                return response()->json('Unauthorized', 403);

            }

        }

        return parent::render($request, $e);

    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function(TokenAuthenticated $e, $request){
            return response()->json(['error'=>'Invalid token ccc'],400);
        });

        $this->renderable(function(TokenInvalidException $e, $request){
            return response()->json(['error'=>'Invalid token ddd'],401);
        });

        $this->renderable(function (TokenExpiredException $e, $request) {
            return response()->json(['error'=>'Token has Expired'],401);
        });

        $this->renderable(function (JWTException $e, $request) {
            return response()->json(['error'=>'Token not parsed'],401);
        });

        $this->reportable(function (Throwable $e): void {
        });
    }
}
