<?php

namespace Sphp\Core\Config;

require_once(__DIR__ . '/../sphp/settings.php');

//require_once 'doctrineConfiguration.php';

use Sphp\Core\Config\ErrorHandling\ExceptionHandler;
use Sphp\Core\Config\ErrorHandling\ExceptionLogger;
use Sphp\Core\Config\ErrorHandling\ExceptionPrinter;

$handler = new ExceptionHandler();
// Attach an Exception Logger
$handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$handler->attach((new ExceptionPrinter())->showTrace());

(new PHPConfig())
        ->setErrorReporting(E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setEncoding('UTF-8')
        ->setExceptionHandler($handler)
        ->init();

require_once('doctrineConfiguration.php');

require_once('appConfig.php');
