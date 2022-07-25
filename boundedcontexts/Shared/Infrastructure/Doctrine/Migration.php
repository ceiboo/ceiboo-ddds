<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Infrastructure\Doctrine;

use Ceiboo\Shared\Domain\Services\MigrationInterfaceServices;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\MySqlSchemaManager;
use Ceiboo\Shared\Domain\Utils;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;

final class Migration implements MigrationInterfaceServices
{
    private static $boundedContextPath;

    public function createTables(string $migrationsFolder, bool $seed): array
    {
        $responseText = '';
        self::$boundedContextPath=$_ENV['BASE_PATH']. '/boundedcontexts/' ;

        $connectionParams = [
            'dbname' => $_ENV['DATABASE_NAME'],
            'user' => $_ENV['DATABASE_ROOTUSER'],
            'password' => $_ENV['DATABASE_ROOTPASSWORD'],
            'host' => $_ENV['DATABASE_HOST'],
            'driver' => $_ENV['DATABASE_DRIVER'],
        ];

        $migrations=$migrationsFolder."Migrations";

        $migrationsFilesSQL=self::searchFilesSQL($migrations);

        map(static function($file) use($connectionParams) {
            static::executeSQLFromSQLFile($connectionParams, $file);
        }, $migrationsFilesSQL);

        $responseText = 'created ok';

        if($seed) {
            $seeders=$migrationsFolder."Seeders";

            $seedersFilesSQL=self::searchFilesSQL($seeders);

            map(static function($file) use($connectionParams) {
                static::executeSQLFromSQLFile($connectionParams, $file);
            }, $seedersFilesSQL);
            $responseText .=', seeders ok';
        }


            return [
                    'migate backend auth tables' => $responseText
                ];

    }

    private static function executeSQLFromSQLFile($connectionParams, $file)
    {
        $databaseName = $connectionParams['dbname'];
        $connection   = DriverManager::getConnection($connectionParams);
        $schemaManager= new MySqlSchemaManager($connection);

        if (self::databaseExists($databaseName, $schemaManager)) {
            //$connection->exec(sprintf('USE %s', $databaseName));
            $connection->exec(file_get_contents(realpath($file)));
        }

        $connection->close();
    }

    private static function searchFilesSQL(string $migrationPath): array
    {
        $realpath=self::$boundedContextPath . $migrationPath. '/';
        $possibleFiles = filter(
            static function ($file) {
                return Utils::endsWith('.sql', $file);
            },
            scandir($realpath)
        );
        return map(static function($file) use($realpath) {
            return $realpath . $file;
        },
        $possibleFiles);
    }

    private static function databaseExists($databaseName, MySqlSchemaManager $schemaManager): bool
    {
        return in_array($databaseName, $schemaManager->listDatabases(), true);
    }
}
