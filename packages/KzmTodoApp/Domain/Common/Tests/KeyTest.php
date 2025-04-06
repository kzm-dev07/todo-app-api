<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Common\Tests;

use App\Facades\KeyGeneratorFacade;
use KzmTodoApp\Domain\Common\Key;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Uid\Ulid;
use Tests\TestCase;

class KeyTest extends TestCase
{

    #[Test]
    public function test_generate(): void
    {
        setup:
        $keyStr = '01ARZ3NDEKTSV4RRFFQ69G5FAV';
        KeyGeneratorFacade::shouldReceive('generate')
            ->once()
            ->andReturn(new Ulid($keyStr));

        when:
        $actual = Key::generate();

        then:
        $this->assertEquals($keyStr, $actual->toString());
    }

    #[Test]
    public function test_toString(): void
    {
        setup:
        $keyStr = '01ARZ3NDEKTSV4RRFFQ69G5FAV';

        when:
        $actual = new Key($keyStr);

        then:
        $this->assertEquals($keyStr, $actual->toString());
    }
}
