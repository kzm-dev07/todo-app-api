<?php

declare(strict_types=1);

namespace KzmTodoApp\Domain\Common;

use Symfony\Component\Uid\Ulid;
use Illuminate\Support\Str;

class KeyGenerator
{
    public function generate(): Ulid
    {
        return Str::ulid();
    }
}
