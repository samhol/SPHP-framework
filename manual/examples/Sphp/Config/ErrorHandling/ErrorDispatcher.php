<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Core\ErrorCalloutBuilder;

$ed = new ErrorDispatcher();
$ed->addErrorListener(\E_ALL, new ErrorCalloutBuilder(true, true), 3);
$ed->startErrorHandling();
include_once('foobar');
trigger_error('User defined Errors suck badly', E_USER_ERROR);
trigger_error('User warnings suck', E_USER_WARNING);
trigger_error('Deprecated user features suck', E_USER_DEPRECATED);
trigger_error('User defined Notes suck a bit', E_USER_NOTICE);

echo $foo;

