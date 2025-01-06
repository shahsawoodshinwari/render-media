<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ApiKey;
use Illuminate\Foundation\Application;
use App\Http\Middleware\AlwaysAcceptJson;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
      AlwaysAcceptJson::class,
      ApiKey::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (NotFoundHttpException $e, Request $request) {
      if ($request->is('api/*')) {
        return response()->json([
          'message' => 'Page not found.',
        ], 404);
      }
    });
  })->create();
