<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Worker;

class Worker
{
    public function __construct(
        private readonly string $key,
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
