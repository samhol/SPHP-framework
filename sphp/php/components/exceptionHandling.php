<?php

namespace Sphp\Utils\ErrorHandling;

$handler = new ExceptionHandler();
$handler->attachIdentityObserver(new ExceptionLogger());
$handler->attachIdentityObserver(new ExceptionPrinter());
set_exception_handler(array($handler, 'handle'));
?>