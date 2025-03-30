<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->header('Request-Id', uniqid('req-'));
        $sessionId = uniqid();

        Log::debug('BEGIN ' . 'requestId: ' . $requestId . ' resource: ' . $request->method() . ':' . $request->path(), [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'sessionId' => $sessionId,
        ]);

        $response = $next($request);

        $body = [];
        if (get_class($response) === JsonResponse::class) {
            /** @var JsonResponse $response */
            $body = $response->getData(true);
        } {
            $body = $response->getContent();
        }

        Log::debug('END ' . 'requestId: ' . $requestId . ' resource: ' . $request->method() . ':' . $request->path(), [
            'status' => $response->getStatusCode(),
            'headers' => $response->headers->all(),
            'body' => $body,
            'sessionId' => $sessionId,
        ]);

        return $response;
    }
}
