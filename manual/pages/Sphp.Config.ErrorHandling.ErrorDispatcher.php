<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Stdlib\Observers\Observer;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$throwable = Apis::phpManual()->classLinker(\Throwable::class);
$error = Apis::phpManual()->classLinker(\Error::class);
$exception = Apis::phpManual()->classLinker(\Exception::class);
$errorDispatcher = \Sphp\Manual\api()->classLinker(ErrorDispatcher::class);
$errorListener = \Sphp\Manual\api()->classLinker(ErrorListener::class);
$exceptionListener = \Sphp\Manual\api()->classLinker(ExceptionListener::class);

$e_fatal = Apis::phpManual()->constantLink('E_FATAL');
$e_error = Apis::phpManual()->constantLink('E_ERROR');
$e_parse = Apis::phpManual()->constantLink('E_PARSE');
$e_core_error = Apis::phpManual()->constantLink('E_CORE_ERROR');
$e_core_warning = Apis::phpManual()->constantLink('E_CORE_WARNING');
$e_compile = Apis::phpManual()->constantLink('E_COMPILE_ERROR');
$e_deprecated = Apis::phpManual()->constantLink('E_COMPILE_WARNING');
$e_strict = Apis::phpManual()->constantLink('E_STRICT');
$callable = Apis::phpManual()->typeLink('callable');

\Sphp\Manual\parseDown(<<<MD

##$errorDispatcher <small>object to manage PHP error and exception listeners</small>

This class can manage both PHP errors and uncaught $throwable objects.

MD
);

\Sphp\Manual\parseDown(<<<MD
###$errorDispatcher <small> as PHP Error manager</small>
        
An $errorDispatcher object replaces PHP's native error handler and sends PHP errors to its error listeners.
An Error listener must be a $callable or of $errorListener type.

__<u>NOTE</u>:__ The following error types cannot be handled by $errorDispatcher
        
 * $e_fatal 
 * $e_error
 * $e_parse 
 * $e_core_error 
 * $e_core_warning 
 * $e_compile 
 * $e_deprecated 
 * Usually $e_strict   
MD
);

(new CodeExampleBuilder('Sphp/Config/ErrorHandling/ErrorDispatcher.php'))
        ->printHtml();

\Sphp\Manual\parseDown(<<<MD
###$errorDispatcher <small>as a Uncaught $throwable handler</small>
In PHP 7, most errors are reported by throwing $error exceptions. Both $error and
$exception implements the $throwable interface. 
  
An Exception listener must be a $callable or of $exceptionListener type.
        
__<u>NOTE</u>:__ It is important to note that Script execution will stop after 
a handler is called.

MD
);
(new SyntaxHighlightingSingleAccordion('An example of Error and Exception handling'))
        ->loadFromFile(realpath(__DIR__ . '/../_errorHandling.php'))
        ->printHtml();

