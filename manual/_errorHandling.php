<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ErrorMessageCallout;

$ed = new ErrorDispatcher();
$callout = new ErrorMessageCallout();
$callout->showInitialFile(true)
        ->isClosable(true);
$ed->addErrorListener(\E_ALL, $callout, 1);
$ed->startErrorHandling(\E_ALL);

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$handler->attach((new ExceptionPrinter())->showTrace());
$handler->start();
