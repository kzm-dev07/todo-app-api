<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use KzmTodoApp\Domain\Exceptions\NoContentsException;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Task\Task;
use KzmTodoApp\Domain\Worker\Worker;
use KzmTodoApp\Infrastructure\Eloquents\EloquentTask;

class EloquentTaskRepository implements TaskRepository
{

    /**
     * @inheritDoc
     */
    public function getTasks(Worker $worker): Collection
    {
        $eloquentTasks = EloquentTask::whereWorkerKey($worker->getKey()->toString())->get();

        if ($eloquentTasks->count() === 0) {
            throw new NoContentsException('No task exist.');
        }

        return $eloquentTasks->map(fn(EloquentTask $eloquentTask) => $eloquentTask->toDomain());
    }

    /**
     * @inheritDoc
     */
    public function save(Task $task): void
    {
        // INFO: whereKeyは既に予約メソッドである。primary keyで検索する模様
        // $eloquentTask = EloquentTask::whereKey($task->getKey()->toString())->firstOrNew();
        $eloquentTask = EloquentTask::where('key', $task->getKey()->toString())->firstOrNew();
        $eloquentTask->fromDomain($task);
        try {
            DB::beginTransaction();
            $eloquentTask->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
