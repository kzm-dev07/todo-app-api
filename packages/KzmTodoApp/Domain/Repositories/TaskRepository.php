<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

use KzmTodoApp\Domain\Task\Task;

interface TaskRepository
{
    public function save(Task $task): void;
}
