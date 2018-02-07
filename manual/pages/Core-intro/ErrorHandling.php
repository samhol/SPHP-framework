<?php

namespace Sphp\Config\ErrorHandling;

$apigen = \Sphp\Manual\api();
$phpManual = \Sphp\Manual\php();
$nsLink = $apigen->namespaceLink(__NAMESPACE__);
$errorExceptionThrower = $apigen->classLinker(ErrorExceptionThrower::class);
$try_catch = $phpManual->hyperLink("language.exceptions.php", "try/catch");
$set_error_handler = $phpManual->functionLink("set_error_handler");
$e_fatal = $phpManual->constantLink("E_FATAL");
$e_deprecated = $phpManual->constantLink("E_DEPRECATED");
$exception = $phpManual->classLinker(\Exception::class)->getLink("Exceptions");
echo <<<MD
##PHP errors to $exception

$errorExceptionThrower is an utility class that can temporarily turn PHP
errors or warnings to $exception objects and then re-set the PHP error handler as it was.

MD
;
