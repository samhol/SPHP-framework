<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Manual;

$throwable = Manual\php()->classLinker(\Throwable::class);
$error = Manual\php()->classLinker(\Error::class);
$exception = Manual\php()->classLinker(\Exception::class);
$errorDispatcher = Manual\api()->classLinker(ErrorDispatcher::class);
$errorListener = Manual\api()->classLinker(ErrorListener::class);
$exceptionListener = Manual\api()->classLinker(ExceptionListener::class);

$e_fatal = Manual\php()->constantLink('E_FATAL');
$e_error = Manual\php()->constantLink('E_ERROR');
$e_parse = Manual\php()->constantLink('E_PARSE');
$e_core_error = Manual\php()->constantLink('E_CORE_ERROR');
$e_core_warning = Manual\php()->constantLink('E_CORE_WARNING');
$e_compile = Manual\php()->constantLink('E_COMPILE_ERROR');
$e_deprecated = Manual\php()->constantLink('E_COMPILE_WARNING');
$e_strict = Manual\php()->constantLink('E_STRICT');
$callable = Manual\php()->typeLink('callable');

Manual\md(<<<MD

##$errorDispatcher <small>object to manage PHP error and exception listeners</small>

This class can manage both PHP errors and uncaught $throwable objects.

MD
);

Manual\md(<<<MD
### $errorDispatcher <small> as PHP Error manager</small>
        
An $errorDispatcher object replaces PHP's native error handler and sends PHP errors to its error listeners.
An Error listener must be a $callable or of $errorListener type.

All of the following PHP error types cannot be handled by an $errorDispatcher instance
        
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

error_reporting(E_ALL);
ini_set("display_errors", 1);

Manual\example('Sphp/Config/ErrorHandling/ErrorDispatcher.php')
        ->printHtml();

Manual\md(<<<MD
###$errorDispatcher <small>as a Uncaught $throwable handler</small>
In PHP 7, most errors are reported by throwing $error exceptions. Both $error and
$exception implements the $throwable interface. 
  
An Exception listener must be a $callable or of $exceptionListener type.
        
__NOTE:__ It is important to note that Script execution will stop after 
a handler is called.

MD
);

Manual\example('manual/common/error_handling.php', null, false)
        ->setExamplePaneTitle('An example of Error and Exception handling')
        ->printHtml();

