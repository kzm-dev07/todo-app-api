<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

use KzmTodoApp\Domain\Task\Task;

interface TaskRepository
{
    /**
     * タスクを保存する
     *
     * @param Task $task
     * @return void
     */
    public function save(Task $task): void;
}
