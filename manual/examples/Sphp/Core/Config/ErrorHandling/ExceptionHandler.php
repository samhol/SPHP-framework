<?php

namespace Sphp\Core\Config\ErrorHandling;

use Sphp\Core\Config\PHPConfig;

$handler = new ExceptionHandler();
$handler->attach(new ExceptionLogger());
$handler->attach(new ExceptionPrinter());
$conf = new PHPConfig();
$conf->setExceptionHandler($handler);
?>