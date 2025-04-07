<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\UseCases;

use Illuminate\Support\Collection;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Trait\TokenTrait;

class GetTasks
{
    use TokenTrait;

    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly WorkerRepository $workerRepository,
    ) {}

    /**
     * @return Collection<Task>
     */
    public function __invoke()
    {

        $worker = $this->workerRepository->getWorker($this->token()->sub);

        return $this->taskRepository->getTasks($worker);
    }
}
