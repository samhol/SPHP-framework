<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Core\CalloutBuilder;

$ed = new ErrorDispatcher();
$ed->addErrorListener(\E_ALL, new CalloutBuilder(false, false), 1);
$ed->startErrorHandling();

$ed->addExceptionListener(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
$ed->addExceptionListener((new ExceptionPrinter())->showTrace());

$ed->startExceptionHandling();
