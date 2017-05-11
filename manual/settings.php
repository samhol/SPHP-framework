<?php

namespace Sphp\Config;

require_once('sphp/settings.php');

use Sphp\Config\ErrorHandling\ExceptionHandler;
use Sphp\Config\ErrorHandling\ExceptionLogger;
use Sphp\Config\ErrorHandling\ExceptionPrinter;

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$handler->attach((new ExceptionPrinter())->showTrace());
$handler->start();

$includePaths = [
    realpath(__DIR__ . '/../'),
    __DIR__,
    __DIR__ . '/examples',
    __DIR__ . '/pages'
];
(new PHPConfig())
        ->setErrorReporting(E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setEncoding('UTF-8')
        ->setIncludePaths($includePaths)
        ->init();
require_once('doctrineConfiguration.php');
//require_once('session.php');
require_once('menuArrays.php');
