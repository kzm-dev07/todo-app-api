<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Repositories;

use KzmTodoApp\Domain\Worker\Worker;

interface WorkerRepository
{
    public function getWorker(): Worker;

    public function saveWorker(): Worker;
}
