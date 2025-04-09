<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\UseCases;

use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Exceptions\NotFoundException;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Trait\TokenTrait;

class UpdateTask
{
    use TokenTrait;

    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly WorkerRepository $workerRepository,
    ) {}

    public function __invoke(
        Key $taskKey,
        string $title,
        bool $isDone,
    ) {

        $worker = $this->workerRepository->getWorker($this->token()->sub);

        $task = $this->taskRepository->getTask($taskKey);

        if ($task === null) {
            throw new NotFoundException('Task is not Found.');
        }
        $updatedTask = $task->update($worker->getKey(), $title, $isDone);

        $this->taskRepository->save($updatedTask);
    }
}
