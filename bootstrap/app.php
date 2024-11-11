<?php

use App\Http\Middleware\AdminOnlyMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();

        $middleware->alias([
            'admin-only' => AdminOnlyMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $exception) {
            $exception_msg = $exception->getMessage();

            if ($exception_msg == 'CSRF token mismatch.') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'CSRF token mismatch',
                ], 419);
            }
        });

        $exceptions->render(function (NotFoundHttpException $exception) {
            $exception_msg = $exception->getMessage();

            if (str_contains($exception_msg, 'No query results')) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Resource not found'
                ], 404);
            }

            if (str_contains($exception_msg, 'The route')) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Route not found'
                ], 404);
            }
        });

        $exceptions->render(function (AuthenticationException $exception) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthenticated'
            ], 401);
        });
    })->create();
