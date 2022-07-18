<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Domain;

interface RandomNumberGenerator
{
    public function generate(): int;
}
