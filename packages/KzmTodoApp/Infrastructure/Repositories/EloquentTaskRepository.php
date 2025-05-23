<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use KzmTodoApp\Domain\Common\Key;
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

        return $eloquentTasks->map(fn(EloquentTask $eloquentTask) => $eloquentTask->toDomain());
    }

    /**
     * @inheritDoc
     */
    public function getTask(Key $key): ?Task
    {
        $eloquentTask = EloquentTask::where('key', $key->toString())->first();

        return $eloquentTask !== null ? $eloquentTask->toDomain() : null;
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

    /**
     * @inheritDoc
     */
    public function delete(Key $key): void
    {
        $eloquentTask = EloquentTask::where('key', $key->toString())->first();
        if ($eloquentTask === null) {
            return;
        }
        try {
            DB::beginTransaction();
            $eloquentTask->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
