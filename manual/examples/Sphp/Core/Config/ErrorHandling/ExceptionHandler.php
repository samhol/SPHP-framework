<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Config\PHPConfig;

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger());
$handler->attach(new ExceptionPrinter());
$conf = new PHPConfig();
$conf->setExceptionHandler($handler);
?>