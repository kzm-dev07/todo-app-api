<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Task;

use Exception;
use KzmTodoApp\Domain\Common\Key;

class Task
{
    public function __construct(
        private readonly Key $key,
        private readonly Key $workerKey,
        private readonly string $title,
        private readonly bool $isDone,
    ) {}

    public function update(
        Key $workerKey,
        string $title,
        bool $isDone,
    ): self {
        if ($this->workerKey->toString() !== $workerKey->toString()) {
            throw new Exception("Worker key dose not match.");
        }

        return new self(
            $this->key,
            $this->workerKey,
            $title,
            $isDone
        );
    }
    /**
     * Get the value of key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the value of workerKey
     */
    public function getWorkerKey()
    {
        return $this->workerKey;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of isDone
     */
    public function isDone()
    {
        return $this->isDone;
    }
}
