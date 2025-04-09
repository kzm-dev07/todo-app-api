<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories;

use Illuminate\Support\Facades\Http;
use KzmTodoApp\Domain\Exceptions\RestException;
use KzmTodoApp\Domain\Repositories\OidcProviderRepository;

class RestOidcProviderRepository implements OidcProviderRepository
{
    private string $jwksUrl;

    public function __construct()
    {
        $this->jwksUrl = config('oidc.jwks_url');
    }
    public function getJwks(): string
    {
        try {
            $response = Http::get($this->jwksUrl);
            return $response->body();
        } catch (RestException $e) {
            throw new RestException("Unable to get jwks from Keycloak.");
        }
    }
}
