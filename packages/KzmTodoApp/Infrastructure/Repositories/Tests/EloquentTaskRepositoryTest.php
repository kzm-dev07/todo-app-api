<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories\Tests;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Task\Task;
use KzmTodoApp\Infrastructure\Eloquents\EloquentWorker;
use KzmTodoApp\Infrastructure\Repositories\EloquentTaskRepository;
use Ramsey\Uuid\Uuid;

class EloquentTaskRepositoryTest extends TestCase
{


    #[Test]
    public function save()
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

    private function createInstance(): EloquentTaskRepository
    {
        return app(EloquentTaskRepository::class);
    }
}
