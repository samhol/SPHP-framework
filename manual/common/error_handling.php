<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Core\ErrorCalloutBuilder;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$ed = new ErrorDispatcher();
$ed->addErrorListener(\E_ALL, new ErrorCalloutBuilder(true, true), 1);
$ed->startErrorHandling();

$ed->addExceptionListener(new ExceptionLogger('logs/exceptions.log'));
$ed->addExceptionListener((new ThrowableCalloutBuilder())->showInitialFile()->showTrace()->showPreviousException());
$ed->startExceptionHandling();
