<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Worker\Worker;
use KzmTodoApp\Infrastructure\Eloquents\EloquentWorker;

class EloquentWorkerRepository implements WorkerRepository
{
    public function getWorker(string $sub): Worker
    {
        $eloquentWorker =  EloquentWorker::whereSub($sub)->first();

        if ($eloquentWorker === null) {
            throw new Exception('Worker is not Found.');
        }

        return $eloquentWorker->toDomain();
    }

    public function saveWorker(string $sub): Worker
    {
        $eloquentWorker = new EloquentWorker();
        $eloquentWorker->sub = $sub;
        try {
            DB::beginTransaction();
            $eloquentWorker->save();
            DB::commit();
            return $eloquentWorker->toDomain();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
