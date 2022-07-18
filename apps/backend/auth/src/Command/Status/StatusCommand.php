<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Command\Status;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ceiboo\Apps\Backend\Auth\Command\BaseCommand;

final class StatusCommand extends BaseCommand
{
    protected static $defaultName = 'status';

    //protected function configure() { parent::configure(); }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(new JsonResponse(
            [
                'command backend auth' => 'ok'
            ]
        ));
    }
}
