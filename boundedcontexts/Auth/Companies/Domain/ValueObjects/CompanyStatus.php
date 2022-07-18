<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Domain\ValueObjects;


use Ceiboo\Shared\Domain\ValueObjects\BoolValueObject;

final class CompanyStatus extends BoolValueObject
{
    public function __construct(string $value)
    {
        $value=$this->ensureValueIsBool($value);
        parent::__construct($value);
    }

    public function ensureValueIsBool($value) {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}

