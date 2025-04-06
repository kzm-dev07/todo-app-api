<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Worker;

use KzmTodoApp\Domain\Common\Key;

class Worker
{
    public function __construct(
        private readonly Key $key,
        private readonly string $sub,
    ) {}

    /**
     * Get the value of key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the value of sub
     */
    public function getSub()
    {
        return $this->sub;
    }
}
