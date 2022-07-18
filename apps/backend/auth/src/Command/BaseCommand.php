<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

class BaseCommand extends Command
{
    protected static $defaultName = '';

    protected function configure()
    {
        $this->addOption('app', null, InputOption::VALUE_REQUIRED, '', 1);
    }

}
