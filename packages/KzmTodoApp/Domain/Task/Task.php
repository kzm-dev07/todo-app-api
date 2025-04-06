<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Task;

use KzmTodoApp\Domain\Common\Key;

class Task
{
    public function __construct(
        private readonly Key $key,
        private readonly Key $workerKey,
        private readonly string $title,
        private readonly bool $isDone,
    ) {}

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
