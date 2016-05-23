<?php

namespace Sphp\Utils\ErrorHandling;

$handler = new ExceptionHandler();
$handler->attachAttributeChangeObserver(new ExceptionLogger());
$handler->attachAttributeChangeObserver(new ExceptionPrinter());
set_exception_handler(array($handler, 'handle'));
?>