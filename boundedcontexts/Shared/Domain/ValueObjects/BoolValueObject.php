<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Domain\ValueObjects;

abstract class BoolValueObject
{
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }
}
