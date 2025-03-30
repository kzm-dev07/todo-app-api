<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestException extends Exception
{
    /**
     * 例外をHTTPレスポンスへレンダする
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR, [], JSON_UNESCAPED_UNICODE);
    }
}
