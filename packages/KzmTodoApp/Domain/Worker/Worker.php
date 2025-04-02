<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Worker;

class Worker
{
    public function __construct(
        private readonly string $workerId,
        private readonly string $sub,
    ) {}

    /**
     * Get the value of workerId
     */
    public function getWorkerId()
    {
        return $this->workerId;
    }

    /**
     * Get the value of sub
     */
    public function getSub()
    {
        return $this->sub;
    }
}
