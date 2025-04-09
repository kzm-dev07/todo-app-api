<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories\Tests;

use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Task\Task;
use KzmTodoApp\Domain\Worker\Worker;
use KzmTodoApp\Infrastructure\Eloquents\EloquentTask;
use KzmTodoApp\Infrastructure\Eloquents\EloquentWorker;
use KzmTodoApp\Infrastructure\Repositories\EloquentTaskRepository;
use Ramsey\Uuid\Uuid;

class EloquentTaskRepositoryTest extends TestCase
{


    #[Test]
    public function test_getTasks()
    {
        setup:
        $sub_1 = Uuid::uuid4()->toString();
        $sub_2 = Uuid::uuid4()->toString();
        $workerKey_1 = Key::generate();
        $workerKey_2 = Key::generate();
        EloquentWorker::factory()->create([
            'key' => $workerKey_1->toString(),
            'sub' => $sub_1,
        ]);
        EloquentWorker::factory()->create([
            'key' => $workerKey_2->toString(),
            'sub' => $sub_2,
        ]);
        $worker = new Worker($workerKey_1, $sub_1);

        $eloquentTask_1 = EloquentTask::factory()->create(['worker_key' => $workerKey_1->toString()]);
        $eloquentTask_2 = EloquentTask::factory()->create(['worker_key' => $workerKey_2->toString()]);
        $eloquentTask_3 = EloquentTask::factory()->create(['worker_key' => $workerKey_1->toString()]);

        // 対象作業所に紐づくタスクのみ取得できていること
        $expect = new Collection([$eloquentTask_1->toDomain(), $eloquentTask_3->toDomain()]);

        when:
        $eloquentTaskRepository = $this->createInstance();
        $actual = $eloquentTaskRepository->getTasks($worker);

        then:
        $this->assertEqualsCanonicalizing($expect, $actual);
    }

    #[Test]
    public function test_save()
    {
        setup:
        $sub = Uuid::uuid4()->toString();
        $workerKey = Key::generate();
        $keyTask = Key::generate();
        EloquentWorker::factory()->create([
            'key' => $workerKey->toString(),
            'sub' => $sub,
        ]);
        $task = new Task($keyTask, $workerKey, '', false);

        when:
        $eloquentTaskRepository = $this->createInstance();
        $eloquentTaskRepository->save($task);

        then:
        $this->assertDatabaseHas('tasks', [
            'key' => $task->getKey()->toString(),
            'worker_key' => $task->getWorkerKey()->toString(),
            'title' => $task->getTitle(),
            'isDone' => $task->isDone(),
        ]);
    }


    #[Test]
    public function test_delete()
    {
        setup:
        $sub = Uuid::uuid4()->toString();
        $workerKey = Key::generate();
        EloquentWorker::factory()->create([
            'key' => $workerKey->toString(),
            'sub' => $sub,
        ]);
        $worker = new Worker($workerKey, $sub);

        $eloquentTask = EloquentTask::factory()->create(['worker_key' => $workerKey->toString()]);
        $key = new Key($eloquentTask->key);

        when:
        $eloquentTaskRepository = $this->createInstance();
        $actual = $eloquentTaskRepository->delete($key);

        then:
        $this->assertDatabaseMissing('tasks', ['key' => $key->toString()]);
    }

    private function createInstance(): EloquentTaskRepository
    {
        return app(EloquentTaskRepository::class);
    }
}
