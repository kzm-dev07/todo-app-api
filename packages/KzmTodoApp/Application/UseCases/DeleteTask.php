<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\UseCases;

use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Trait\TokenTrait;

class DeleteTask
{
    use TokenTrait;

    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly WorkerRepository $workerRepository,
    ) {}

    public function __invoke(
        Key $key
    ): void {
        $this->taskRepository->delete($key);
    }
}
