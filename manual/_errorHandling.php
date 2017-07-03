<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ErrorMessageCallout;

$ed = new ErrorDispatcher();
$callout = new ErrorMessageCallout();
$callout->showInitialFile(true)
        ->isClosable(true);
$ed->addListener(\E_ALL, $callout, 1);
$ed->start(\E_ALL);

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$handler->attach((new ExceptionPrinter())->showTrace());
$handler->start();
