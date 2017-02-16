<?php

namespace Sphp\Core\Config\ErrorHandling;

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger());
$handler->attach(new ExceptionPrinter());
set_exception_handler($handler);
?>