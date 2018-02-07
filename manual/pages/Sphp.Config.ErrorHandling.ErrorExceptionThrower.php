<?php

namespace Sphp\Config\ErrorHandling;

$errorExceptionThrower = \Sphp\Manual\api()->classLinker(ErrorExceptionThrower::class);
$errorException = \Sphp\Manual\php()->classLinker(\ErrorException::class);

\Sphp\Manual\md(<<<MD
##$errorExceptionThrower <small>for multiple error handlers</small>

$errorExceptionThrower can temporarily convert PHP
errors or warnings to $errorException objects and then re-set the PHP error handler as it was.
 
MD
);

\Sphp\Manual\example('Sphp/Config/ErrorHandling/ErrorExceptionThrower.php')
        ->printHtml();
