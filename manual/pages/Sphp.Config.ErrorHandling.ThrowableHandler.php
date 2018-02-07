<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Stdlib\Observers\Observer;

$throwable = \Sphp\Manual\php()->classLinker(\Throwable::class);
$error = \Sphp\Manual\php()->classLinker(\Error::class);
$exception = \Sphp\Manual\php()->classLinker(\Exception::class);
$observer = \Sphp\Manual\api()->classLinker(Observer::class);
\Sphp\Manual\md(
        <<<MD
###Uncaught $throwable handling

In PHP 7, most errors are reported by throwing $error exceptions. Both $error and
$exception implements the $throwable interface. 
  
__NOTE:__ It is important to note that Script execution will stop after 
a handler is called.

MD
);
(new SyntaxHighlightingSingleAccordion('Uncaught PHP exceptions handling script'))
        ->loadFromFile(realpath(__DIR__ . '/../_errorHandling.php'))
        ->printHtml();
