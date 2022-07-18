<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Api\Mid10\Command\Status;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ceiboo\Apps\Api\Mid10\Command\BaseCommand;

final class StatusCommand extends BaseCommand
{
    protected static $defaultName = 'status';
    private $searcher;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(new JsonResponse(
            [
                'command api middleware 1.0' => 'ok'
            ]
        ));
    }
}
