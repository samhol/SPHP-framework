<?php

namespace Sphp\Config;

require_once(__DIR__ . '/../sphp/settings.php');

use Sphp\Config\ErrorHandling\ExceptionHandler;
use Sphp\Config\ErrorHandling\ExceptionLogger;
use Sphp\Config\ErrorHandling\ExceptionPrinter;
use Sphp\Config\ErrorHandling\ErrorHandler;

$errH = new ErrorHandler();
$errH->attach(function(ErrorHandler $h) {
  echo "foo: ";
  echo $h->getErrstr();
});
$errH->start(E_ALL);
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
//require_once('doctrine/configuration.php');
//require_once('session.php');
require_once('menuArrays.php');
