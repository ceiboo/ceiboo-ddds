<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Application;
use Ceiboo\Shared\Domain\Services\MigrationInterfaceServices;
use phpDocumentor\Reflection\Types\Boolean;

final class Migrator {

    private $migrationServices;

    public function __construct(MigrationInterfaceServices $migrationServices)
    {
        $this->migrationServices = $migrationServices;
    }

    public function createTables(string $migrationsFolder, bool $seed)
    {
        return $this->migrationServices->createTables($migrationsFolder, $seed);

    }
}
