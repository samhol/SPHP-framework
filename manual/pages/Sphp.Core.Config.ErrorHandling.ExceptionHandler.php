<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;

echo $parsedown->text(
        <<<MD
###Uncaught {$php->classLinker(\Exception::class)} handling

Framework has a way to handle uncaught PHP exceptions using PHP’s native
exception handling methods and Observer pattern.

1. Create a new ExceptionHandler class
2. Attach an exception logger
3. Set the default Exception handler
MD
);

(new SyntaxHighlightingSingleAccordion("Uncaught PHP exceptions handling example"))
        ->loadFromFile(EXAMPLE_DIR . 'Sphp/Core/Config/ErrorHandling/ExceptionHandler.php')
        ->printHtml();