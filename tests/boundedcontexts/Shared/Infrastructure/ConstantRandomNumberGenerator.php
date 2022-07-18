<?php

declare(strict_types = 1);

namespace Ceiboo\Tests\Shared\Infrastructure;

use Ceiboo\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
    public function generate(): int
    {
        return 1;
    }
}
