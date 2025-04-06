<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Common;

use App\Facades\KeyGeneratorFacade;
use Symfony\Component\Uid\Ulid;

class Key
{
    private Ulid $key;

    public function __construct(string $key)
    {
        $this->key = new Ulid($key);
    }

    public static function generate(): self
    {
        return new self(KeyGeneratorFacade::generate()->toString());
    }

    /**
     * Get the value of key
     */
    public function toString(): string
    {
        return $this->key->toString();
    }
}
