<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\Responses;

use Illuminate\Support\Collection;
use KzmTodoApp\Domain\Task\Task;

class TasksResponse
{
    public array $tasks;

    private function __construct(array $tasks): void
    {
        $this->tasks = $tasks;
    }

    public static function fromDomain(Collection $tasks): self
    {
        $result = $tasks->map(function (Task $task) {
            return [
                'key' => $task->getKey()->toString(),
                'getTitle' => $task->getTitle(),
                'isDone' => $task->isDone(),
            ];
        })->toArray();

        return new self($result);
    }
}
