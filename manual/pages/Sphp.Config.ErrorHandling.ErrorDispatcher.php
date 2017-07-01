<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$errorDispatcher = Apis::sami()->classLinker(ErrorDispatcher::class);
$e_fatal = Apis::phpManual()->constantLink('E_FATAL');
$e_error = Apis::phpManual()->constantLink('E_ERROR');
$e_parse = Apis::phpManual()->constantLink('E_PARSE');
$e_core_error = Apis::phpManual()->constantLink('E_CORE_ERROR');
$e_core_warning = Apis::phpManual()->constantLink('E_CORE_WARNING');
$e_compile = Apis::phpManual()->constantLink('E_COMPILE_ERROR');
$e_deprecated = Apis::phpManual()->constantLink('E_COMPILE_WARNING');
$e_strict = Apis::phpManual()->constantLink('E_STRICT');
echo $parsedown->text(<<<MD
##$errorDispatcher <small>for multiple error handlers</small>

This class can be used to 'replace' PHP's native error handler
The following error types cannot be handled by $errorDispatcher
        
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

(new CodeExampleBuilder("Sphp/Config/ErrorHandling/ErrorDispatcher.php"))
        ->printHtml();
