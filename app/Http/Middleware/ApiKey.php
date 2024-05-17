<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (!$request->hasHeader('X-API-KEY')) {
      return response()->json([
        'message' => 'Api key missing.',
      ], 401);
    }

    if ($request->header('X-API-KEY') !== config('app.api_key')) {
      return response()->json([
        'message' => 'Invalid api key.',
      ], 401);
    }

    return $next($request);
  }
}
