<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$errorDispatcher = Apis::sami()->classLinker(ErrorDispatcher::class);
$errorExceptionThrower = Apis::sami()->classLinker(ErrorExceptionThrower::class);
$try_catch = Apis::phpManual()->hyperLink('language.exceptions.php', 'try/catch');
$set_exception_handler = Apis::phpManual()->functionLink('set_exception_handler');
$error = Apis::phpManual()->classLinker(\Error::class);
$exception = Apis::phpManual()->classLinker(\Exception::class);
\Sphp\Manual\parseDown(<<<MD
#PHP 7 <small>Error and Exception handling</small>
$ns
        
In PHP 7 most errors are reported by throwing $error exceptions. These can be 
catched by using $try_catch blocks. If there are no matching blocks, then any 
default exception handler installed with $set_exception_handler will be called, 
and if there is no default exception handler, then the exception will be 
converted to a fatal error and will be handled like a traditional error.

MD
);

\Sphp\Manual\loadPage('Sphp.Config.ErrorHandling.ErrorDispatcher');

\Sphp\Manual\loadPage('Sphp.Config.ErrorHandling.ErrorExceptionThrower');
