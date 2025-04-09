<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

use Illuminate\Support\Collection;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Exceptions\NoContentsException;
use KzmTodoApp\Domain\Task\Task;
use KzmTodoApp\Domain\Worker\Worker;

interface TaskRepository
{
    /**
     * タスク一覧を取得する
     *
     * @param Worker $worker
     * @return Collection<Task>
     * @throws NoContentsException
     */
    public function getTasks(Worker $worker): Collection;
    /**
     * タスクを保存する
     *
     * @param Task $task
     * @return void
     */
    public function save(Task $task): void;

    /**
     * タスクを削除する
     *
     * @param Key $key
     * @return void
     */
    public function delete(Key $key): void;
}
