<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Task\Tests;

use Exception;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Task\Task;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskTest extends TestCase
{

    #[Test]
    public function test_update()
    {
        setup:
        $taskKey = Key::generate();
        $workerKey = Key::generate();
        $task = new Task(
            $taskKey,
            $workerKey,
            'test title',
            false,
        );

        $title = 'new title';
        $isDone = true;

        $expect = new Task(
            $taskKey,
            $workerKey,
            $title,
            $isDone
        );

        when:
        $actual = $task->update($workerKey, $title, $isDone);

        then:
        $this->assertEquals($expect, $actual);
    }

    #[Test]
    public function test_update_case_exception()
    {
        setup:
        $taskKey = Key::generate();
        $workerKey = Key::generate();
        $otherWorkerKey = Key::generate();

        $task = new Task(
            $taskKey,
            $workerKey,
            'test title',
            false,
        );

        $title = 'new title';
        $isDone = true;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Worker key dose not match.');

        when:
        $task->update($otherWorkerKey, $title, $isDone);
    }
}
