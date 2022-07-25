<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Domain\Services;


interface MigrationInterfaceServices
{
    public function createTables(string $migrationsFolder, bool $seed): array;
}
