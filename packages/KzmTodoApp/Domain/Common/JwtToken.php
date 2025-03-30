<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Common;

use Exception;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use KzmTodoApp\Domain\Repositories\OidcProviderRepository;
use stdClass;

class JwtToken
{
    private static self|null $instance = null;
    private string $token;
    private array $jwks;

    private function __construct(
        Request $request,
        OidcProviderRepository $oidcProviderRepository
    ) {
        $this->token = $request->bearerToken();

        $jwksJson = $oidcProviderRepository->getJwks();
        $this->jwks = JWK::parseKeySet(json_decode($jwksJson, true));
    }

    public function decode(): stdClass
    {
        try {
            $decoded = JWT::decode($this->token, $this->jwks);
            return $decoded;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = app(self::class);
        }
        return self::$instance;
    }
}
