<?php

namespace Sphp\Core\ErrorHandling;

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger());
$handler->attach(new ExceptionPrinter());
set_exception_handler(array($handler, 'handle'));
?>