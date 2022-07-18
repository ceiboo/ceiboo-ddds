<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Domain\ValueObjects;


use Ceiboo\Shared\Domain\ValueObjects\StringValueObject;

final class CompanyAddress extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
