<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Infrastructure\Doctrine;

use Ceiboo\Shared\Domain\Utils;
use Ceiboo\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\MySqlSchemaManager;
use RuntimeException;
use function Lambdish\Phunctional\dissoc;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;

final class CeibooEntityManagerFactory
{

    private static $boundedContextPath;

    public static function create(array $parameters, string $migrations, array $mappings, array $dbalCustomTypesClasses): EntityManagerInterface
    {
        self::$boundedContextPath=$_ENV['BASE_PATH']. '/boundedcontexts/' ;

        $isDevMode = 'prod' === $_ENV['APP_ENV'];

        $migrationsFilesSQL=self::migrationsSearchFilesSQL($migrations);

        if ($isDevMode) {
            map(static function($file) use($parameters) {
                static::generateDatabaseIfNotExists($parameters, $file);
            }, $migrationsFilesSQL);
        }

        $mappingsArray=self::mappingsCreateArray($mappings);

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $mappingsArray,
            $isDevMode,
            $dbalCustomTypesClasses
        );
    }
    private static function mappingsCreateArray(array $mappings): array
    {
        $resultMap = [];
        map(static function($mapItem) use(&$resultMap) {
            $explodeMapItem=explode(':',$mapItem);
            $resultMap[self::$boundedContextPath . $explodeMapItem[0]]=$explodeMapItem[1];
        },
        $mappings);
        return $resultMap;
    }

    private static function migrationsSearchFilesSQL(string $migrationPath): array
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

    private static function generateDatabaseIfNotExists(array $parameters, string $schemaFile): void
    {
        self::ensureSchemaFileExists($schemaFile);

        $databaseName                  = $parameters['dbname'];
        $parametersWithoutDatabaseName = dissoc($parameters, 'dbname');
        $connection                    = DriverManager::getConnection($parametersWithoutDatabaseName);
        $schemaManager                 = new MySqlSchemaManager($connection);

        if (!self::databaseExists($databaseName, $schemaManager)) {
            $schemaManager->createDatabase($databaseName);
            $connection->exec(sprintf('USE %s', $databaseName));
            $connection->exec(file_get_contents(realpath($schemaFile)));
        }

        $connection->close();
    }

    private static function databaseExists($databaseName, MySqlSchemaManager $schemaManager): bool
    {
        return in_array($databaseName, $schemaManager->listDatabases(), true);
    }

    private static function ensureSchemaFileExists(string $schemaFile): void
    {
        if (!file_exists($schemaFile)) {
            throw new RuntimeException(sprintf('The file <%s> does not exist', $schemaFile));
        }
    }

}
