<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ErrorMessageCallout;

$ed = new ErrorDispatcher();
$callout = new ErrorMessageCallout();
$callout->showInitialFile(true)
        ->isClosable(true);
$ed->addErrorListener(\E_ALL, $callout, 1);
$ed->startErrorHandling();

$ed->addExceptionListener(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$ed->addExceptionListener((new ExceptionPrinter())->showTrace());

$ed->startExceptionHandling();
