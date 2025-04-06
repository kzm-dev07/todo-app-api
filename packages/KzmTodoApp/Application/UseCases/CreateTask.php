<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\UseCases;

use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Task\Task;
use KzmTodoApp\Domain\Trait\TokenTrait;

class CreateTask
{
    use TokenTrait;

    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly WorkerRepository $workerRepository,
    ) {}

    public function __invoke(
        string $title,
        bool $isDone,
    ) {

        $worker = $this->workerRepository->getWorker($this->token()->sub);

        $task = new Task(
            Key::generate(),
            $worker->getKey(),
            $title,
            $isDone,
        );

        $this->taskRepository->save($task);
    }
}
