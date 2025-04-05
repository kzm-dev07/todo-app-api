<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories\Test;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Str;
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
        $workerKey = Str::ulid()->toString();
        $keyTask = Str::ulid()->toString();
        $eloquentWorker = EloquentWorker::factory()->create([
            'key' => $workerKey,
            'sub' => $sub,
        ]);
        $task = new Task($keyTask, $workerKey, '', false);

        when:
        $eloquentTaskRepository = $this->createInstance();
        $actual = $eloquentTaskRepository->save($task);

        then:
        $this->assertDatabaseHas('tasks', [
            'key' => $task->getKey(),
            'worker_key' => $task->getWorkerKey(),
            'title' => $task->getTitle(),
            'isDone' => $task->isDone(),
        ]);
    }

    private function createInstance(): EloquentTaskRepository
    {
        return app(EloquentTaskRepository::class);
    }
}
