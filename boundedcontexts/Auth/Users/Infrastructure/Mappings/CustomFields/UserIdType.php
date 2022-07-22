<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Infrastructure\Mappings\CustomFields;

use Ceiboo\Auth\Users\Domain\ValueObjects\UserId;
use Ceiboo\Shared\Infrastructure\Doctrine\UuidType;

final class UserIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'user_id';
    }

    protected function typeClassName(): string
    {
        return UserId::class;
    }
}
