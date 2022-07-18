<?php

declare(strict_types = 1);

namespace Ceiboo\Shared\Infrastructure\Doctrine;

use Ceiboo\Shared\Infrastructure\Doctrine\Dbal\DbalCustomTypesRegister;
use Ceiboo\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Tools\Setup;

final class DoctrineEntityManagerFactory
{
    private static $sharedPrefixes = [
        __DIR__ . '/../../../Shared/Infrastructure/Mappings' => 'Ceiboo\Shared\Domain\Entities'
    ];

    public static function create(
        array $parameters,
        array $contextPrefixes,
        bool $isDevMode,
        array $dbalCustomTypesClasses
    ): EntityManagerInterface {

        DbalCustomTypesRegister::register($dbalCustomTypesClasses);

        return EntityManager::create($parameters, self::createConfiguration($contextPrefixes, $isDevMode));
    }

    private static function createConfiguration(array $contextPrefixes, bool $isDevMode): Configuration
    {
        $config = Setup::createConfiguration($isDevMode, null, null); //new ArrayCache());

        $config->setMetadataDriverImpl(new SimplifiedXmlDriver(array_merge(self::$sharedPrefixes, $contextPrefixes)));

        return $config;
    }
}
