<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Repositories\Test;

use KzmTodoApp\Domain\Exceptions\NotFoundException;
use KzmTodoApp\Domain\Worker\Worker;
use KzmTodoApp\Infrastructure\Eloquents\EloquentWorker;
use KzmTodoApp\Infrastructure\Repositories\EloquentWorkerRepository;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class EloquentWorkerRepositoryTest extends TestCase
{


    #[Test]
    public function getWorker()
    {
        setup:
        $sub = Uuid::uuid4()->toString();
        $eloquentWorker = EloquentWorker::factory()->create([
            'sub' => $sub
        ]);

        $expect = new Worker($eloquentWorker->worker_id, $sub);

        when:
        $eloquentWorkerRepository = $this->createInstance();
        $actual = $eloquentWorkerRepository->getWorker($sub);

        then:
        $this->assertEquals($expect, $actual);
    }

    #[Test]
    public function getWorker_not_found()
    {
        setup:
        $sub = Uuid::uuid4()->toString();

        expect:
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Worker is not Found.');

        then:
        $eloquentWorkerRepository = $this->createInstance();
        $actual = $eloquentWorkerRepository->getWorker($sub);
    }

    #[Test]
    public function registerWorker()
    {
        setup:
        $sub = Uuid::uuid4()->toString();

        $expect = new Worker(Uuid::uuid4()->toString(), $sub);

        when:
        $eloquentWorkerRepository = $this->createInstance();
        $actual = $eloquentWorkerRepository->registerWorker($sub);

        then:
        $this->assertEquals($expect->getSub(), $actual->getSub());
    }

    private function createInstance(): EloquentWorkerRepository
    {
        return app(EloquentWorkerRepository::class);
    }
}
