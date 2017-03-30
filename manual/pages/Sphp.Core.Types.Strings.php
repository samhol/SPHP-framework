<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$strLink = Apis::phpManual()->typeLink('string');
$strings = Apis::apigen()->classLinker(Strings::class);
echo $parsedown->text(<<<MD
##The $strings class

$strings class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);
(new CodeExampleBuilder('Sphp/Core/Types/Strings1.php', 'text', false))
        ->setExamplePaneTitle('Multibyte String testing example')
        ->setOutputSyntaxPaneTitle('String testing results')
        ->printHtml();
echo $parsedown->text(<<<MD
$strings class has also a couple of handy PHP $strLink manipulation functions.
MD
);
(new CodeExampleBuilder('Sphp/Core/Types/Strings2.php', 'text', false))
        ->setExamplePaneTitle("Multibyte String manipulation example")
        ->setOutputSyntaxPaneTitle("String manipulation results")
        ->printHtml();
