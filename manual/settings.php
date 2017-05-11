<?php

namespace Sphp\Config;

require_once('sphp/settings.php');

use Sphp\Config\ErrorHandling\ExceptionHandler;
use Sphp\Config\ErrorHandling\ExceptionLogger;
use Sphp\Config\ErrorHandling\ExceptionPrinter;

$handler = new ExceptionHandler();
// Attach an Exception Logger
$handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$handler->attach((new ExceptionPrinter())->showTrace());
$handler->start();

(new PHPConfig())
        ->setErrorReporting(E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setEncoding('UTF-8')
        ->init();
error_reporting(E_ALL);
require_once('doctrineConfiguration.php');
require_once('menuArrays.php');
