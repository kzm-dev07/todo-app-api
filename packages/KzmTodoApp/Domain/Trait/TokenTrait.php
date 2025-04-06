<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Trait;

use KzmTodoApp\Domain\Common\JwtToken;
use stdClass;

/**
 * @phpstan-import-type JwtToken from \KzmTodoApp\Domain\Common\JwtToken
 */
trait TokenTrait
{
    /**
     * @return JwtToken
     */
    public function token(): stdClass
    {
        return JwtToken::getInstance()->decode();
    }
}
