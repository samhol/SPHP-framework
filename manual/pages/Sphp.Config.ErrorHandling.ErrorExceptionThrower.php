<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$errorExceptionThrower = \Sphp\Manual\api()->classLinker(ErrorExceptionThrower::class);

$errorException = Apis::phpManual()->classLinker(\ErrorException::class);
\Sphp\Manual\parseDown(<<<MD
##$errorExceptionThrower <small>for multiple error handlers</small>

$errorExceptionThrower can temporarily convert PHP
errors or warnings to $errorException objects and then re-set the PHP error handler as it was.
 
MD
);

(new CodeExampleBuilder('Sphp/Config/ErrorHandling/ErrorExceptionThrower.php'))
        ->printHtml();
