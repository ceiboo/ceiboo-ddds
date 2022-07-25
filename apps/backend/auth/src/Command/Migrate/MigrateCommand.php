<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Command\Migrate;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Console\Input\InputOption;
use Ceiboo\Apps\Backend\Auth\Command\BaseCommand;
use Ceiboo\Shared\Application\Migrator;

final class MigrateCommand extends BaseCommand
{
    protected static $defaultName = 'migrate';

    private $migrator;

    public function __construct(Migrator $migrator)
    {
        parent::__construct();
        $this->migrator = $migrator;
    }

    protected function configure()
    {
        parent::configure();
        // agregar --seed para que agregue los seeders
        $this->addOption('seed', null, InputOption::VALUE_OPTIONAL, '', 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Si seed existe y no tiene valor (--seed) entonces devuelvo true, si no existe o le han agregado un valor, entonces devuelvo falso
        $seed = ($input->getOption('seed'))?false:true;

        $migrationsFolder='Auth/Shared/Infrastructure/';

        $response=$this->migrator->createTables($migrationsFolder, $seed);

        $output->writeln(new JsonResponse(
            $response
        ));
    }
}
