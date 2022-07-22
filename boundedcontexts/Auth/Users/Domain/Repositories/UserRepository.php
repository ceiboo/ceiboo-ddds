<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Domain\Repositories;

use Ceiboo\Auth\Users\Domain\Entities\User;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserId;

interface UserRepository
{
    public function save(User $user): void;

    public function search(UserId $id): ?User;
}
