<?php

namespace Sphp\Core\ErrorHandling;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis as Apis;

$apigen = Apis::apigen();
$phpManual = Apis::phpManual();
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

$example = new \Sphp\Html\Foundation\F6\Grids\ExampleViewingGrid("ErrorExceptionThrower example");
$example->loadFromFile(EXAMPLE_DIR . "Sphp/Core/ErrorHandling/ErrorExceptionThrower.php");
$example->printHtml();