<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnauthorizedException extends Exception
{
    /**
     * 例外をHTTPレスポンスへレンダする
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], Response::HTTP_UNAUTHORIZED, [], JSON_UNESCAPED_UNICODE);
    }
}
