<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

use KzmTodoApp\Domain\Worker\Worker;

interface WorkerRepository
{
    public function getWorker(string $sub): Worker;

    public function registerWorker(string $sub): Worker;
}
