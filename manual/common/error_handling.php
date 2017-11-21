<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Core\CalloutBuilder;

$ed = new ErrorDispatcher();
$ed->addErrorListener(\E_ALL, new CalloutBuilder(true, true), 1);
$ed->startErrorHandling();

$ed->addExceptionListener(new ExceptionLogger('logs/exceptions.log'));
$ed->addExceptionListener((new ExceptionPrinter())->showTrace());
$ed->startExceptionHandling();
