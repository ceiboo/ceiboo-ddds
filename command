#!/usr/bin/env php
<?php

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;

if (false === in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
    echo 'Warning: The console should be invoked via the CLI version of PHP, not the '.\PHP_SAPI.' SAPI'.\PHP_EOL;
}

set_time_limit(0);

require dirname(__FILE__).'/vendor/autoload.php';

if (!class_exists(Application::class)) {
    throw new RuntimeException('You need to add "symfony/framework-bundle" as a Composer dependency.');
}

$input = new ArgvInput();
if (null !== $env = $input->getParameterOption(['--env', '-e'], null, true)) {
    putenv('APP_ENV='.$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = $env);
}

if (null == $input->getParameterOption(['--app', '-app'], null, true)) {
    throw new RuntimeException('Debes agregar la aplicación "ej: -app=backend/auth ó -app=api/mid10"');
}

$appParameterOption=$input->getParameterOption(['--app', '-app'], null, true);
$appParameterOption=substr($appParameterOption,0,1)=='='?substr($appParameterOption,1):$appParameterOption;

if ($input->hasParameterOption('--no-debug', true)) {
    putenv('APP_DEBUG='.$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = '0');
}

if (isset($_SERVER['APP_DEBUG'])) {
    umask(0000);

    if (class_exists(Debug::class)) {
        Debug::enable();
    }
}

$arg=explode(':',$input->getFirstArgument());
$app=explode('/',$appParameterOption);

if(count($app)<2) {
    throw new RuntimeException('Falta la carpeta donde se encuentra la aplicacion: "ej: -app=backend/auth ó -app=api/mid10" en '.$appParameterOption);
}
$folderApp=trim(strtolower($app[0]));
$commandApp=trim(strtolower($app[1]));
$kernelName='Ceiboo\\Apps\\'.ucfirst($folderApp).'\\'.ucfirst($commandApp).'\\'.ucfirst($folderApp).ucfirst($commandApp).'Kernel';

require dirname(__FILE__) . '/apps/'.$folderApp.'/'.$commandApp.'/bootstrap.php';
$kernel = new $kernelName($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);

//dd($input->tokens[0]); die();
$application = new Application($kernel);
$application->run($input);
