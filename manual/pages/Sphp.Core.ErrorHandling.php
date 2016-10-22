<?php

namespace Sphp\Core\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$nsLink = $api->namespaceLink(__NAMESPACE__);
$errorExceptionThrower = $api->classLinker(ErrorExceptionThrower::class);
$try_catch = $php->hyperLink("language.exceptions.php", "try/catch");
$set_error_handler = $php->functionLink("set_error_handler");
$e_fatal = $php->constantLink("E_FATAL");
$e_deprecated = $php->constantLink("E_DEPRECATED");
$exception = $php->classLinker(\Exception::class);
echo $parsedown->text(<<<MD
###PHP error handling

PHP Errors cannot normally be handled with a $try_catch. However it is possible
to alter this behavior using the $set_error_handler function. Most runtime errors
can be intercepted and re-thrown as an $exception so that they can be handled
consistently. But $e_fatal as well any any error that is raised at compile time
cannot be intercepted. However compile-time errors often indicate a syntax error.

$errorExceptionThrower is an utility class that can temporarily turn PHP
errors or warnings to $exception objects and then re-set the PHP error handler as it was.

MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/ErrorHandling/ErrorExceptionThrower.php"))
        ->printHtml();
echo $parsedown->text(<<<MD
        
By default $errorExceptionThrower handles all runtime errors except $e_deprecated.
This feature can be turned off for even stricter error handling.

MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/ErrorHandling/ErrorExceptionThrower2.php"))
        ->printHtml();

