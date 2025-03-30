<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

interface OidcProviderRepository
{
    public function getJwks(): string;
}
