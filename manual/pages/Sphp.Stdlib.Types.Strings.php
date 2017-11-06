<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$strLink = Apis::phpManual()->typeLink('string');
$strings = \Sphp\Manual\api()->classLinker(Strings::class);
\Sphp\Manual\parseDown(<<<MD
##The $strings class

$strings class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);
(new CodeExampleBuilder('Sphp/Stdlib/Types/Strings1.php', 'text', false))
        ->setExamplePaneTitle('Multibyte String testing example')
        ->setOutputSyntaxPaneTitle('String testing results')
        ->printHtml();
\Sphp\Manual\parseDown(<<<MD
$strings class has also a couple of handy PHP $strLink manipulation functions.
MD
);
(new CodeExampleBuilder('Sphp/Stdlib/Types/Strings2.php', 'text', false))
        ->setExamplePaneTitle("Multibyte String manipulation example")
        ->setOutputSyntaxPaneTitle("String manipulation results")
        ->printHtml();
