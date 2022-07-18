<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Infrastructure\Mappings\CustomFields;

use Ceiboo\Auth\Companies\Domain\ValueObjects\CountryId;
use Ceiboo\Shared\Infrastructure\Doctrine\UuidType;

final class CompanyIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'company_id';
    }

    protected function typeClassName(): string
    {
        return CountryId::class;
    }
}
